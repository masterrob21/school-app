<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Invoices') }}</h2>
			
		</div>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if(session('success'))
				<div id="success-message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
					<p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
				</div>
			@endif

			@if(session('error'))
				<div id="error-message" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
					<p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
				</div>
			@endif

            @if($invoices->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Manage Invoices') }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ __('View, show, and delete records.') }}</p>
                        </div> 
                        <a href="{{ route('invoices.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                            {{ __('Create Invoice') }}
                        </a>
                    </div>
                </div>
            </div>
            @endif

			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					@if($invoices->count())
						<div class="overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-600">
								<thead class="text-xs uppercase bg-gray-100 text-gray-700">
									<tr>
										<th class="px-2 py-3">{{ __('#') }}</th>
										<th class="px-2 py-3">{{ __('Student') }}</th>
										<th class="px-2 py-3">{{ __('Title') }}</th>
										<th class="px-2 py-3">{{ __('Grand Amount') }}</th>
										<th class="px-2 py-3">{{ __('Amount Paid') }}</th>
										<th class="px-2 py-3">{{ __('Status') }}</th>
										<th class="px-2 py-3">{{ __('Due Date') }}</th>
										<th class="px-2 py-3">{{ __('Actions') }}</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach($invoices as $index => $invoice)
										@php
											$hasPayment = (float) $invoice->amount_paid > 0;
											$isFullyPaid = $invoice->status === 'paid';
											$disablePayAndEdit = $isFullyPaid;
											$disableDelete = $hasPayment || $isFullyPaid;
										@endphp
										<tr class="hover:bg-gray-50">
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ trim(($invoice->student?->other_names ?? '') . ' ' . ($invoice->student?->last_name ?? '')) ?: __('N/A') }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-700">{{ $invoice->title }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-700">{{ number_format((float) $invoice->grand_amount, 2) }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-700">{{ number_format((float) $invoice->amount_paid, 2) }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-700">{{ ucwords(str_replace('_', ' ', $invoice->status)) }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-700">{{ $invoice->due_date ? \Illuminate\Support\Carbon::parse($invoice->due_date)->format('Y-m-d') : __('N/A') }}</td>
											<td class="px-2 py-2 text-sm">
												<a href="{{ route('invoices.show', $invoice) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 rounded-md hover:bg-slate-200 transition font-medium text-xs mb-1">{{ __('Show') }}</a>
												@if($disablePayAndEdit)
													<span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 rounded-md font-medium text-xs mb-1 opacity-50 cursor-not-allowed" title="{{ __('Invoice is fully paid') }}">{{ __('Pay') }}</span>
												@else
													<a href="{{ route('invoices.payments.create', $invoice) }}" class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition font-medium text-xs mb-1">{{ __('Pay') }}</a>
												@endif

												@if($disablePayAndEdit)
													<span class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md font-medium text-xs mb-1 opacity-50 cursor-not-allowed" title="{{ __('Invoice is fully paid') }}">{{ __('Edit') }}</span>
												@else
													<a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium text-xs mb-1">{{ __('Edit') }}</a>
												@endif
												<form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this invoice?') }}');">
													@csrf
													@method('DELETE')
													<button type="submit" @disabled($disableDelete) class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-md transition font-medium text-xs disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-red-100 hover:bg-red-200" title="{{ $disableDelete ? __('Cannot delete invoice with payment entries') : '' }}">{{ __('Delete') }}</button>
												</form>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="text-center py-12">
							<h3 class="text-lg font-semibold text-gray-900">{{ __('No invoices found') }}</h3>
							<p class="mt-2 text-sm text-gray-500">{{ __('Create a new invoice to get started.') }}</p>
							<a href="{{ route('invoices.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">{{ __('Create Invoice') }}</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<script type="module">
		$(document).ready(function() {
			$('#success-message').delay(5000).fadeOut('slow', function() {
				$(this).remove();
			});

			$('#error-message').delay(5000).fadeOut('slow', function() {
				$(this).remove();
			});
		});
	</script>
</x-app-layout>
