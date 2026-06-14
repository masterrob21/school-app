<x-app-layout>
	<x-slot name="header">
		<div class="flex items-center justify-between">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('School Classes') }}</h2>
			
		</div>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="mb-4">
				<ul class="px-4 py-2 list-none bg-slate-200">
					<li class="inline text-lg"><a href="{{ url('/settings') }}" class="text-blue-600 hover:underline capitalize">{{ __('settings') }}</a></li>
					<li class="inline text-lg before:p-2 before:content-['/']">{{ __('School Classes') }}</li>
				</ul>
			</div>

			@if (session('success'))
				<div id="status_message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800">
					{{ session('success') }}
				</div>
			@endif

            @if (session('error'))
				<div id="status_message" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-800">
					{{ session('error') }}
				</div>
			@endif

            @if($schoolClasses->count() > 0)
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
				<div class="p-6 text-gray-900 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
					<div>
						<h3 class="text-lg font-semibold text-gray-900">{{ __('Manage Classes') }}</h3>
						<p class="text-sm text-gray-500 mt-1">{{ __('View, create, and remove class records.') }}</p>
					</div>
					<a href="{{ route('classes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
				        {{ __('Add New Class') }}
			        </a>
				</div>
			</div>
			@endif

			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					@if ($schoolClasses->count())
						<div class="overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-600">
								<thead class="text-xs uppercase bg-gray-100 text-gray-700">
									<tr>
										<th class="px-3 py-3">{{ __('#') }}</th>
										<th class="px-3 py-3">{{ __('Class Name') }}</th>
										<th class="px-3 py-3">{{ __('Created At') }}</th>
										<th class="px-3 py-3">{{ __('Actions') }}</th>
									</tr>
								</thead>
								<tbody class="divide-y divide-gray-200">
									@foreach ($schoolClasses as $index => $schoolClass)
										<tr>
											<td class="px-3 py-3">{{ $schoolClasses->firstItem() + $index }}</td>
											<td class="px-3 py-3 font-medium text-gray-900">{{ $schoolClass->name }}</td>
											<td class="px-3 py-3">{{ $schoolClass->created_at?->format('Y-m-d H:i') }}</td>
											<td class="px-3 py-3">
												<div class="flex items-center gap-2">
													<a href="{{ route('classes.edit', $schoolClass) }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-md hover:bg-yellow-200 transition font-medium text-xs">{{ __('Edit') }}</a>

													<form action="{{ route('classes.destroy', $schoolClass) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this class?') }}');">
														@csrf
														@method('DELETE')
														<button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition font-medium text-xs">{{ __('Delete') }}</button>
													</form>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>

						<div class="mt-4">
							{{ $schoolClasses->links() }}
						</div>
					@else
						<div class="text-center py-10">
							<h3 class="text-lg font-semibold text-gray-900">{{ __('No school classes found') }}</h3>
							<p class="mt-2 text-sm text-gray-500">{{ __('Create your first school class to get started.') }}</p>
							<a href="{{ route('classes.create') }}" class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
								{{ __('Add New Class') }}
							</a>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

    <script type="module">
		$(document).ready(function () {
			$('#status_message').delay(5000).fadeOut('slow', function () {
				$(this).remove();
			});
		});
	</script>
</x-app-layout>
