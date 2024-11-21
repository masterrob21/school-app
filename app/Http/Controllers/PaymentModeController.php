<?php

namespace App\Http\Controllers;

use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payment-method.index')->with('paymentMethods', PaymentMode::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMode $paymentMode)
    {
        return view('payment-method.edit')->with('paymentMethod', $paymentMode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentMode $paymentMode)
    {
        $request->validate([
            'payment_mode' => ['required', Rule::unique('payment_modes')->ignore($paymentMode)]
        ]);

        $paymentMode->update([
            'payment_mode' => $request->payment_mode,
        ]);

        return redirect(route('paymentMethods.index'))->with('info', 'Record Updated.');
    }
}