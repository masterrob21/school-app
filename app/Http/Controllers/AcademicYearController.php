<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = AcademicYear::query()
            ->orderByDesc('is_current')
            ->orderByDesc('name')
            ->get();

        return view('academic-years.index', compact('academicYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic-years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:academic_years,name'],
            'is_current' => ['nullable', 'boolean'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            AcademicYear::query()->update(['is_current' => false]);
        }

        AcademicYear::create($validated);

        return redirect()->route('academic_years.index')->with('success', 'Academic year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return view('academic-years.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('academic_years', 'name')->ignore($academicYear)],
            'is_current' => ['nullable', 'boolean'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            AcademicYear::query()->where('id', '!=', $academicYear->id)->update(['is_current' => false]);
        }

        $academicYear->update($validated);

        return redirect()->route('academic_years.index')->with('success', 'Academic year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        // prevent deletion if it has related records to academic terms
        if ($academicYear->academicTerms()->exists()) {
            return redirect()->route('academic_years.index')->with('error', 'Cannot delete academic year with related academic terms.');
        }

        $academicYear->delete();

        return redirect()->route('academic_years.index')->with('success', 'Academic year deleted successfully.');
    }
}