<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Staff;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate();
        return view('departments.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::select('id', 'last_name', 'first_name' )->orderBy('last_name');
        
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
        //
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