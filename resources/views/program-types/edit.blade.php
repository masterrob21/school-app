<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
           Edit Program_Type: {{ $programType->program_type }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert id="alert_message">
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/programTypes" class="text-blue-600 hover:underline capitalize">program types</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Edit program_Type</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/programTypes/{{$programType->id}}" >
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="program_type" value="{{ __('Program Type:') }}" />
                            <x-input id="program_type" class="block mt-1 w-full uppercase" type="text" name="program_type" value="{{$programType->program_type}}" required />
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