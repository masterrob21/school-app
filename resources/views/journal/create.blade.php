<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Journal entry') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert id="alert_message">
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/guardians" class="text-blue-600 hover:underline capitalize">guardian</a></li>
                    <li class="inline text-lg capitalize before:p-2 before:content-['/']">New guardian</li>
                </ul>
            </div> --}}

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('general-journal.store') }}">
                        @csrf

                        <div class="grid gap-6 grid-cols-1 md:grid-cols-2">
                            <div>
                                <div class="text-xl font-bold bg-red-400 p-4">
                                    <h2>Debit Account</h2>
                                </div>
                                <div class="mt-4">
                                    <x-label for="valued_date" value="{{ __('Valued Date') }}" />
                                    <x-input id="valued_date" class="block mt-1 w-full" type="date" name="valued_date" :value="old('valued_date')" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <x-label for="account_chart_id" value="{{ __('Chart of Account') }}" />
                                    <x-select name="account_chart_id" id="account_chart_id" class="block mt-1 w-full" :value="old('account_chart_id')" required>
                                        <option value="">Chart of Account</option>
                                        @foreach ($accountCharts as $accountChart)
                                            <option value="{{$accountChart->id}}">{{$accountChart->account_head}}</option>
                                        @endforeach
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="ledger_account_id" value="{{ __('Ledger Account') }}" />
                                    <x-select name="ledger_account_id" id="ledger_account_id" class="block mt-1 w-full capitalize" :value="old('ledger_account_id')" required>
                                        <option value=""> ...</option>
                                       
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="payment_mode_id" value="{{ __('Mode of payment') }}" />
                                    <x-select name="payment_mode_id" id="payment_mode_id" class="block mt-1 w-full" :value="old('payment_mode_id')" required>
                                        <option value=""> ...</option>
                                        @foreach ($paymentModes as $paymentMode)
                                            <option value="{{$paymentMode->id}}">{{$paymentMode->payment_mode}}</option>
                                        @endforeach
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="currency_id" value="{{ __('Currency') }}" />
                                    <x-select name="currency_id" id="currency_id" class="block mt-1 w-full capitalize" :value="old('currency_id')" required>
                                        <option value=""> ...</option>
                                        @foreach ($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->currency}}</option>
                                        @endforeach
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="amount" value="{{ __('Amount') }}" />
                                    <x-input id="amount" class="block mt-1 w-full capitalize" type="text" name="amount" :value="old('amount')" required />
                                </div>

                            </div>

                            <div>
                                <div class="text-xl font-bold bg-green-400 p-4">
                                    <h2>Credit Account</h2>
                                </div>

                                <div class="mt-4">
                                    <x-label for="account_chart_id1" value="{{ __('Chart of Account') }}" />
                                    <x-select name="account_chart_id1" id="account_chart_id1" class="block mt-1 w-full" :value="old('account_chart_id1')" required>
                                        <option value="">Chart of Account</option>
                                        @foreach ($accountCharts as $accountChart)
                                            <option value="{{$accountChart->id}}">{{$accountChart->account_head}}</option>
                                        @endforeach
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="ledger_account_id1" value="{{ __('Ledger Account') }}" />
                                    <x-select name="ledger_account_id1" id="ledger_account_id1" class="block mt-1 w-full capitalize" :value="old('ledger_account_id1')" required>
                                        <option value=""> ...</option>
                                       
                                    </x-select>
                                </div>

                                <div class="mt-4">
                                    <x-label for="description" value="{{ __('Description') }}" />
                                    <textarea name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" id="description" cols="30" rows="3" required></textarea>
                                </div>

                            </div>

                        </div>
                        

                       

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add journal') }}
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

            $(document).on('change', '#account_chart_id', function(){
                const account_chart_id = $(this).val();

                $.ajax({
                    url:"{{route('fetchledger.fetch')}}",
                    method:'get',
                    data:{id: account_chart_id},
                    success:function(data){
                        $('#ledger_account_id').html(data);
                    }
                });
            });

            $(document).on('change', '#account_chart_id1', function(){
                const account_chart_id = $(this).val();

                $.ajax({
                    url:"{{route('fetchledger.fetch')}}",
                    method:'get',
                    data:{id: account_chart_id},
                    success:function(data){
                        $('#ledger_account_id1').html(data);
                    }
                });
            });

        })
    </script>
</x-app-layout>