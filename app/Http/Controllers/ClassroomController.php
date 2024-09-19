<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Staff;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::leftJoin('staff', 'classrooms.id', 'staff.id')
                                ->select('classrooms.*', 'first_name', 'last_name')
                                ->orderBy('classroom')
                                ->paginate(25);

        return view('classrooms.index')->with('classrooms', $classrooms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staffs = Staff::orderBy('last_name')
                        ->select('id', 'first_name', 'last_name')
                        ->get();

        return view('classrooms.create')->with('staffs', $staffs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom' => ['required', 'unique:classrooms', 'string'],
            'staff_id' => ['nullable', 'integer'],
            'capacity' => ['required', 'integer'],
        ]);

        Classroom::create([
            'classroom' => $request->classroom,
            'staff_id' => $request->staff_id,
            'capacity' => $request->capacity
        ]);

        return redirect(route('classrooms.create'))->with('success', 'New record added.');
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