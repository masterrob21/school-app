<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Occupation') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-alert class="bg-green-400">
            {{ session('status') }}
        </x-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/occupations" class="text-blue-600 hover:underline">Occupations</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">New Occupation</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('occupations.store') }}">
                        @csrf

                        <div >
                            <x-label for="occupation" value="{{ __('Occupation Name:') }}" />
                            <x-input id="occupation" class="block mt-1 w-full" type="text" name="occupation" :value="old('occupation')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Occupation') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>