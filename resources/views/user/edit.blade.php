<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit User: {{  $user->name }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-info-alert id="alert_message">
            {{ session('success') }}
        </x-info-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/user" class="text-blue-600 hover:underline">Users</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/user/{{$user->id}}" class="text-blue-600 hover:underline">User Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Edit User</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/user/{{$user->id}}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$user->name}}" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$user->email}}" required autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="branch" value="{{ __('Branch') }}" />
                            <select name="branch" id="branch" class="block mt-1 w-full rounded-md" required>
                                <option value="{{$user->branch_id}}">{{$user->branch_name}} </option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="is_active">
                                IsActive
                                <input 
                                    id="is_active" type="checkbox" name="is_active" value="1"
                                        @checked($user->is_active)
                                />
                            </label>
                            
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Update User') }}
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