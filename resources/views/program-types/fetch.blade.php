<table class="table-auto w-full text-left">
    <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center capitalize">
        program types
    </caption>
    <thead class="bg-blue-200">
        <tr class="border-b  whitespace-nowrap">
            <th class="p-3">Action</th>
            <th class="p-3">program Type</th>
    </thead>

    <tbody>
        @if (count($programTypes)<1)
            <tr class="border-b">
                <td colspan="2" class="p-3 text-xl font-bold text-red-400"><h2>No record found.</h2></td>
            </tr>
        @endif
        @foreach ($programTypes as $programType)
            <tr class="border-b even:bg-gray-50 whitespace-nowrap">
                <td class="px-3 py-1 flex items-center space-x-1">
                    <a href="programTypes/{{$programType->id}}/edit" class="p-2 bg-slate-400 hover:bg-slate-300 rounded">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>     
                    </a> 
                </td>
                <td class="px-3 py-1 uppercase">{{ $programType->program_type }}</td>                                    
            </tr>
        @endforeach
    </tbody>
</table>
