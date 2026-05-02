<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Staff;
use App\Models\Student;
use Illuminate\View\View;

class DashController extends Controller
{
    public function index(): View
    {
        $studentsCount = Student::count();
        $staffCount = Staff::count();
        $totalInvoices = Invoice::count();
        $paidInvoices = Invoice::where('status', 'paid')->count();
        $openInvoices = Invoice::where('status', '!=', 'paid')->count();

        $totalBilled = (float) Invoice::sum('grand_amount');
        $totalCollected = (float) Payment::sum('amount');
        $totalOutstanding = max($totalBilled - $totalCollected, 0);

        $recentInvoices = Invoice::with('student')
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = Payment::with(['invoice.student', 'paymentMode'])
            ->latest()
            ->take(5)
            ->get();

        $largestArrears = Invoice::with('student')
            ->whereColumn('grand_amount', '>', 'amount_paid')
            ->select('*')
            ->selectRaw('(grand_amount - amount_paid) as outstanding_amount')
            ->orderByDesc('outstanding_amount')
            ->take(10)
            ->get();

        return view('dashboard', [
            'studentsCount' => $studentsCount,
            'staffCount' => $staffCount,
            'totalInvoices' => $totalInvoices,
            'paidInvoices' => $paidInvoices,
            'openInvoices' => $openInvoices,
            'totalBilled' => $totalBilled,
            'totalCollected' => $totalCollected,
            'totalOutstanding' => $totalOutstanding,
            'recentInvoices' => $recentInvoices,
            'recentPayments' => $recentPayments,
            'largestArrears' => $largestArrears,
        ]);
    }
}