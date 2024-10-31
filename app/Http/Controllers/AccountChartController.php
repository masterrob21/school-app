<?php

namespace App\Http\Controllers;

use App\Models\AccountChart;
use App\Models\LedgerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccountChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountcharts = AccountChart::join('account_types', 'account_charts.account_type_id', 'account_types.id')
                                     ->select('account_charts.*', 'account_type')
                                     ->orderBy('account_types.id')
                                     ->orderBy('sort_order')
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
            'gl_code' => ['required', 'string', 'unique:account_charts'],
        ]);

        AccountChart::create([
            'account_head' => $request->account_head,
            'account_type_id' => $request->account_type_id,
            'sort_order' => $request->sort_order,
            'gl_code' => $request->gl_code,
            'is_locked' => false,
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
        $accountchart = AccountChart::join('account_types', 'account_charts.account_type_id', 'account_types.id')
                                     ->select('account_charts.*', 'account_type')
                                     ->where('account_charts.id', $id)
                                     ->first();

        $account_types = DB::table('account_types')
                            ->where('id', '<>', $accountchart->account_type_id)
                            ->get();

        return view('chart-of-accounts.edit')->with('accountchart', $accountchart)
                                             ->with('account_types', $account_types);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountChart $accountchart)
    {
        $request->validate([
            'account_head' => ['required', 'string', Rule::unique('account_charts')->ignore($accountchart)],
            'account_type_id' => ['required'],
            'sort_order' => ['required', 'integer'],
            'gl_code' => ['required', 'string', Rule::unique('account_charts')->ignore($accountchart)],
        ]);

        $accountchart->update([
            'account_head' => $request->account_head,
            'account_type_id' => $request->account_type_id,
            'sort_order' => $request->sort_order,
            'gl_code' => $request->gl_code,
        ]);

        return redirect('/accountcharts/' . $accountchart->id)->with('info', 'Record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        #check to see if the resource is locked
        $delete_record = AccountChart::where([
                                        ['id', $id],
                                        ['is_locked', false]
                        ])->first();

        #checking if the resource has related records.                  
        $check_gl_accounts = LedgerAccount::where('account_chart_id', $id)->first();
 
        if ($delete_record){
            
            if ($check_gl_accounts){
                return redirect('/accountcharts')->with('info', 'This record cannot be deleted, it has related GL Account.');
            } else{
                $delete_record->delete();

                return redirect('/accountcharts')->with('warning', 'Record deleted.');
            }

        } else{

            return redirect('/accountcharts')->with('info', 'You cannot delete this record.');

        }

    }

    # use ajax to search for a resource
    public function fetch(Request $request)
    {
        $search = $request->id;

        $accountcharts = AccountChart::join('account_types', 'account_charts.account_type_id', 'account_types.id')
                                        ->select('account_charts.*', 'account_type')
                                        ->where('account_head', 'LIKE', '%'.$search.'%')
                                        ->paginate(25);

        if ($request->ajax()) {
            return view('chart-of-accounts.fetch')->with('accountcharts', $accountcharts);
        }

        return view('chart-of-accounts.index')->with('accountcharts', $accountcharts);        

    }
}