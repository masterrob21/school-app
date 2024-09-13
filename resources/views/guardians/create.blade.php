<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('New guardian') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert >
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/guardians" class="text-blue-600 hover:underline capitalize">guardian</a></li>
                    <li class="inline text-lg capitalize before:p-2 before:content-['/']">New guardian</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('guardians.store') }}">
                        @csrf

                        <div>
                            <x-label for="last_name" value="{{ __('LastName') }}" />
                            <x-input id="last_name" class="block mt-1 w-full capitalize" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="first_name" value="{{ __('FirstName') }}" />
                            <x-input id="first_name" class="block mt-1 w-full capitalize" type="text" name="first_name" :value="old('first_name')" required autocomplete="first_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="occupation_id" value="{{ __('Occupation') }}" />
                            <x-select name="occupation_id" id="occupation_id" class="block mt-1 w-full" :value="old('occupation_id')" required>
                                <option value=""> ...</option>
                                @foreach ($occupations as $occupation)
                                    <option value="{{$occupation->id}}">{{$occupation->occupation}}</option>
                                @endforeach
                            </x-select>
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="primary_number" value="{{ __('PrimaryNumber') }}" />
                            <x-input id="primary_number" class="block mt-1 w-full" type="text" name="primary_number" :value="old('primary_number')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="secondary_number" value="{{ __('SecondaryNumber') }}" />
                            <x-input id="secondary_number" class="block mt-1 w-full" type="text" name="secondary_number" :value="old('secondary_number')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                        </div>

                        <div class="mt-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full capitalize" type="text" name="address" :value="old('address')" required autocomplete="address" />
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add guardian') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>