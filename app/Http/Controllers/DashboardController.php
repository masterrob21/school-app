<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function settings()
    {
        return view('dashboard.setup');
    }

    public function security()
    {
        return view('dashboard.security');
    }
}