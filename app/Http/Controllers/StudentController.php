<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\EducationalHistory;
use App\Models\Gender;
use App\Models\Student;
use App\Models\StudentGuardian;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $students = DB::table('students')->join('genders', 'students.gender_id', '=', 'genders.id')
                        ->join('branches', 'students.branch_id', '=', 'branches.id')
                        ->select('students.id', 'students.student_id', 'other_names', 'last_name', 'date_of_birth', 'photo_path', 'gender', 'branch_name')
                        ->orderBy('last_name')
                        ->paginate(25);

        return view('student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('id', Auth()->user()->branch_id)->get();
        $genders = Gender::all();

        return view('student.create')->with('genders', $genders)
                                     ->with('branches', $branches );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Student::count();
        $number = $count + 1;
        $student_id = sprintf('%05d', $number);

        $request->validate([
            'enrollment_date' => ['required', 'date'],
            'last_name' => ['required', 'string'],
            'other_names' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            'photo_path' => ['nullable' , 'image', 'max:2048'],
            ]);

        if ($request->has('photo_path')) {
            $photo = $request->photo_path->store('photo');
            
        }
        else
        {
            $photo = null;
        }
            
            
        Student::create([
            'enrollment_date' => $request->enrollment_date,
            'last_name' => $request->last_name,
            'other_names' => $request->other_names,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'photo_path' => $photo,
            'branch_id' => $request->branch_id,
            'student_id' => $student_id,
        ]);

        return redirect(route('students.create'))->with('status' , 'New student added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = DB::table('students')->join('genders', 'students.gender_id', '=', 'genders.id')
                                         ->join('branches', 'students.branch_id', '=', 'branches.id')
                                         ->select('students.*', 'gender', 'branch_name')
                                         ->where('students.id', $id)
                                         ->first();
                                         
        $education_history = EducationalHistory::where('student_id', $id)->get();

        $student_guardian = StudentGuardian::join('guardians', 'student_guardians.guardian_id', '=', 'guardians.id')
                                            ->join('relations', 'student_guardians.relation_id', '=', 'relations.id')
                                            ->select('first_name', 'last_name', 'primary_number', 'relation', 'student_guardians.id')
                                            ->where('student_id', $id)
                                            ->get();

        session([
            'student_id' => $id,
            'name' => $students->other_names . ' ' . $students->last_name,
        ]);

        return view('student.show')->with('student', $students)
                                   ->with('education_histories', $education_history)
                                   ->with('student_guardians', $student_guardian);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $students = DB::table('students')->join('genders', 'students.gender_id', '=', 'genders.id')
                                         ->join('branches', 'students.branch_id', '=', 'branches.id')
                                         ->select('students.*', 'gender', 'branch_name')
                                         ->where('students.id', $id)
                                         ->first();

        $branches = Branch::where('id', '<>', $students->branch_id)->get();
        $genders = Gender::where('id', '<>', $students->gender_id)->get();

        return view('student.edit')->with('student', $students)
                                   ->with('branches', $branches)
                                   ->with('genders', $genders);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'enrollment_date' => ['required', 'date'],
            'last_name' => ['required', 'string'],
            'other_names' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'email' => ['nullable', 'email'],
            
            ]);

        $student->update([
            'enrollment_date' => $request->enrollment_date,
            'last_name' => $request->last_name,
            'other_names' => $request->other_names,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
        ]);

        return redirect('/students/' . $student->id)->with('info', 'Record updated');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // if(!empty($student->photo_path)){
        //     Storage::delete($student->photo_path);
        //     $student->delete();

        //     return redirect(route('students.index'))->with('status', 'Record has being deleted successfully.');
            
        // }else{
        //     $student->delete();

        //     return redirect(route('students.index'))->with('status', 'Record has being deleted successfully.');
        // }
        

    }

    public function getStudent(Request $request){
        $text = $request->id;
        
        $students = DB::table('students')->join('genders', 'students.gender_id', '=', 'genders.id')
                                            ->join('branches', 'students.branch_id', '=', 'branches.id')
                                            ->select('students.id', 'students.student_id', 'other_names', 'last_name', 'date_of_birth', 'photo_path', 'gender', 'branch_name')
                                            ->whereAny([
                                                'last_name',
                                                'other_names',
                                                'student_id'
                                            ], 'LIKE', '%'.$text.'%')
                                            ->orderBy('last_name')
                                            ->paginate(25);

        if($request->ajax()){
            return view('student.search-results', compact('students'))->render();

        }
        
        return view('student.index')->with('students', $students);
    }
    
}