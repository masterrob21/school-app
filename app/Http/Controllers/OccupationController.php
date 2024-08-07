<?php

namespace App\Http\Controllers;

use App\Models\Occupation;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}