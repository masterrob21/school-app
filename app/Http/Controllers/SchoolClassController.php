<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $schoolClasses = SchoolClass::query()->latest()->paginate(20);

        return view('classes.index')->with('schoolClasses', $schoolClasses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:school_classes,name'],
        ]);

        SchoolClass::create($validated);

        return redirect()->route('classes.index')->with('success', 'School class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(SchoolClass $schoolClass): View
    {
        return view('classes.edit')->with('schoolClass', $schoolClass);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolClass $schoolClass): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('school_classes', 'name')->ignore($schoolClass),
            ],
        ]);

        $schoolClass->update($validated);

        return redirect()->route('classes.index')->with('success', 'School class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass): RedirectResponse
    {
        if ($schoolClass->classrooms()->exists()) {
            return redirect()->route('classes.index')->with('error', 'Cannot delete school class with associated classrooms.');
        }
        
        $schoolClass->delete();

        return redirect()->route('classes.index')->with('success', 'School class deleted successfully.');
    }
}