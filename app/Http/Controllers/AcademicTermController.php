<?php

namespace App\Http\Controllers;

use App\Models\AcademicTerm;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicTermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicTerms = AcademicTerm::query()
            ->with('academicYear')
            ->orderByDesc('is_current')
            ->orderByDesc('start_date')
            ->get();

        return view('academic-terms.index', compact('academicTerms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYears = AcademicYear::query()->orderByDesc('name')->get();

        return view('academic-terms.create', compact('academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            AcademicTerm::query()->update(['is_current' => false]);
        }

        AcademicTerm::create($validated);

        return redirect()->route('academic_terms.index')->with('success', 'Academic term created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicTerm $academicTerm)
    {
        $academicTerm->load('academicYear');

        return view('academic-terms.show', compact('academicTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicTerm $academicTerm)
    {
        $academicYears = AcademicYear::query()->orderByDesc('name')->get();

        return view('academic-terms.edit', compact('academicTerm', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicTerm $academicTerm)
    {
        $validated = $request->validate([
            'academic_year_id' => ['required', 'exists:academic_years,id'],
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            AcademicTerm::query()->where('id', '!=', $academicTerm->id)->update(['is_current' => false]);
        }

        $academicTerm->update($validated);

        return redirect()->route('academic_terms.index')->with('success', 'Academic term updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicTerm $academicTerm)
    {
        if ($academicTerm->invoices()->exists()) {
            return redirect()->route('academic_terms.index')->with('error', 'Cannot delete academic term with associated invoices.');
        }
        
        $academicTerm->delete();

        return redirect()->route('academic_terms.index')->with('success', 'Academic term deleted successfully.');
    }
}