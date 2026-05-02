<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Add Invoice Payment') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-3">
                    <p><span class="font-semibold">{{ __('Invoice:') }}</span> #{{ $invoice->id }} - {{ $invoice->title }}</p>
                    <p><span class="font-semibold">{{ __('Student:') }}</span> {{ trim(($invoice->student?->other_names ?? '') . ' ' . ($invoice->student?->last_name ?? '')) ?: __('N/A') }}</p>
                    <p><span class="font-semibold">{{ __('Grand Amount:') }}</span> {{ number_format((float) $invoice->grand_amount, 2) }}</p>
                    <p><span class="font-semibold">{{ __('Amount Paid:') }}</span> {{ number_format((float) $invoice->amount_paid, 2) }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('invoices.payments.store', $invoice) }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="amount" class="block text-sm font-medium text-gray-700">{{ __('Amount') }}</label>
                                <input type="number" step="0.01" min="0.01" name="amount" id="amount" value="{{ old('amount') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                @error('amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_mode_id" class="block text-sm font-medium text-gray-700">{{ __('Payment Mode') }}</label>
                                <select name="payment_mode_id" id="payment_mode_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">{{ __('Select payment mode') }}</option>
                                    @foreach($paymentModes as $mode)
                                        <option value="{{ $mode->id }}" @selected(old('payment_mode_id') == $mode->id)>{{ $mode->payment_mode }}</option>
                                    @endforeach
                                </select>
                                @error('payment_mode_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_date" class="block text-sm font-medium text-gray-700">{{ __('Payment Date') }}</label>
                                <input type="date" name="payment_date" id="payment_date" value="{{ old('payment_date', now()->format('Y-m-d')) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                @error('payment_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="reference_no" class="block text-sm font-medium text-gray-700">{{ __('Reference Number') }}</label>
                                <input type="text" name="reference_no" id="reference_no" value="{{ old('reference_no') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                @error('reference_no')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('invoices.show', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('Cancel') }}</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">{{ __('Save Payment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
