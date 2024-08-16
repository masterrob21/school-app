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
            'student_id' => ['required'],
            'guardian_id' => ['required'],
            'relation_id' => ['required'],
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
        $student_guardian = StudentGuardian::join('guardians', 'student_guardians.guardian_id', '=', 'guardians.id')
                                            ->join('relations', 'student_guardians.relation_id', '=', 'relations.id')
                                            ->select('student_guardians.*', 'first_name', 'last_name', 'primary_number', 'relation')
                                            ->where('student_guardians.id', $id)
                                            ->first();

        $guardians = Guardian::where('id', '<>', $student_guardian->guardian_id)
                                ->orderBy('last_name')
                                ->get();

        $relations = Relation::where('id', '<>', $student_guardian->relation_id)
                                ->orderBy('relation')
                                ->get();

        return view('student-guardians.edit')->with('student_guardian', $student_guardian)
                                             ->with('guardians', $guardians)
                                             ->with('relations', $relations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentGuardian $studentGuardian)
    {
        $request->validate([
            'guardian_id' => ['required'],
            'relation_id' => ['required'],
        ]);

        $studentGuardian->update([
            'guardian_id' => $request->guardian_id,
            'relation_id' => $request->relation_id,
        ]);

        return redirect('/studentGuardian/' . $studentGuardian->id . '/edit')->with('status', 'Record updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentGuardian $studentGuardian)
    {
        $studentGuardian->delete();

        return redirect('/students/' . session('student_id'))->with('status', 'Record deleted.');
    }
}