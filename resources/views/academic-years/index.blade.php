<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Academic Years') }}</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			@if (session('success'))
				<div id="success-message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
					<p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
				</div>
			@endif

			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
				<div class="p-6 text-gray-900 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
					<div>
						<h3 class="text-lg font-semibold text-gray-900">{{ __('Manage Academic Years') }}</h3>
						<p class="text-sm text-gray-500 mt-1">{{ __('View, create, update, and delete academic year records.') }}</p>
					</div>
					<a href="{{ route('academic_years.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
						{{ __('Add Academic Year') }}
					</a>
				</div>
			</div>

			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					@if($academicYears->count())
						<div class="overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-600">
								<thead class="text-xs uppercase bg-gray-100 text-gray-700">
									<tr>
										<th class="px-2 py-3">{{ __('#') }}</th>
										<th class="px-2 py-3">{{ __('Name') }}</th>
										<th class="px-2 py-3">{{ __('Current') }}</th>
										<th class="px-2 py-3">{{ __('Actions') }}</th>
									</tr>
								</thead>
								<tbody class="bg-white divide-y divide-gray-200">
									@foreach($academicYears as $index => $academicYear)
										<tr class="hover:bg-gray-50">
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-900">{{ $academicYear->name }}</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm text-gray-600">
												@if($academicYear->is_current)
													<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ __('Yes') }}</span>
												@else
													<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">{{ __('No') }}</span>
												@endif
											</td>
											<td class="px-2 py-2 whitespace-nowrap text-sm">
												<a href="{{ route('academic_years.edit', $academicYear) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium text-xs">{{ __('Edit') }}</a>

												<form action="{{ route('academic_years.destroy', $academicYear) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this academic year?') }}');">
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
							<h3 class="text-lg font-semibold text-gray-900">{{ __('No academic years found') }}</h3>
							<p class="mt-2 text-sm text-gray-500">{{ __('There are currently no academic year records to display.') }}</p>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<script type="module">
		$(document).ready(function () {
			$('#success-message').delay(5000).fadeOut('slow', function () {
				$(this).remove();
			});
		});
	</script>
</x-app-layout>
