<?php

namespace App\Http\Controllers;

use App\Models\ProgramType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProgramTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('program-types.index')->with('programTypes', ProgramType::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramType $programType)
    {
        return view('program-types.edit')->with('programType', $programType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramType $programType)
    {
        $request->validate([
            'program_type' => ['required', 'string', Rule::unique('program_types')->ignore($programType)]
        ]);

        $programType->update([
            'program_type' => $request->program_type,
        ]);

        return redirect(route('programTypes.index'))->with('info', 'Record updated.');
    }
}