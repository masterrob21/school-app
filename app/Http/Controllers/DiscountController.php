<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private const TYPES = ['percentage', 'fixed'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('discounts.index')->with('discounts', Discount::latest()->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:'.implode(',', self::TYPES)],
            'value' => ['required', 'numeric', 'min:0'],
        ]);

        Discount::create($validated);

        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        return redirect()->route('discounts.edit', $discount);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('discounts.edit')->with('discount', $discount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:'.implode(',', self::TYPES)],
            'value' => ['required', 'numeric', 'min:0'],
        ]);

        $discount->update($validated);

        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
