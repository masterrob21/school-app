<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit role permission for : <span class="text-red-600">{{ $role->name }}</span>
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert id="alert_message">
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/roles" class="text-blue-600 hover:underline capitalize">roles</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit role permission</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />
    
                    <form method="POST" action="/role-permissions/{{$role->id}}" >
                        @csrf
                        @method('PATCH')
                        <div>
                            <table class="table-auto w-full border-collapse border border-slate-400">
                                <caption class="mb-2 text-red-600 uppercase text-xl text-left md:text-center"><h2>{{$role->name}}</h2></caption>
                                <thead>
                                    <tr>
                                        <th class="p-3 text-left text-xl">Permissions</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td class="p-3 border border-slate-400">
                                            <label>
                                                <input 
                                                    type="checkbox" 
                                                    name="permission[]" value="{{$permission->name}}"
                                                    {{in_array($permission->id, $rolePermissions) ? 'checked':''}}
                                                >
                                                {{$permission->name}}
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    
                        <div class="mt-4">
                            <x-button>
                                {{ __('Update Record') }}
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