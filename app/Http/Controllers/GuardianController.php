<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Occupation;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guardians = Guardian::join('occupations', 'guardians.occupation_id', 'occupations.id')
                                ->select('guardians.*', 'occupation')
                                ->orderBy('occupation')
                                ->paginate(25);

        return view('guardians.index')->with('guardians', $guardians);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $occupations = Occupation::orderBy('occupation')->get();

        return view('guardians.create')->with('occupations', $occupations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'occupation_id' => ['required'],
            'primary_number' => ['required', 'integer'],
            'secondary_number' => ['nullable', 'integer'],
            'email' => ['nullable', 'email'],
            'address' => ['required', 'string'],
        ]);

        Guardian::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'occupation_id' => $request->occupation_id,
            'primary_number' => $request->primary_number,
            'secondary_number' => $request->secondary_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect(route('guardians.create'))->with('status', 'Record added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guardian = Guardian::join('occupations', 'guardians.occupation_id', 'occupations.id')
                                ->select('guardians.*', 'occupation')
                                ->where('guardians.id', $id)
                                ->first();

        return view('guardians.show')->with('guardian', $guardian);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guardian = Guardian::join('occupations', 'guardians.occupation_id', 'occupations.id')
                                ->select('guardians.*', 'occupation')
                                ->where('guardians.id', $id)
                                ->first();

        $occupations = Occupation::where('id', '<>', $id)->get();

        return view('guardians.edit')->with('guardian', $guardian)
                                     ->with('occupations', $occupations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guardian $guardian)
    {
        $request->validate([
            'last_name' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'occupation_id' => ['required'],
            'primary_number' => ['required', 'integer'],
            'secondary_number' => ['nullable', 'integer'],
            'email' => ['nullable', 'email'],
            'address' => ['required', 'string'],
        ]);

        $guardian->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'occupation_id' => $request->occupation_id,
            'primary_number' => $request->primary_number,
            'secondary_number' => $request->secondary_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect('/guardians/' . $guardian->id)->with('status', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardian $guardian)
    {
        $guardian->delete();

        return redirect(route('guardians.index'))->with('warning', 'Record deleted.');
    }

    #use ajax to search in guardian records.
    public function fetch(Request $request){
        $search = $request->id;

        $guardians = Guardian::join('occupations', 'guardians.occupation_id', 'occupations.id')
                                ->select('guardians.*', 'occupation')
                                ->whereAny([
                                    'last_name',
                                    'first_name'
                                ], 'LIKE', '%'.$search.'%')
                                ->orderBy('occupation')
                                ->paginate(25);
                                
        if ($request->ajax()){
            return view('guardians.fetch')->with('guardians', $guardians);
        }

        return view('guardians.index')->with('guardians', $guardians);
    }
}