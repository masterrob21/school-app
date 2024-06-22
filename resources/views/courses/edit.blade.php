<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit Course: {{ $course->course_name }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-alert class="bg-green-400">
            {{ session('success') }}
        </x-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/courses" class="text-blue-600 hover:underline">Courses</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/courses/{{$course->id}}" class="text-blue-600 hover:underline">Course Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Edit Course</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/courses/{{$course->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="course_code" value="{{ __('Course Code:') }}" />
                            <x-input id="course_code" class="block mt-1 w-full" type="text" name="course_code" value="{{$course->course_code}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="course_name" value="{{ __('Course Name:') }}" />
                            <x-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" value="{{$course->course_name}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="course_description" value="{{ __('Course Description:') }}" />
                            <textarea class="block mt-1 w-full" name="course_description" id="course_description" cols="30" rows="10" placeholder="Provide description for the course.">{{$course->course_description}}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="credits" value="{{ __('Credits:') }}" />
                            <x-input id="credits" class="block mt-1 w-full" type="number" name="credits" value="{{$course->credits}}" required />
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Update Record') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>