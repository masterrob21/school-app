<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $no_of_students = Student::all();

        return view('dashboard', [
            'no_of_students' => $no_of_students,
        ]);
    }
}