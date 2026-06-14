<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard') }}</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-blue-100 shadow-sm rounded-lg p-5 border-l-4 border-blue-500">
                    <p class="text-gray-500">{{ __('Students') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($studentsCount) }}</p>
                </div>
                <div class="bg-indigo-100 shadow-sm rounded-lg p-5 border-l-4 border-indigo-500">
                    <p class="text-gray-500">{{ __('Staff') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($staffCount) }}</p>
                </div>
                <div class="bg-emerald-100 shadow-sm rounded-lg p-5 border-l-4 border-emerald-500">
                    <p class="text-gray-500">{{ __('Total Collected') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalCollected, 2) }}</p>
                </div>
                <div class="bg-amber-100 shadow-sm rounded-lg p-5 border-l-4 border-amber-500">
                    <p class="text-gray-500">{{ __('Outstanding Balance') }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalOutstanding, 2) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-yellow-100 shadow-sm rounded-lg p-5 border-l-4 border-yellow-500">
                    <p class="text-gray-500">{{ __('Total Invoices') }}</p>
                    <p class="text-xl font-semibold text-gray-900">{{ number_format($totalInvoices) }}</p>
                </div>
                <div class="bg-green-100 shadow-sm rounded-lg p-5 border-l-4 border-green-500">
                    <p class="text-gray-500">{{ __('Paid Invoices') }}</p>
                    <p class="text-xl font-semibold text-gray-900">{{ number_format($paidInvoices) }}</p>
                </div>
                <div class="bg-red-100 shadow-sm rounded-lg p-5 border-l-4 border-red-500">
                    <p class="text-gray-500">{{ __('Open Invoices') }}</p>
                    <p class="text-xl font-semibold text-gray-900">{{ number_format($openInvoices) }}</p>
                </div>
                <div class="bg-purple-100 shadow-sm rounded-lg p-5 border-l-4 border-purple-500">
                    <p class="text-gray-500">{{ __('Total Billed') }}</p>
                    <p class="text-xl font-semibold text-gray-900">{{ number_format($totalBilled, 2) }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow-sm rounded-lg p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Recent Invoices') }}</h3>
                        <a href="{{ route('invoices.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('View all') }}</a>
                    </div>
                    @if($recentInvoices->isEmpty())
                        <p class="text-sm text-gray-500">{{ __('No invoices found.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-2 py-2">{{ __('Student') }}</th>
                                        <th class="px-2 py-2">{{ __('Amount') }}</th>
                                        <th class="px-2 py-2">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($recentInvoices as $invoice)
                                        <tr>
                                            <td class="px-2 py-2">{{ trim(($invoice->student?->other_names ?? '') . ' ' . ($invoice->student?->last_name ?? '')) ?: __('N/A') }}</td>
                                            <td class="px-2 py-2">{{ number_format((float) $invoice->grand_amount, 2) }}</td>
                                            <td class="px-2 py-2">{{ ucwords(str_replace('_', ' ', $invoice->status)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="bg-white shadow-sm rounded-lg p-5">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Recent Payments') }}</h3>
                    @if($recentPayments->isEmpty())
                        <p class="text-sm text-gray-500">{{ __('No payments found.') }}</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-2 py-2">{{ __('Date') }}</th>
                                        <th class="px-2 py-2">{{ __('Invoice') }}</th>
                                        <th class="px-2 py-2">{{ __('Amount') }}</th>
                                        <th class="px-2 py-2">{{ __('Mode') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($recentPayments as $payment)
                                        <tr>
                                            <td class="px-2 py-2">{{ \Illuminate\Support\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                                            <td class="px-2 py-2">#{{ $payment->invoice_id }}</td>
                                            <td class="px-2 py-2">{{ number_format((float) $payment->amount, 2) }}</td>
                                            <td class="px-2 py-2">{{ $payment->paymentMode?->payment_mode ?? __('N/A') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-lg p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Top 10 Outstanding Invoices') }}</h3>
                @if($largestArrears->isEmpty())
                    <p class="text-sm text-gray-500">{{ __('No outstanding invoices.') }}</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-2 py-2">{{ __('Student') }}</th>
                                    <th class="px-2 py-2">{{ __('Invoice Title') }}</th>
                                    <th class="px-2 py-2">{{ __('Outstanding') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($largestArrears as $arrear)
                                    <tr>
                                        <td class="px-2 py-2">{{ trim(($arrear->student?->other_names ?? '') . ' ' . ($arrear->student?->last_name ?? '')) ?: __('N/A') }}</td>
                                        <td class="px-2 py-2">{{ $arrear->title }}</td>
                                        <td class="px-2 py-2">{{ number_format((float) $arrear->outstanding_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
