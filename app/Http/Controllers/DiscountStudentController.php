<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discountStudents = DiscountStudent::with(['discount', 'student'])->latest()->get();

        return view('discount-students.index')->with('discountStudents', $discountStudents);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discounts = Discount::orderBy('name')->get();
        $students = Student::orderBy('last_name')->orderBy('other_names')->get();

        return view('discount-students.create')
            ->with('discounts', $discounts)
            ->with('students', $students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'discount_id' => ['required', 'exists:discounts,id'],
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('discount_students')->where(function ($query) use ($request) {
                    return $query->where('discount_id', $request->discount_id);
                }),
            ],
        ], [
            'student_id.unique' => 'This student already has this discount assigned.',
        ]);

        DiscountStudent::create($validated);

        return redirect()->route('discount_students.index')->with('success', 'Discount assigned to student successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountStudent $discountStudent)
    {
        return redirect()->route('discount_students.edit', $discountStudent);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountStudent $discountStudent)
    {
        $discounts = Discount::orderBy('name')->get();
        $students = Student::orderBy('last_name')->orderBy('other_names')->get();

        return view('discount-students.edit')
            ->with('discountStudent', $discountStudent)
            ->with('discounts', $discounts)
            ->with('students', $students);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiscountStudent $discountStudent)
    {
        $validated = $request->validate([
            'discount_id' => ['required', 'exists:discounts,id'],
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('discount_students')
                    ->where(function ($query) use ($request) {
                        return $query->where('discount_id', $request->discount_id);
                    })
                    ->ignore($discountStudent),
            ],
        ], [
            'student_id.unique' => 'This student already has this discount assigned.',
        ]);

        $discountStudent->update($validated);

        return redirect()->route('discount_students.index')->with('success', 'Discount assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountStudent $discountStudent)
    {
        $discountStudent->delete();

        return redirect()->route('discount_students.index')->with('success', 'Discount assignment removed successfully.');
    }
}
