<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $department->department_name }}
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
                    <li class=" inline text-lg"><a href="/departments" class="text-blue-600 hover:underline">Departments</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Course Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600">Department Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Department Name:</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $department->department_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">Department Head:</th>
                                <td class="p-3 border border-slate-300 text-xl capitalize">{{ $department->last_name . ' ' . $department->first_name }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/departments/{{$department->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>