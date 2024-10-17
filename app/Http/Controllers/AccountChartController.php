<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $account_types = DB::table('account_types')->get();

        return view('chart-of-accounts.create')->with('account_types', $account_types);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'account_head' => ['required', 'string', 'unique:account_charts'],
            'account_type_id' => ['required'],
            'sort_order' => ['required', 'integer'],
        ]);

        AccountChart::create([
            'account_head' => $request->account_head,
            'account_type_id' => $request->account_type_id,
            'sort_order' => $request->sort_order,
        ]);

        return redirect(route('accountcharts.create'))->with('success', 'Record added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $accountchart = AccountChart::join('account_types', 'account_charts.account_type_id', 'account_types.id')
                                     ->select('account_charts.*', 'account_type')
                                     ->where('account_charts.id', $id)
                                     ->first();

        return view('chart-of-accounts.show')->with('accountchart', $accountchart);
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