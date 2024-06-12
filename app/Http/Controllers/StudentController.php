<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Gender;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                                         ->paginate(20);

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
        
        $request->validate([
            'enrollment_date' => ['required', 'date'],
            'last_name' => ['required', 'string'],
            'other_names' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'email'],
            'photo_path' => ['nullable' , 'image'],
            ]);

        if ($request->has('photo_path')) {
            $photo = $request->photo_path->store('photo', 'public');
            
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
            'student_id' => Str::random(8),
        ]);

        return redirect(route('students.create'))->with('success' , 'New student added.');
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
                                         
        return view('student.show')->with('student', $students);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}