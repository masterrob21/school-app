<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Staff;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $staffs = DB::table('staff')->join('genders', 'staff.gender_id', '=', 'genders.id')
                                         ->join('branches', 'staff.branch_id', '=', 'branches.id')
                                         ->select('staff.id', 'staff.staff_id', 'last_name', 'first_name', 'date_of_birth', 'gender', 'branch_name')
                                         ->orderBy('last_name')
                                         ->paginate(25);

        # check to see if staff has a reference to the classroom table
        $check_classroom = Classroom::value('staff_id');

        return view('staffs.index')->with('staffs', $staffs)
                                    ->with('check_classroom', $check_classroom);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $branches = Branch::all();
        $genders = Gender::all();
        $departments = Department::all();

        return view('staffs.create')->with('genders', $genders)
                                     ->with('branches', $branches )
                                     ->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hire_date' => ['required', 'date'],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'numeric', 'min_digits:11'],
            'email' => ['nullable', 'email'],
            'branch_id' => ['required'],
            'department_id' => ['nullable'],
            ]);

        //count staff and 1000.
        $count = Staff::count();

        $staffNo = $count + 1000;

        Staff::create([
            'hire_date' => $request->hire_date,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'staff_id' => $staffNo,
            'department_id' => $request->department_id,
        ]);

        return redirect(route('staffs.create'))->with('success', 'New staff added.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::join('genders', 'staff.gender_id', '=', 'genders.id')
                       ->join('branches', 'staff.branch_id', '=', 'branches.id')
                       ->leftJoin('departments', 'staff.department_id', '=', 'departments.id')
                       ->select('staff.*', 'genders.gender', 'branches.branch_name', 'departments.department_name')
                       ->where('staff.id', $id)
                       ->first();
                       
        return view('staffs.show')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Staff::join('genders', 'staff.gender_id', '=', 'genders.id')
                       ->join('branches', 'staff.branch_id', '=', 'branches.id')
                       ->leftJoin('departments', 'staff.department_id', '=', 'departments.id')
                       ->select('staff.*', 'genders.gender', 'branches.branch_name', 'departments.department_name')
                       ->where('staff.id', $id)
                       ->first();
        
        $genders = Gender::where('id', '<>', $staff->gender_id)->get();
        $branches = Branch::where('id', '<>', $staff->branch_id)->get();
        $departments = Department::where('id', '<>', $staff->department_id)->get();
        
        return view('staffs.edit')->with('staff', $staff)
                                  ->with('genders', $genders)
                                  ->with('branches', $branches)
                                  ->with('departments', $departments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'hire_date' => ['required', 'date'],
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'numeric', 'min_digits:11'],
            'email' => ['nullable', 'email'],
            'branch_id' => ['required'],
            'department_id' => ['nullable'],
            ]);

        $staff->update([
            'hire_date' => $request->hire_date,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'branch_id' => $request->branch_id,
            'department_id' => $request->department_id,
        ]);

        return redirect('/staffs/' . $staff->id)->with('status', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        // $staff->delete();

        // return redirect(route('staffs.index'))->with('status', 'Record has being deleted.');
    }
}