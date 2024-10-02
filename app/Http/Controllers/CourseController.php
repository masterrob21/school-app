<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('course_name')->paginate(25);

        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => ['required', 'string', 'unique:courses'],
            'course_name' => ['required', 'string'],
            'course_description' => ['nullable'],
            'credits' => ['required', 'integer'],
        ]);

        Course::create([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'course_description' => $request->course_description,
            'credits' => $request->credits,
        ]);

        return redirect(route('courses.create'))->with('success', 'New course added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        return view('courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::find($id);

        return view('courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course_code' => ['required', 'string', Rule::unique('courses')->ignore($course)],
            'course_name' => ['required', 'string'],
            'course_description' => ['nullable'],
            'credits' => ['required', 'integer'],
        ]);

        $course->update([
            'course_code' => $request->course_code,
            'course_name' => $request->course_name,
            'course_description' => $request->course_description,
            'credits' => $request->credits,
        ]);

        return redirect('/courses/' . $course->id)->with('status', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect('/courses')->with('warning', 'Course deleted.');
    }

    public function fetch(Request $request)
    {
        $search = $request->id;

        $courses = Course::whereAny([
                                'course_name',
                                'course_code'
                            ], 'LIKE', '%'.$search.'%')
                            ->orderBy('course_name')
                            ->paginate(25);

        if($request->ajax()){
            return view('courses.fetch')->with('courses', $courses);
        }

        return view('courses.index')->with('courses', $courses);
    }
}