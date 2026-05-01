<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index()
    {
        $no_of_students = Student::all();

        $recentInvoices = Invoice::with('customer')
        ->latest()
        ->take(5)
        ->get();
        
        $recentPayments = Payment::with('invoice')
        ->latest()
        ->take(5)
        ->get();

        return view('dashboard', [
            'no_of_students' => $no_of_students,
            'recentInvoices' => $recentInvoices,
            'recentPayments' => $recentPayments,
        ]);


    }
}