<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guardians') }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-success-alert>
        {{ session('status') }}
    </x-success-alert>
    @endif

    @if (session('warning'))
    <x-danger-alert>
        {{ session('warning') }}
    </x-danger-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <div class="mt-2">
                            <a href="{{route('guardians.create')}}" class="p-3 capitalize rounded bg-green-300 hover:bg-green-500 whitespace-nowrap">New guardian</a>
                        </div>
                        <div class="">
                            <input type="text" class="rounded sm:w-96 w-full" placeholder="Search guardian">
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full text-left">
                            <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center capitalize">
                                List of guardians / parents
                            </caption>
                            <thead class="bg-blue-200">
                                <tr class="border-b  whitespace-nowrap">
                                    <th class="p-3">Action</th>
                                    <th class="p-3">LastName</th>
                                    <th class="p-3">FirstName</th>
                                    <th class="p-3">Occupation</th>
                                    <th class="p-3">Primary Contact</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (count($guardians)<1)
                                    <tr class="border-b">
                                        <td class="p-2 text-xl font-bold text-red-400"><h2>No records found.</h2></td>
                                    </tr>
                                @endif
                                @foreach ($guardians as $guardian)
                                    <tr class="border-b even:bg-gray-50 whitespace-nowrap capitalize">
                                        <td class="px-3 py-1 flex items-center space-x-1">
                                            <a href="guardians/{{$guardian->id}}" class="p-2 bg-slate-400 hover:bg-slate-300 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>     
                                            </a> 

                                            <form action="" method="POST" id="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <button id="{{$guardian->id}}"  class="btn_remove p-2 bg-red-400 hover:bg-red-300 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg> 
                                                </button>
                                            </form>
                                        </td>
                                        <td class="px-3 py-1 ">{{ $guardian->last_name }}</td>
                                        <td class="px-3 py-1 ">{{ $guardian->first_name }}</td>
                                        <td class="px-3 py-1 ">{{ $guardian->occupation }}</td>
                                        <td class="px-3 py-1 ">{{ $guardian->primary_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 overflow-x-auto">
                        {{ $guardians->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function(){

            $(document).on('click', '.btn_remove', function(event){
                event.preventDefault();

                const form = document.getElementById('delete_form');
                const id = $(this).attr('id');
                const dialog = confirm('You are about to delete a record, Click "Ok" to proceed.');

                form.action = 'guardians/' + id;
                if (dialog) {
                    $('#delete_form').submit();
                }
            });

        });
    </script>
</x-app-layout>