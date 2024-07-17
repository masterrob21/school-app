<?php

namespace App\Http\Controllers;

use App\Models\EducationalHistory;
use Illuminate\Http\Request;

class EducationHistoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('education-histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => ['required'],
            'previous_school' => ['required', 'string'],
            'attended_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'level' => ['required'], 'string',
        ]);

        EducationalHistory::create([
            'student_id' => $request->student_id,
            'previous_school' => $request->previous_school,
            'attended_date' => $request->attended_date,
            'end_date' => $request->end_date,
            'level' => $request->level,
        ]);

        return redirect('/students/' . $request->student_id)->with('status', 'Previous school added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $education = EducationalHistory::find($id);

        return view('education-histories.edit')->with('education', $education);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationalHistory $education_history)
    {
        $request->validate([
            'previous_school' => ['required', 'string'],
            'attended_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'level' => ['required'], 'string',
        ]);

        $education_history->update([
            'previous_school' => $request->previous_school,
            'attended_date' => $request->attended_date,
            'end_date' => $request->end_date,
            'level' => $request->level,
        ]);

        return redirect('/students/' . session('student_id'))->with('status', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationalHistory $education_history)
    {
        $education_history->delete();

        return redirect('/students/' . session('student_id'))->with('warning', 'Record deleted.');
    }
}