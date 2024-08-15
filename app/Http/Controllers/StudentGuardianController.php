<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\Relation;
use App\Models\StudentGuardian;
use Illuminate\Http\Request;

class StudentGuardianController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guardians = Guardian::select('id', 'first_name', 'last_name', 'primary_number')->get();
        $relations = Relation::all();

        return view('student-guardians.create')->with('guardians', $guardians)
                                               ->with('relations', $relations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id',
            'guardian_id',
            'relation_id',
        ]);

        StudentGuardian::create([
            'student_id' => $request->student_id,
            'guardian_id' => $request->guardian_id,
            'relation_id' => $request->relation_id,
        ]);

        return redirect('/students/' . session('student_id'))->with('status', 'Record added.');
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