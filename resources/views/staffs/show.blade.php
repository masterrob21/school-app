<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $staff->first_name . ' ' . $staff->last_name }}
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
                    <li class=" inline text-lg"><a href="/staffs" class="text-blue-600 hover:underline">Staff</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Staff Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600">Staff Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">HireDate</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->hire_date }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">staffID</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->staff_id }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->last_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">FirstName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->first_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">DateOfBirth</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->date_of_birth }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Gender</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->gender }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Address</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->address }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">PhoneNumber</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->phone_number }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Email</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->email }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Branch</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->branch_name }}</td>
                            </tr>
                            
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Department</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->department_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Created At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->created_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastUpdated</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $staff->updated_at }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/staffs/{{$staff->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>