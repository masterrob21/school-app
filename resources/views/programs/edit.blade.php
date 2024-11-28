<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit program: {{ $program->program }}
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
                    <li class=" inline text-lg"><a href="/programs" class="text-blue-600 hover:underline capitalize">programs</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit program</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/programs/{{$program->id}}" >
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="program_type_id" value="{{ __('Program:') }}" />
                            <x-select id="program_type_id" class="block mt-1 w-full uppercase" name="program_type_id" required>
                                <option value="{{$program->program_type_id}}">{{ $program->program_type }}</option>
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="program" value="{{ __('Name:') }}" />
                            <x-input id="program" class="block mt-1 w-full capitalize" type="text" name="program" value="{{$program->program}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="sort_order" value="{{ __('Sort Order:') }}" />
                            <x-input id="sort_order" class="block mt-1 w-full" type="text" name="sort_order" value="{{$program->sort_order}}" required />
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