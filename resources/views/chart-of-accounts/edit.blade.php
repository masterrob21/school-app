<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit Course: {{ $accountchart->accountchart }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert>
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/accountcharts" class="text-blue-600 hover:underline capitalize">chart of accounts</a></li>
                    <li class=" inline text-lg before:p-2 before:content-['/']"><a href="/accountcharts/{{$accountchart->id}}" class="text-blue-600 hover:underline capitalize">accountchart Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit accountchart</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/accountcharts/{{$accountchart->id}}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="account_head" value="{{ __('Account Head:') }}" />
                            <x-input id="account_head" class="block mt-1 w-full capitalize" type="text" name="account_head" value="{{$accountchart->account_head}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="account_type_id" value="{{ __('Class Teacher:') }}" />
                            <x-select id="account_type_id" class="block mt-1 w-full" name="account_type_id">
                                <option value="{{$accountchart->account_type_id}}">{{ $accountchart->account_type }}</option>
                                @foreach ($account_types as $account_type)
                                    <option value="{{$account_type->id}}">{{ $account_type->account_type }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="sort_order" value="{{ __('Sort Order:') }}" />
                            <x-input class="block mt-1 w-full" type="text" name="sort_order" id="sort_order" value="{{$accountchart->sort_order}}" required />
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
</x-app-layout>