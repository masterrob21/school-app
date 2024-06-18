<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $course->course_name }}
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
                    <li class=" inline text-lg"><a href="/courses" class="text-blue-600 hover:underline">Courses</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Course Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600">Course Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Course Code:</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $course->course_code }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Course Name:</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $course->course_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Description</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $course->course_description }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Credits</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $course->credits }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/courses/{{$course->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>