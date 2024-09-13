<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateImageController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);

        return view('studentImage.edit')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'photo_path' => ['required', 'image', 'max:2048']
        ]);

        $student->update([
            'photo_path' => $request->photo_path->store('photo')
        ]);

        return redirect('/students/' . $student->id)->with('status', 'Image inserted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if(Storage::delete($student->photo_path)){
            $student->update([
                'photo_path' => null
            ]);
        }
        
        return redirect('/students/' . $student->id)->with('warning', 'Image removed.');
    }
}