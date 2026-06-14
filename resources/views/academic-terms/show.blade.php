<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Academic Term Details') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-lg overflow-hidden">
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Academic Year') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->academicYear?->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Term Name') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Start Date') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->start_date?->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('End Date') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->end_date?->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Current Term') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->is_current ? __('Yes') : __('No') }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Created At') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->created_at?->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th class="w-1/3 px-4 py-3 bg-gray-50 font-medium text-gray-700">{{ __('Updated At') }}</th>
                                    <td class="px-4 py-3 text-gray-900">{{ $academicTerm->updated_at?->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-2">
                        <a href="{{ route('academic_terms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('Back') }}</a>
                        <a href="{{ route('academic_terms.edit', $academicTerm) }}" class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-transparent rounded-md font-semibold text-xs text-yellow-700 uppercase tracking-widest hover:bg-yellow-200 transition">{{ __('Edit Term') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
