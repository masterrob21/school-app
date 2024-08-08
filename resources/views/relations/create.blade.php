<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('New relation') }}
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
                    <li class=" inline text-lg"><a href="/relations" class="text-blue-600 hover:underline capitalize">relations</a></li>
                    <li class="inline text-lg capitalize before:p-2 before:content-['/']">New relation</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('relations.store') }}">
                        @csrf

                        <div >
                            <x-label for="relation" value="{{ __('Relation:') }}" />
                            <x-input id="relation" class="block mt-1 w-full" type="text" name="relation" :value="old('relation')" required autofocus />
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add relation') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>