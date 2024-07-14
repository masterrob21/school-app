<?php

namespace App\Http\Controllers;

use App\Models\EducationalHistory;
use Illuminate\Http\Request;

class EducationHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

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