<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    private const FREQUENCIES = ['one-time', 'termly', 'monthly', 'annually'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feeTypes = FeeType::orderBy('name')->get();
        return view('fee-types.index', compact('feeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fee-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'frequency' => ['required', 'in:' . implode(',', self::FREQUENCIES)],
            'is_mandatory' => ['nullable', 'boolean'],
        ]);

        $validated['is_mandatory'] = $request->boolean('is_mandatory');

        FeeType::create($validated);

        return redirect()->route('fee_types.index')->with('success', 'Fee type created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeType $feeType)
    {
        return view('fee-types.edit', compact('feeType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeType $feeType)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'frequency' => ['required', 'in:' . implode(',', self::FREQUENCIES)],
            'is_mandatory' => ['nullable', 'boolean'],
        ]);

        $validated['is_mandatory'] = $request->boolean('is_mandatory');

        $feeType->update($validated);

        return redirect()->route('fee_types.index')->with('success', 'Fee type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeType $feeType)
    {
        $feeType->delete();

        return redirect()->route('fee_types.index')->with('success', 'Fee type deleted successfully.');
    }
}