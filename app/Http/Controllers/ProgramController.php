<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramType;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::join('program_types', 'programs.program_type_id', 'program_types.id')
                            ->select('programs.*', 'program_type')
                            ->orderBy('program_types.id')
                            ->orderBy('sort_order')
                            ->get();

        return view('programs.index')->with('programs', $programs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programTypes = ProgramType::all();

        return view('programs.create')->with('programTypes', $programTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_type_id' => ['required', 'integer'],
            'program' => ['required', 'string', 'unique:programs'],
            'sort_order' => ['required', 'integer'],
        ]);

        Program::create([
            'program_type_id' => $request->program_type_id,
            'program' => $request->program,
            'sort_order' => $request->sort_order,
        ]);

        return redirect(route('programs.create'))->with('status', 'Record saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        //
    }
}