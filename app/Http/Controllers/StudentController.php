<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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