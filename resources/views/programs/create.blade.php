<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('New program') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-success-alert id="alert_message">
            {{ session('status') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/programs" class="text-blue-600 hover:underline capitalize">programs</a></li>
                    <li class="inline text-lg capitalize before:p-2 before:content-['/']">New program</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('programs.store') }}">
                        @csrf

                        <div >
                            <x-label for="program_type_id" value="{{ __('Program:') }}" />
                            <x-select id="program_type_id" class="block mt-1 w-full uppercase" name="program_type_id" required autofocus>
                                <option value=""> ...</option>
                                @foreach ($programTypes as $programType)
                                    <option value="{{$programType->id}}" @selected(old('program_type_id')==$programType->id)>{{ $programType->program_type }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="program" value="{{ __('Name:') }}" />
                            <x-input id="program" class="block mt-1 w-full capitalize" type="text" name="program" :value="old('program')" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="sort_order" value="{{ __('Sort Order:') }}" />
                            <x-input id="sort_order" class="block mt-1 w-full" type="text" name="sort_order" :value="old('sort_order')" required />
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add program') }}
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