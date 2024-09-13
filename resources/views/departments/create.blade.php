<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Department') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert>
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/departments" class="text-blue-600 hover:underline">Departments</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">New Department</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('departments.store') }}">
                        @csrf

                        <div >
                            <x-label for="department_name" value="{{ __('Department Name:') }}" />
                            <x-input id="department_name" class="block mt-1 w-full" type="text" name="department_name" :value="old('department_name')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="department_head" value="{{ __('Department Head:') }}" />
                            <select class="block mt-1 w-full rounded" name="department_head" id="department_head">
                                <option value=""> ...</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->last_name . ' ' . $staff->first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Department') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>