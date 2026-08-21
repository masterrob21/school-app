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

                        @php
                            $groupedPermissions = $permissions->groupBy('module')->sortKeys();
                        @endphp

                        <div class="space-y-4">
                            @foreach ($groupedPermissions as $module => $modulePermissions)
                                <fieldset class="border border-slate-300 rounded-md p-4">
                                    <legend class="px-2 text-lg font-semibold capitalize text-gray-700">
                                        {{ $module }}
                                    </legend>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach ($modulePermissions as $permission)
                                            <label class="flex items-center gap-2 rounded border border-slate-200 p-2 hover:bg-slate-50">
                                                <input
                                                    type="checkbox"
                                                    name="permission[]"
                                                    value="{{$permission->name}}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                >
                                                <span class="capitalize">{{$permission->name}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach
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