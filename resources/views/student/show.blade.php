<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $student->other_names . ' ' . $student->last_name }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-alert class="bg-green-400">
        {{ session('status') }}
    </x-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students" class="text-blue-600 hover:underline">Students</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Student Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600">Student Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">EnrollmentDate</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->enrollment_date }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">StudentID</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->student_id }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->last_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">OtherNames</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->other_names }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">DateOfBirth</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->date_of_birth }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Gender</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->gender }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Address</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->address }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Phone</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->phone_number }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Branch</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->branch_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Created At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->created_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastUpdated</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->updated_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Photo</th>
                                <td class="p-3 border border-slate-300 text-xl"><img class="rounded h-16 w-16" src="asset('storage/{{ $student->photo_path }}')" alt="photo"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/students/{{$student->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>