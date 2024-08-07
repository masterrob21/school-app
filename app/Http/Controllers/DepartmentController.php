<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::leftJoin('staff', 'departments.department_head', 'staff.id')
                                  ->select('departments.*', 'last_name', 'first_name')
                                  ->orderBy('department_name')
                                  ->paginate(10);
        return view('departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::select('id', 'last_name', 'first_name' )->orderBy('last_name')->get();
        
        return view('departments.create')->with('staffs', $staffs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_name' => ['required', 'string', 'unique:departments'],
        ]);

        Department::create([
            'department_name' => $request->department_name,
            'department_head' => $request->department_head,
        ]);

        return redirect(route('departments.create'))->with('success', 'New department added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departments = Department::leftJoin('staff', 'departments.department_head', '=', 'staff.id')
                                  ->select('departments.id', 'department_name', 'last_name', 'first_name')
                                  ->where('departments.id', $id)
                                  ->first();

        return view('departments.show')->with('department', $departments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Department::leftJoin('staff', 'departments.department_head', '=', 'staff.id')
                                  ->select('departments.*', 'last_name', 'first_name')
                                  ->where('departments.id', $id)
                                  ->first();

        $staffs = Staff::where('id', '<>', $departments->department_head)
                        ->select('id', 'last_name', 'first_name')
                        ->get();

        return view('departments.edit')->with('department', $departments)
                                       ->with('staffs', $staffs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_name' => ['required', 'string', Rule::unique('departments')->ignore($department)],
        ]);

        $department->update([
            'department_name' => $request->department_name,
            'department_head' => $request->department_head,
        ]);

        return redirect('/departments/' . $department->id)->with('status', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect(route('departments.index'))->with('status', 'Record deleted.');
    }
}