<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Invoice $invoice): View
    {
        return view('payments.create')
            ->with('invoice', $invoice)
            ->with('paymentModes', PaymentMode::orderBy('payment_mode')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_mode_id' => ['required', 'exists:payment_modes,id'],
            'payment_date' => ['required', 'date'],
            'reference_no' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($invoice, $validated): void {
            Payment::create([
                'invoice_id' => $invoice->id,
                'amount' => $validated['amount'],
                'payment_mode_id' => $validated['payment_mode_id'],
                'payment_date' => $validated['payment_date'],
                'reference_no' => $validated['reference_no'],
            ]);

            $this->syncInvoicePaymentStatus($invoice);
        });

        return redirect()->route('invoices.show', $invoice)->with('success', 'Payment added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice, Payment $payment): View
    {
        if ((int) $payment->invoice_id !== (int) $invoice->id) {
            abort(404);
        }

        return view('payments.edit')
            ->with('invoice', $invoice)
            ->with('payment', $payment)
            ->with('paymentModes', PaymentMode::orderBy('payment_mode')->get());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice, Payment $payment): RedirectResponse
    {
        if ((int) $payment->invoice_id !== (int) $invoice->id) {
            abort(404);
        }

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_mode_id' => ['required', 'exists:payment_modes,id'],
            'payment_date' => ['required', 'date'],
            'reference_no' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($invoice, $payment, $validated): void {
            $payment->update($validated);

            $this->syncInvoicePaymentStatus($invoice);
        });

        return redirect()->route('invoices.show', $invoice)->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice, Payment $payment): RedirectResponse
    {
        if ((int) $payment->invoice_id !== (int) $invoice->id) {
            abort(404);
        }

        DB::transaction(function () use ($invoice, $payment): void {
            $payment->delete();

            $this->syncInvoicePaymentStatus($invoice);
        });

        return redirect()->route('invoices.show', $invoice)->with('success', 'Payment deleted successfully.');
    }

    private function syncInvoicePaymentStatus(Invoice $invoice): void
    {
        $invoice->refresh();
        $amountPaid = (float) $invoice->payments()->sum('amount');
        $grandAmount = (float) $invoice->grand_amount;

        $status = 'unpaid';

        if ($grandAmount <= 0 || $amountPaid >= $grandAmount) {
            $status = 'paid';
        } elseif ($amountPaid > 0) {
            $status = 'partially_paid';
        }

        $invoice->update([
            'amount_paid' => $amountPaid,
            'status' => $status,
        ]);
    }
}
