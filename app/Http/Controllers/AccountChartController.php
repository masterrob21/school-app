<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use Illuminate\Http\Request;

class AccountChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountcharts = AccountChart::join('account_types', 'account_charts.account_type_id', 'account_types.id')
                                     ->select('account_charts.*', 'account_type')
                                     ->paginate(25);

        return view('chart-of-accounts.index')->with('accountcharts', $accountcharts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}