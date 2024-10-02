<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ $guardian->first_name . ' ' . $guardian->last_name }}
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
                    <li class=" inline text-lg"><a href="/guardians" class="text-blue-600 hover:underline capitalize">guardian</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">guardian Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600 capitalize text-left md:text-center">guardian Information</caption>

                            <tr class=" whitespace-nowrap capitalize">
                                <th class="p-3 border border-slate-300">LastName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->last_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap capitalize">
                                <th class="p-3 border border-slate-300">FirstName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->first_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap capitalize">
                                <th class="p-3 border border-slate-300">Occupation</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->occupation }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap capitalize">
                                <th class="p-3 border border-slate-300">primary number</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->primary_number }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap capitalize">
                                <th class="p-3 border border-slate-300">secondary number</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->secondary_number }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Email</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->email }}</td>
                            </tr>

                            <tr class="capitalize">
                                <th class="p-3 border border-slate-300">Address</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->address }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Created At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->created_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastUpdated</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $guardian->updated_at }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/guardians/{{$guardian->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(documemt).ready(function(){
            setTimeout(() => {
                $('#alert_message').fadeOut();
            }, 3000);
        })
    </script>
</x-app-layout>