<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Student') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert>
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students" class="text-blue-600 hover:underline">Students</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">New Student</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div >
                            <x-label for="enrollment_date" value="{{ __('EnrollmentDate') }}" />
                            <x-input id="enrollment_date" class="block mt-1 w-full" type="date" name="enrollment_date" :value="old('enrollment_date')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="last_name" value="{{ __('LastName') }}" />
                            <x-input id="last_name" class="block mt-1 w-full capitalize" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="other_names" value="{{ __('OtherNames') }}" />
                            <x-input id="other_names" class="block mt-1 w-full capitalize" type="text" name="other_names" :value="old('other_names')" required autocomplete="other_names" />
                        </div>

                        <div class="mt-4">
                            <x-label for="date_of_birth" value="{{ __('DateOFBirth') }}" />
                            <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="date_of_birth" />
                        </div>

                        <div class="mt-4">
                            <x-label for="gender_id" value="{{ __('Gender') }}" />
                            <x-select name="gender_id" id="gender_id" class="block mt-1 w-full" :value="old('gender_id')" required>
                                <option value=""> ...</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                @endforeach
                            </x-select>
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
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="branch_id" value="{{ __('Branch') }}" />
                            <x-select name="branch_id" id="branch_id" class="block mt-1 w-full rounded" :value="old('branch_id')" required >
                                <option value=""> ...</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="photo_path" value="{{ __('Photo') }}" />
                            <x-input id="photo_path" class="block mt-1 w-full" type="file" name="photo_path" :value="old('photo_path')" />
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Student') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>