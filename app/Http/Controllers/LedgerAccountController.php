<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
                                        ->orderBy('ledger_name')
                                        ->orderBy('ledger_accounts.sort_order')
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
        $accountchart = AccountChart::find(session('account_chart_id'));

        return view('gl-accounts.create')->with('accountchart', $accountchart);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ledger_code' => ['required', 'string', 'unique:ledger_accounts'],
            'ledger_name' => ['required', 'string', 'unique:ledger_accounts'],
            'account_chart_id' => ['required'],
            'sort_order' => ['required'],
        ]);

        LedgerAccount::create([
            'ledger_code' => $request->ledger_code,
            'ledger_name' => $request->ledger_name,
            'account_chart_id' => $request->account_chart_id,
            'sort_order' => $request->sort_order,
            'allow_journal_entry' => $request->allow_journal_entry,
        ]);

        return redirect(route('ledgeraccounts.create'))->with('success', 'Record saved.');
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
        $ledgeraccount = LedgerAccount::join('account_charts', 'ledger_accounts.account_chart_id', 'account_charts.id')
                                        ->where('ledger_accounts.id', $id)
                                        ->select('ledger_accounts.*', 'account_head')
                                        ->first();

        return view('gl-accounts.edit')->with('ledgeraccount', $ledgeraccount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LedgerAccount $ledgeraccount)
    {
        $request->validate([
            'ledger_code' => ['required', 'string', Rule::unique('ledger_accounts')->ignore($ledgeraccount)],
            'ledger_name' => ['required', 'string', Rule::unique('ledger_accounts')->ignore($ledgeraccount)],
            'sort_order' => ['required'],
        ]);

        $ledgeraccount->update([
            'ledger_code' => $request->ledger_code,
            'ledger_name' => $request->ledger_name,
            'sort_order' => $request->sort_order,
            'allow_journal_entry' => $request->allow_journal_entry,
        ]);

        return redirect('/ledgeraccounts-getchartid/' . session('account_chart_id'))->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LedgerAccount $ledgeraccount)
    {
        $ledgeraccount->delete();

        return redirect('/ledgeraccounts-getchartid/' . session('account_chart_id'))->with('warning', 'Record deleted.');
    }
}