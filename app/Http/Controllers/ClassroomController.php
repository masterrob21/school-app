<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\SchoolClass;
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
                                ->leftJoin('school_classes', 'classrooms.school_class_id', 'school_classes.id')
                                ->select('classrooms.*', 'first_name', 'last_name', 'school_classes.name as school_class_name')
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

        $schoolClasses = SchoolClass::query()->orderBy('name')->get();

        return view('classrooms.create')
            ->with('staffs', $staffs)
            ->with('schoolClasses', $schoolClasses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'classroom' => [
                'required',
                'string',
                Rule::unique('classrooms', 'classroom')->where(function ($query) use ($request) {
                    return $query->where('school_class_id', $request->school_class_id);
                }),
            ],
            'staff_id' => ['nullable', 'integer'],
            'capacity' => ['required', 'integer'],
        ]);

        Classroom::create($validated);

        return redirect(route('classrooms.create'))->with('success', 'New record added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom = Classroom::leftJoin('staff', 'classrooms.staff_id', 'staff.id')
                                ->leftJoin('school_classes', 'classrooms.school_class_id', 'school_classes.id')
                                ->select('classrooms.*', 'first_name', 'last_name', 'school_classes.name as school_class_name')
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
                                ->leftJoin('school_classes', 'classrooms.school_class_id', 'school_classes.id')
                                ->select('classrooms.*', 'first_name', 'last_name', 'school_classes.name as school_class_name')
                                ->where('classrooms.id', $id)
                                ->first();

        $staffs = Staff::where('id', '<>', $classroom->staff_id)->get();
        $schoolClasses = SchoolClass::query()->where('id', '<>', $classroom->school_class_id)->orderBy('name')->get();

        return view('classrooms.edit')->with('classroom', $classroom)
                                      ->with('staffs', $staffs)
                                      ->with('schoolClasses', $schoolClasses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'school_class_id' => ['required', 'exists:school_classes,id'],
            'classroom' => [
                'required',
                'string',
                Rule::unique('classrooms', 'classroom')
                    ->where(function ($query) use ($request) {
                        return $query->where('school_class_id', $request->school_class_id);
                    })
                    ->ignore($classroom),
            ],
            'staff_id' => ['nullable', 'integer'],
            'capacity' => ['required', 'integer'],
        ]);

        $classroom->update($validated);

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
                                ->leftJoin('school_classes', 'classrooms.school_class_id', 'school_classes.id')
                                ->select('classrooms.*', 'first_name', 'last_name', 'school_classes.name as school_class_name')
                                ->where('classroom', 'LIKE', '%'.$search.'%')
                                ->orderBy('classroom')
                                ->paginate(25);

        if ($request->ajax()){
            return view('classrooms.fetch')->with('classrooms', $classrooms);
        }

        return view('classrooms.index')->with('classrooms', $classrooms);
    }
}