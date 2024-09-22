<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit staff: {{ $staff->first_name . ' ' . $staff->last_name }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert id="alert_message">
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg capitalize"><a href="/staffs" class="text-blue-600 hover:underline">Staff</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/staffs/{{$staff->id}} capitalize" class="text-blue-600 hover:underline">Staff Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit staff</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/staffs/{{$staff->id}}">
                        @csrf
                        @method('PATCH')

                        <div >
                            <x-label for="hire_date" value="{{ __('HireDate') }}" />
                            <x-input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" value="{{$staff->hire_date}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="last_name" value="{{ __('LastName') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{$staff->last_name}}" required autocomplete="last_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="first_name" value="{{ __('FirstName') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{$staff->first_name}}" required autocomplete="first_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="date_of_birth" value="{{ __('DateOFBirth') }}" />
                            <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" value="{{$staff->date_of_birth}}" required autocomplete="date_of_birth" />
                        </div>

                        <div class="mt-4">
                            <x-label for="gender_id" value="{{ __('Gender') }}" />
                            <select name="gender_id" id="gender_id" class="block mt-1 w-full rounded" required>
                                <option value="{{$staff->gender_id}}">{{$staff->gender}}</option>
                                @foreach ($genders as $gender)
                                    <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{$staff->address}}" required autocomplete="address" />
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="phone_number" value="{{ __('PhoneNumber') }}" />
                            <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{$staff->phone_number}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$staff->email}}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="branch_id" value="{{ __('Branch') }}" />
                            <select name="branch_id" id="branch_id" class="block mt-1 w-full rounded" value="old('branch_id')" required>
                                <option value="{{$staff->branch_id}}">{{$staff->branch_name}}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="department_id" value="{{ __('Department') }}" />
                            <select name="department_id" id="department_id" class="block mt-1 w-full rounded" value="old('department_id')">
                                <option value="{{$staff->department_id}}">{{$staff->department_name}}</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
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

    <script type="module">
        $(document).ready(function(){
            setTimeout(() => {
                $('#alert_message').fadeOut();
            }, 3000);
        })
    </script>
</x-app-layout>