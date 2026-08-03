<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Journal Transactions') }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-success-alert id="alert_message">
        {{ session('status') }}
    </x-success-alert>
    @endif

    @if (session('warning'))
    <x-danger-alert id="alert_message">
        {{ session('warning') }}
    </x-danger-alert>
    @endif

    @if (session('info'))
    <x-info-alert id="alert_message">
        {{ session('info') }}
    </x-info-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/accounting" class="text-blue-600 hover:underline capitalize">accounting</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Transaction</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-wrap mb-2 justify-center">
                        <div class="mb-2">
                            <label for="from" class="font-bold">From: </label>
                            <input type="date" class="rounded-md" id="from">
                        </div>
                        <div class="ml-3">
                            <label for="to" class="font-bold">To: </label>
                            <input type="date" class="rounded-md" id="to">
                        </div>
                    </div>
                    
                    @can('view transaction')   
                    <div class="mb-4" align="center">
                        <button class="p-2 bg-blue-300 rounded-md" id="load">Load</button>
                    </div>
                    @endcan

                    <div class="overflow-x-auto h-auto " id="search_results">
                        @include('journal.get-transaction')
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function(){

            setTimeout(() => {
                $('#alert_message').fadeOut();
            }, 3000);

            $('#load').click(function(){
                const from = $('#from').val();
                const to = $('#to').val();

                if (from == ''){
                    alert('Start date is required')
                    return;
                }

                if (to == ''){
                    alert('End date is required')
                    return;
                }

                if (from > to) {
                    alert('Start date cannot be greater than End date');
                    return;
                }

                $.ajax({
                    url:"{{route('general-journal.getTransactions')}}",
                    method:'GET',
                    data:{from:from, to:to},
                    success:function(data){
                        $('#search_results').html(data);
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                        
                    }
                });
            });

        });
    </script>
</x-app-layout>