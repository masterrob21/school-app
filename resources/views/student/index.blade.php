<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-success-alert id="alert_message">
        {{ session('status') }}
    </x-success-alert>
    @endif

    <div class="py-10">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <div class="mt-2">
                            <a href="{{route('students.create')}}" class="p-3 capitalize rounded bg-green-300 hover:bg-green-500 whitespace-nowrap">New Student</a>
                        </div>
                        <div class="">
                            <input type="text"  id="search_student" class="rounded sm:w-96 w-full" placeholder="Search by last name or first name or student id">
                        </div>
                    </div>
                    <div class="overflow-x-auto" id="result_data">
                        @include('student.search-results')
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

                form.action = 'students/' + id;
                if (dialog) {
                    $('#delete_form').submit();
                }
            });

            $('#search_student').keyup(function(){
                const search = $(this).val();

                $.ajax({
                    url:'/getStudent',
                    method:'get',
                    data:{id: search},
                    success:function(data){
                        $('#result_data').html(data);
                        
                    }
                });
            });

        });
    </script>
</x-app-layout>