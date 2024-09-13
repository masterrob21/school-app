<?php

namespace App\Http\Controllers;

use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $relations = Relation::orderBy('relation')->get();

        return view('relations.index')->with('relations', $relations);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('relations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'relation' => ['required', 'string', 'unique:relations'],
        ]);

        Relation::create([
            'relation' => $request->relation,
        ]);

        return redirect(route('relations.create'))->with('status', 'Record added.');
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
        $relation = Relation::find($id);

        return view('relations.edit')->with('relation', $relation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Relation $relation)
    {
        $request->validate([
            'relation' => ['required', Rule::unique('relations')->ignore($relation)]
        ]);

        $relation->update([
            'relation' => $request->relation
        ]);

        return redirect(route('relations.index'))->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relation $relation)
    {
        $relation->delete();

        return redirect(route('relations.index'))->with('warning', 'Record deleted');
    }
}