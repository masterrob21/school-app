<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::leftJoin('staff', 'classrooms.staff_id', 'staff.id')
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
        $classroom = Classroom::leftJoin('staff', 'classrooms.staff_id', 'staff.id')
                                ->select('classrooms.*', 'first_name', 'last_name')
                                ->where('classrooms.id', $id)
                                ->first();

        return view('classrooms.show')->with('classroom', $classroom);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::leftJoin('staff', 'classrooms.staff_id', 'staff.id')
                                ->select('classrooms.*', 'first_name', 'last_name')
                                ->where('classrooms.id', $id)
                                ->first();

        $staffs = Staff::where('id', '<>', $classroom->staff_id)->get();

        return view('classrooms.edit')->with('classroom', $classroom)
                                      ->with('staffs', $staffs);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'classroom' => ['required', Rule::unique('classrooms')->ignore($classroom), 'string'],
            'staff_id' => ['nullable', 'integer'],
            'capacity' => ['required', 'integer'],
        ]);

        $classroom->update([
            'classroom' => $request->classroom,
            'staff_id' => $request->staff_id,
            'capacity' => $request->capacity
        ]);

        return redirect('/classrooms/' . $classroom->id)->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect(route('classrooms.index'))->with('warning', 'Record deleted.');
    }

    #use ajax to search records in classroom
    public function fetch(Request $request)
    {
        $search = $request->id;

        $classrooms = Classroom::leftJoin('staff', 'classrooms.staff_id', 'staff.id')
                                ->select('classrooms.*', 'first_name', 'last_name')
                                ->where('classroom', 'LIKE', '%'.$search.'%')
                                ->orderBy('classroom')
                                ->paginate(25);

        if ($request->ajax()){
            return view('classrooms.fetch')->with('classrooms', $classrooms);
        }

        return view('classrooms.index')->with('classrooms', $classrooms);
    }
}