<option value=""> ...</option>
@foreach ($ledgerAccounts as $ledgerAccount)
    <option value="{{$ledgerAccount->id}}">{{ $ledgerAccount->ledger_name }}</option>
@endforeach