<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ $program->program }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-info-alert id="alert_message">
        {{ session('status') }}
    </x-info-alert>
    @endif

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/programs" class="text-blue-600 hover:underline capitalize">programs</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">program details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600 text-left md:text-center capitalize">
                                program Information
                            </caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">program:</th>
                                <td class="p-3 border border-slate-300 text-xl uppercase">{{ $program->program_type }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">name:</th>
                                <td class="p-3 border border-slate-300 text-xl capitalize">{{ $program->program }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">sort order:</th>
                                <td class="p-3 border border-slate-300 text-xl capitalize">{{ $program->sort_order }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">Created at:</th>
                                <td class="p-3 border border-slate-300 text-xl capitalize">{{ $program->created_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300 capitalize">updated at:</th>
                                <td class="p-3 border border-slate-300 text-xl capitalize">{{ $program->updated_at }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/programs/{{$program->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
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
        })
    </script>
</x-app-layout>