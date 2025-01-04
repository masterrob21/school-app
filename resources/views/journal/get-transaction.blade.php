<table class="table-auto w-full text-left">
    <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center capitalize">
        Transactions
    </caption>
    <thead class="bg-blue-200">
        <tr class="border-b  whitespace-nowrap">
            <th class="p-3">Valued Date</th>
            <th class="p-3">Entry Date</th>
            <th class="p-3">Ledger Account</th>
            <th class="p-3">Description</th>
            <th class="p-3" align="right">Debit</th>
            <th class="p-3" align="right">Credit</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($transactions as $transaction)
        <tr class="border-b even:bg-gray-50 whitespace-nowrap capitalize">
            <td class="px-3 py-1 ">{{ $transaction->valued_date }}</td>
            <td class="px-3 py-1 ">{{ $transaction->entry_date }}</td>
            <td class="px-3 py-1 ">{{ $transaction->ledger_name }}</td>
            <td class="px-3 py-1 ">{{ $transaction->description }}</td>
            <td class="px-3 py-1 " align="right">{{ number_format($transaction->debit, 2)}}</td>
            <td class="px-3 py-1" align="right">{{ number_format($transaction->credit, 2) }}</td>
        </tr>
        @empty
            <tr class="border-b">
                <td colspan="6" class="p-2 text-xl font-bold text-red-400"><h2>No records found.</h2></td>
            </tr>
            
        @endforelse
    </tbody>
</table>
{{-- <div class="mt-3 overflow-x-auto">
    {{ $transactions->links() }}
</div> --}}