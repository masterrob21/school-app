<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Discount Students') }}</h2>
			
		</div>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if(session('success'))
				<div id="success-message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
					<p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
				</div>
			@endif

            @if($discountStudents->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ __('Manage Discounts') }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ __('View, show, and delete records.') }}</p>
                        </div>
                        <a href="{{ route('discount_students.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
				            {{ __('Assign Discount') }}
			            </a>
                    </div>
                </div>
            </div>
            @endif

			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					@if($discountStudents->count())
						<div class="overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-600">
								<thead class="text-xs uppercase bg-gray-100 text-gray-700">
									<tr>
										<th class="px-2 py-3">{{ __('#') }}</th>
										<th class="px-2 py-3">{{ __('Student') }}</th>
										<th class="px-2 py-3">{{ __('Student ID') }}</th>
										<th class="px-2 py-3">{{ __('Discount') }}</th>
										<th class="px-2 py-3">{{ __('Type') }}</th>
										<th class="px-2 py-3">{{ __('Value') }}</th>
										<th class="px-2 py-3">{{ __('Actions') }}</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach($discountStudents as $index => $discountStudent)
										<tr class="hover:bg-gray-50">
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ trim(($discountStudent->student?->other_names ?? '') . ' ' . ($discountStudent->student?->last_name ?? '')) ?: __('N/A') }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-600">{{ $discountStudent->student?->student_id ?? __('N/A') }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-600">{{ $discountStudent->discount?->name ?? __('N/A') }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-600">{{ $discountStudent->discount ? ucfirst($discountStudent->discount->type) : __('N/A') }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-600">{{ $discountStudent->discount ? number_format((float) $discountStudent->discount->value, 2) : __('N/A') }}</td>
											<td class="px-2 py-2 text-sm">
												<a href="{{ route('discount_students.edit', $discountStudent) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium text-xs mb-1 md:mb-0">{{ __('Edit') }}</a>

												<form action="{{ route('discount_students.destroy', $discountStudent) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to remove this discount assignment?') }}');">
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
						<div class="text-center py-12">
							<h3 class="text-lg font-semibold text-gray-900">{{ __('No discount assignments found') }}</h3>
							<p class="mt-2 text-sm text-gray-500">{{ __('Assign a discount to a student to get started.') }}</p>
							<a href="{{ route('discount_students.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">{{ __('Assign Discount') }}</a>
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
		});
	</script>
</x-app-layout>
