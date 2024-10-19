<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;

class LedgerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $get_account_head = AccountChart::where('id', $id)->value('account_head');
        $ledgeraccounts = LedgerAccount::join('account_charts', 'ledger_accounts.account_chart_id', 'account_charts.id')
                                        ->where('account_chart_id', $id)
                                        ->select('ledger_accounts.*', 'account_charts.account_head')
                                        ->paginate(25);

        session([
            'account_chart_id' => $id,
            'account_head' => $get_account_head,
        ]);

        return view('gl-accounts.index')->with('ledgeraccounts', $ledgeraccounts);
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