<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ $user->name }}
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
                    <li class=" inline text-lg"><a href="/user" class="text-blue-600 hover:underline">Users</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">User Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600">User Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Name</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $user->name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Email</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $user->email }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Branch</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $user->branch_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Created At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $user->created_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Updated At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $user->updated_at }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">IsActive</th>
                                <td class="p-3 border border-slate-300">
                                    <input 
                                    type="checkbox" 
                                    @checked($user->is_active)
                                    @disabled(true)
                                    />
                                </td>
                            </tr>

                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/user/{{$user->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
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