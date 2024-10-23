<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ session('account_head') }}
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
                    <li class=" inline text-lg"><a href="/ledgeraccounts-getchartid/{{session('account_chart_id')}}" class="text-blue-600 hover:underline capitalize">ledger accounts</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">New ledger account</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('ledgeraccounts.store') }}">
                        @csrf

                        <div >
                            <x-label for="ledger_code" value="{{ __('Ledger Code:') }}" />
                            <x-input id="ledger_code" class="block mt-1 w-full capitalize" type="text" name="ledger_code" :value="old('ledger_code')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="ledger_name" value="{{ __('GL Account:') }}" />
                            <x-input id="ledger_name" class="block mt-1 w-full capitalize" type="text" name="ledger_name" :value="old('ledger_name')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="account_chart_id" value="{{ __('Account Head:') }}" />
                            <x-select id="account_chart_id" class="block mt-1 w-full capitalize" name="account_chart_id" required>
                                <option value="{{$accountchart->id}}"> {{ $accountchart->account_head }}</option>
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="sort_order" value="{{ __('Sort Order:') }}" />
                            <x-input class="block mt-1 w-full" name="sort_order" id="sort_order" :value="old('sort_order')" required />
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add record') }}
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