<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Currency') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert id="alert_message">
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/currency" class="text-blue-600 hover:underline capitalize">currency</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">currency</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('currency.store') }}">
                        @csrf

                        <div >
                            <x-label for="id" value="{{ __('Currency Code:') }}" />
                            <x-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="currency" value="{{ __('Currency:') }}" />
                            <x-input id="currency" class="block mt-1 w-full capitalize" type="text" name="currency" :value="old('currency')" required />
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Currency') }}
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