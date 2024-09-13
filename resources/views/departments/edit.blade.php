<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit Department: {{ $department->department_name }}
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
                    <li class=" inline text-lg"><a href="/departments" class="text-blue-600 hover:underline">Departments</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/departments/{{$department->id}}" class="text-blue-600 hover:underline">Department Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Edit Department</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/departments/{{$department->id}}" >
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="department_name" value="{{ __('Department Name:') }}" />
                            <x-input id="department_name" class="block mt-1 w-full" type="text" name="department_name" value="{{$department->department_name}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="department_head" value="{{ __('Department Head:') }}" />
                            <select class="block mt-1 w-full rounded capitalize" name="department_head" id="department_head">
                                <option value="{{$department->department_head}}">{{$department->last_name . ' ' . $department->first_name}}</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->last_name . ' ' . $staff->first_name}}</option>
                                @endforeach
                            </select>
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