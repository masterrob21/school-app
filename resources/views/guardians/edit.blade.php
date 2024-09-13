<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit guardian: {{ $guardian->first_name . ' ' . $guardian->last_name }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert>
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg capitalize"><a href="/guardians" class="text-blue-600 hover:underline capitalize">guardian</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/guardians/{{$guardian->id}}" class="text-blue-600 hover:underline capitalize">guardian Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit guardian</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/guardians/{{$guardian->id}}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-label for="last_name" value="{{ __('LastName') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{$guardian->last_name}}" required autocomplete="last_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="first_name" value="{{ __('FirstName') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{$guardian->first_name}}" required autocomplete="first_name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="occupation_id" value="{{ __('Occupation') }}" />
                            <select name="occupation_id" id="occupation_id" class="block mt-1 w-full rounded" required>
                                <option value="{{$guardian->occupation_id}}">{{$guardian->occupation}}</option>
                                @foreach ($occupations as $occupation)
                                    <option value="{{$occupation->id}}">{{$occupation->occupation}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="primary_number" value="{{ __('PrimaryNumber') }}" />
                            <x-input id="primary_number" class="block mt-1 w-full" type="text" name="primary_number" value="{{$guardian->primary_number}}" required />
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="secondary_number" value="{{ __('SecondaryNumber') }}" />
                            <x-input id="secondary_number" class="block mt-1 w-full" type="text" name="secondary_number" value="{{$guardian->secondary_number}}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="address" value="{{ __('Address') }}" />
                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{$guardian->address}}" required autocomplete="address" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$guardian->email}}" />
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