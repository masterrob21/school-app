<x-app-layout>
    <x-slot name="header">
        @php
            $isFullyPaid = $invoice->status === 'paid';
        @endphp
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Invoice Details') }}</h2>
            <div class="flex gap-2">
                @if($isFullyPaid)
                    <span class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-50 cursor-not-allowed">{{ __('Pay Invoice') }}</span>
                    <span class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-50 cursor-not-allowed">{{ __('Edit') }}</span>
                @else
                    <a href="{{ route('invoices.payments.create', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                        {{ __('Pay Invoice') }}
                    </a>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 transition">
                        {{ __('Edit') }}
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900">
                    <p><span class="font-semibold">{{ __('Student:') }}</span> {{ trim(($invoice->student?->other_names ?? '') . ' ' . ($invoice->student?->last_name ?? '')) ?: __('N/A') }}</p>
                    <p><span class="font-semibold">{{ __('Title:') }}</span> {{ $invoice->title }}</p>
                    <p><span class="font-semibold">{{ __('Sub Total:') }}</span> {{ number_format((float) $invoice->sub_total, 2) }}</p>
                    <p><span class="font-semibold">{{ __('Discount Total:') }}</span> {{ number_format((float) $invoice->discount_total, 2) }}</p>
                    <p><span class="font-semibold">{{ __('Grand Amount:') }}</span> {{ number_format((float) $invoice->grand_amount, 2) }}</p>
                    <p><span class="font-semibold">{{ __('Amount Paid:') }}</span> {{ number_format((float) $invoice->amount_paid, 2) }}</p>
                    <p><span class="font-semibold">{{ __('Status:') }}</span> {{ ucwords(str_replace('_', ' ', $invoice->status)) }}</p>
                    <p><span class="font-semibold">{{ __('Due Date:') }}</span> {{ $invoice->due_date ? \Illuminate\Support\Carbon::parse($invoice->due_date)->format('Y-m-d') : __('N/A') }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Invoice Items') }}</h3>
                    @if($invoice->invoiceItems->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-2 py-3">{{ __('#') }}</th>
                                        <th class="px-2 py-3">{{ __('Name') }}</th>
                                        <th class="px-2 py-3">{{ __('Amount') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($invoice->invoiceItems as $index => $item)
                                        <tr>
                                            <td class="px-2 py-2">{{ $index + 1 }}</td>
                                            <td class="px-2 py-2">{{ $item->name }}</td>
                                            <td class="px-2 py-2">{{ number_format((float) $item->amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">{{ __('No invoice items available for this invoice.') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Payments') }}</h3>
                    @if($invoice->payments->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="px-2 py-3">{{ __('#') }}</th>
                                        <th class="px-2 py-3">{{ __('Amount') }}</th>
                                        <th class="px-2 py-3">{{ __('Payment Mode') }}</th>
                                        <th class="px-2 py-3">{{ __('Payment Date') }}</th>
                                        <th class="px-2 py-3">{{ __('Reference') }}</th>
                                        <th class="px-2 py-3">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($invoice->payments as $index => $payment)
                                        <tr>
                                            <td class="px-2 py-2">{{ $index + 1 }}</td>
                                            <td class="px-2 py-2">{{ number_format((float) $payment->amount, 2) }}</td>
                                            <td class="px-2 py-2">{{ $payment->paymentMode?->payment_mode ?? __('N/A') }}</td>
                                            <td class="px-2 py-2">{{ \Illuminate\Support\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                                            <td class="px-2 py-2">{{ $payment->reference_no }}</td>
                                            <td class="px-2 py-2">
                                                <a href="{{ route('invoices.payments.edit', [$invoice, $payment]) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium text-xs mb-1">{{ __('Edit') }}</a>
                                                <form action="{{ route('invoices.payments.destroy', [$invoice, $payment]) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this payment?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition font-medium text-xs">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">{{ __('No payments recorded for this invoice yet.') }}</p>
                    @endif
                </div>
            </div>

            <div>
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('Back To Invoices') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
