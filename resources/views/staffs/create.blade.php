<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Staff') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert>
            {{ session('success') }}
        </x-asuccess-lert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/staffs" class="text-blue-600 hover:underline">Staff</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">New Staff</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('staffs.store') }}">
                        @csrf

                        <div >
                            <x-label for="hire_date" value="{{ __('HireDate') }}" />
                            <x-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" :value="old('hire_date')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="last_name" value="{{ __('LastName') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="first_name" value="{{ __('FirstName') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="date_of_birth" value="{{ __('DateOFBirth') }}" />
                            <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="date_of_birth" />
                        </div>

                        <div class="mt-4">
                            <x-label for="gender_id" value="{{ __('Gender') }}" />
                            <select name="gender_id" id="gender_id" class="block mt-1 w-full" :value="old('gender_id')" required>
                                <option value=""> ...</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="phone_number" value="{{ __('PhoneNumber') }}" />
                            <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="branch_id" value="{{ __('Branch') }}" />
                            <select name="branch_id" id="branch_id" class="block mt-1 w-full" required>
                                <option value=""> ...</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="department_id" value="{{ __('Department') }}" />
                            <select name="department_id" id="department_id" class="block mt-1 w-full" required>
                                <option value=""> ...</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Staff') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>