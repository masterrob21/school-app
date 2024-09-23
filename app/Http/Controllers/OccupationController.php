<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $occupations = Occupation::orderBy('occupation')->paginate(20);

        return view('occupations.index')->with('occupations', $occupations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('occupations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'occupation' => ['required', 'string', 'unique:occupations']
        ]);

        Occupation::create([
            'occupation' => $request->occupation,
        ]);

        return redirect(route('occupations.create'))->with('status', 'New occupation added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $occupation = Occupation::find($id);

        return view('occupations.edit')->with('occupation', $occupation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Occupation $occupation)
    {
        $request->validate([
            'occupation' => ['required', 'string', Rule::unique('occupations')->ignore($occupation) ]
        ]);

        $occupation->update([
            'occupation' => $request->occupation
        ]);

        return redirect(route('occupations.index'))->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Occupation $occupation)
    {
        $guardian = Guardian::where('occupation_id', $occupation->id)->first();

        if ($guardian) {
            return redirect(route('occupations.index'))->with('info', 'This record cannot be removed, it has relationship with the guardian record.');
        } else {
            $occupation->delete();
            return redirect(route('occupations.index'))->with('warning', 'Record deleted.');
            
        }
        

    }
}