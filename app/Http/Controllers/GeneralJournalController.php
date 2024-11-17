<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\Currency;
use App\Models\LedgerAccount;
use App\Models\PaymentMode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralJournalController extends Controller
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
        $currencies = Currency::orderBy('currency')->get();
        $accountCharts = AccountChart::orderBy('account_head')->get();
        $paymentModes = PaymentMode::orderBy('payment_mode')->get();

        return view('journal.create')->with('currencies', $currencies)
                                     ->with('accountCharts', $accountCharts)
                                     ->with('paymentModes', $paymentModes);
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
            'payment_mode_id' => ['required'],
            'currency_id' => ['required'],
            'amount' => ['required', 'numeric'],
            'account_chart_id1' => ['required'],
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
             'payment_mode_id' => $request->payment_mode_id,
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
             'payment_mode_id' => $request->payment_mode_id,
             'transaction_type_id' => 1,
             'program_id' => 0,
             'corresponding_ledger_account_id' => $request->ledger_account_id,
            ],
        ]);

        return redirect(route('general-journal.create'))->with('status', 'Journal entries saved.');
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

    # use ajax to fetch ledger accounts
    public function fetch(Request $request)
    {
        $id = $request->id;

        $ledgerAccounts = LedgerAccount::where('account_chart_id', $id)->get();

        return view('journal.fetch')->with('ledgerAccounts', $ledgerAccounts);
    }
}