<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\Currency;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountCharts = AccountChart::where('account_type_id', '5')
                                        ->orderBy('account_head')
                                        ->get();
        $currencies = Currency::all();
        $cashAccounts = LedgerAccount::where('account_chart_id', '2')
                                        ->orderBy('ledger_name')
                                        ->get();

        return view('expenses.create', [
            'accountCharts' => $accountCharts,
            'currencies' => $currencies,
            'cashAccounts' => $cashAccounts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $journal_code = 'JNR';
        $trans_date = date('YmdHis', strtotime(now()));
        $reference_code = $journal_code . $trans_date;
        $branch_id = Auth()->user()->branch_id;
        $user_id = Auth()->user()->id;

        $request->validate([
            'valued_date' => ['required', 'date'],
            'account_chart_id' => ['required'],
            'ledger_account_id' => ['required'],
            'currency_id' => ['required'],
            'amount' => ['required', 'numeric'],
            'ledger_account_id1' => ['required'],
            'description' => ['required', 'string'],
        ]);

        
        DB::table('transactions')->insert([
            // debit entry
            ['reference_code' => $reference_code,
             'ledger_account_id' => $request->ledger_account_id,
             'debit' => $request->amount,
             'credit' => 0,
             'valued_date' => $request->valued_date,
             'entry_date' => now(),
             'description' => $request->description,
             'branch_id' => $branch_id,
             'user_id' => $user_id,
             'currency_id' => $request->currency_id,
             'payment_mode_id' => 1,
             'transaction_type_id' => 1,
             'program_id' => 0,
             'corresponding_ledger_account_id' => $request->ledger_account_id1,
            ],

            // credit entry
            ['reference_code' => $reference_code,
             'ledger_account_id' => $request->ledger_account_id1,
             'debit' => 0,
             'credit' => $request->amount,
             'valued_date' => $request->valued_date,
             'entry_date' => now(),
             'description' => $request->description,
             'branch_id' => $branch_id,
             'user_id' => $user_id,
             'currency_id' => $request->currency_id,
             'payment_mode_id' => 1,
             'transaction_type_id' => 1,
             'program_id' => 0,
             'corresponding_ledger_account_id' => $request->ledger_account_id,
            ],
        ]);

        return redirect(route('expenses.create'))->with('status', 'Expense has being added.');

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