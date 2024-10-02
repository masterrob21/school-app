<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staffs') }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-success-alert id="alert_message">
        {{ session('status') }}
    </x-success-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <div class="mt-2">
                            <a href="{{route('staffs.create')}}" class="p-3 capitalize rounded bg-green-300 hover:bg-green-500 whitespace-nowrap">New Staff</a>
                        </div>
                        <div class="">
                            <input id="search" type="text" class="rounded sm:w-96 w-full" placeholder="Search by lastName or firstName">
                        </div>
                    </div>
                    <div class="overflow-x-auto" id="search_results">
                        @include('staffs.fetch')
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

            $(document).on('click', '.btn_remove', function(event){
                event.preventDefault();

                const form = document.getElementById('delete_form');
                const id = $(this).attr('id');
                const dialog = confirm('You are about to delete a record, Click "Ok" to proceed.');

                form.action = 'staffs/' + id;
                if (dialog) {
                    $('#delete_form').submit();
                }
            });

            $('#search').keyup(function(){
                const search = $(this).val();

                $.ajax({
                    url:"{{route('staffs.fetch')}}",
                    method:'get',
                    data:{id: search},
                    success:function(data){
                        $('#search_results').html(data);
                        
                    }
                });
            });

        });
    </script>
</x-app-layout>