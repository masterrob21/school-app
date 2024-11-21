<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('currency.index')->with('currencies', Currency::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('currency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => ['required', 'unique:currencies', 'string'],
            'currency' => ['required', 'unique:currencies', 'string'],
        ]);

        Currency::create([
            'id' => $request->id,
            'currency' => $request->currency,
        ]);

        return redirect(route('currency.create'))->with('success', 'Record saved.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('currency.edit')->with('currency', Currency::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $request->validate([
            'currency' => ['required', Rule::unique('currencies')->ignore($currency)]
        ]);

        $currency->update([
            'currency' => $request->currency
        ]);

        return redirect(route('currency.index'))->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}