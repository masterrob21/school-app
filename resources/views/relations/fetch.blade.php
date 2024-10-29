<table class="table-auto w-full text-left">
    <caption class="caption-top mb-4 text-xl font-bold text-left md:text-center capitalize">
        List of relations
    </caption>
    <thead class="bg-blue-200">
        <tr class="border-b  whitespace-nowrap capitalize">
            <th class="p-3">Action</th>
            <th class="p-3">relation</th>
    </thead>

    <tbody>
        @if (count($relations)<1)
            <tr class="border-b">
                <td colspan="2" class="p-3 text-xl font-bold text-red-400"><h2>No record found.</h2></td>
            </tr>
        @endif
        @foreach ($relations as $relation)
            <tr class="border-b even:bg-gray-50 whitespace-nowrap capitalize">
                <td class="p-3 flex items-center space-x-1">
                    <a href="relations/{{$relation->id}}/edit" class="p-2 bg-slate-400 hover:bg-slate-300 rounded">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white inline-block" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                        </svg>     
                    </a> 

                    <form action="" method="POST" id="delete_form">
                        @csrf
                        @method('DELETE')
                        <button id="{{$relation->id}}"  class="btn_remove p-2 bg-red-400 hover:bg-red-300 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        
                        </button>
                    </form>
                </td>
                <td class="p-3">{{ $relation->relation }}</td>                                    
            </tr>
        @endforeach
    </tbody>
</table>
{{-- <div class="mt-3 overflow-x-auto">
    {{ $relations->links() }}
</div> --}}