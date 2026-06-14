<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit Course: {{ $classroom->classroom }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert>
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/classrooms" class="text-blue-600 hover:underline capitalize">classrooms</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/classrooms/{{$classroom->id}}" class="text-blue-600 hover:underline capitalize">classroom Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit classroom</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/classrooms/{{$classroom->id}}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="school_class_id" value="{{ __('School Class:') }}" />
                            <x-select id="school_class_id" class="block mt-1 w-full capitalize" name="school_class_id" required>
                                <option value="{{ $classroom->school_class_id }}">{{ $classroom->school_class_name }}</option>
                                @foreach ($schoolClasses as $schoolClass)
                                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div>
                            <x-label for="classroom" value="{{ __('classroom:') }}" />
                            <x-input id="classroom" class="block mt-1 w-full" type="text" name="classroom" value="{{$classroom->classroom}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="staff_id" value="{{ __('Class Teacher:') }}" />
                            <x-select id="staff_id" class="block mt-1 w-full" name="staff_id">
                                <option value="{{$classroom->staff_id}}">{{ $classroom->last_name . ' ' . $classroom->first_name }}</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{$staff->id}}">{{ $staff->last_name . ' ' . $staff->first_name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="capacity" value="{{ __('Class Capacity:') }}" />
                            <x-input class="block mt-1 w-full" type="text" name="capacity" id="capacity" value="{{$classroom->capacity}}" required />
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