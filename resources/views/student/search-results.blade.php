
    <table class="table-auto w-full text-left">
        <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center">
            List of Students
        </caption>
        <thead class="bg-blue-200">
            <tr class="border-b  whitespace-nowrap">
                <th class="p-3">Action</th>
                <th class="p-3">Photo</th>
                <th class="p-3">LastName</th>
                <th class="p-3">OtherNames</th>
                <th class="p-3">DateOfBirth</th>
                <th class="p-3">Gender</th>
                <th class="p-3">Branch</th>
            </tr>
        </thead>

        <tbody >
            @forelse ($students as $student)
            <tr class="border-b even:bg-gray-50 whitespace-nowrap">
                <td class="p-2 flex items-center space-x-1">
                    <a href="students/{{$student->id}}" class="p-2 bg-blue-300 hover:bg-blue-500 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>     
                    </a> 
                </td>
                
                <td class="p-2"><img src="{{asset('storage/'.$student->photo_path)}}" class="h-12 w-12 rounded-full object-cover" alt="photo"></td>
                <td class="p-2 capitalize">{{ $student->last_name }}</td>
                <td class="p-2 capitalize">{{ $student->other_names }}</td>
                <td class="p-2 capitalize">{{ $student->date_of_birth }}</td>
                <td class="p-2">{{ $student->gender }}</td>
                <td class="p-2">{{ $student->branch_name }}</td>
            </tr>
            @empty
                 <tr class="border-b">
                    <td colspan="7" class="p-2 text-xl font-bold text-red-400"><h2>No records found.</h2></td>
                </tr>
            @endforelse
            
        </tbody>
    </table>
    <div class="mt-3 overflow-x-auto">
        {{ $students->links() }}
    </div>

