<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('branches.index')->with('branches', Branch::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('branches.show')->with('branch', Branch::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('branches.edit')->with('branch', $branch);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_code' => ['required', 'string', Rule::unique('branches')->ignore($branch)],
            'branch_name' => ['required', 'string', Rule::unique('branches')->ignore($branch)],
            'location' => ['required', 'string'],
            'manager' => ['nullable', 'string'],
            'telephone' => ['nullable', 'string'],
        ]);

        $branch->update([
            'branch_code' => $request->branch_code,
            'branch_name' => $request->branch_name,
            'location' => $request->location,
            'manager' => $request->manager,
            'telephone' => $request->telephone,
        ]);

        return redirect('/branches/' . $branch->id)->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}