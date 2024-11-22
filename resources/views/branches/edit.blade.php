<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit branch: {{ $branch->branch_name }}
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
                    <li class=" inline text-lg"><a href="/branches" class="text-blue-600 hover:underline capitalize">branches</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/branches/{{$branch->id}}" class="text-blue-600 hover:underline capitalize">branch Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit branch</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/branches/{{$branch->id}}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="branch_code" value="{{ __('Branch Code:') }}" />
                            <x-input id="branch_code" class="block mt-1 w-full capitalize" type="text" name="branch_code" value="{{$branch->branch_code}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="branch_name" value="{{ __('Branch Name:') }}" />
                            <x-input id="branch_name" class="block mt-1 w-full capitalize" type="text" name="branch_name" value="{{$branch->branch_name}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="location" value="{{ __('Location:') }}" />
                            <x-input id="location" class="block mt-1 w-full capitalize" type="text" name="location" value="{{$branch->location}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="manager" value="{{ __('Manager:') }}" />
                            <x-input class="block mt-1 w-full capitalize" type="text" name="manager" id="manager" value="{{$branch->manager}}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="telephone" value="{{ __('Contact #:') }}" />
                            <x-input id="telephone" class="block mt-1 w-full capitalize" type="text" name="telephone" value="{{$branch->telephone}}" />
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