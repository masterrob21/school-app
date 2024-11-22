<table class="table-auto w-full text-left">
    <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center">
        List of Branches
    </caption>
    <thead class="bg-blue-200">
        <tr class="border-b  whitespace-nowrap">
            <th class="p-3">Action</th>
            <th class="p-3">Branch Code</th>
            <th class="p-3">Name</th>
            <th class="p-3">Location</th>
            <th class="p-3">Manager</th>
            <th class="p-3">Contact #</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($branches as $branch)
            <tr class="border-b even:bg-gray-50 whitespace-nowrap">
                <td class="px-3 py-1 flex items-center space-x-1">
                    <a href="branches/{{$branch->id}}" class="p-2 bg-slate-400 hover:bg-slate-300 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>     
                    </a> 
                </td>
                <td class="px-3 py-1 capitalize">{{ $branch->branch_code }}</td>
                <td class="px-3 py-1 capitalize">{{ $branch->branch_name }}</td>
                <td class="px-3 py-1 capitalize">{{ $branch->location }}</td>                                      
                <td class="px-3 py-1 capitalize">{{ $branch->manager }}</td>                                      
                <td class="px-3 py-1 capitalize">{{ $branch->telephone }}</td>                                      
            </tr>
        @empty
            <tr class="border-b">
                <td colspan="4" class="p-3 text-xl font-bold text-red-400 capitalize"><h2>No record found.</h2></td>
            </tr>
        @endforelse
    </tbody>
</table>