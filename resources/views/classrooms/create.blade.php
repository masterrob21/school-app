<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('new classroom') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-success-alert id="alert_message">
            {{ session('success') }}
        </x-success-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/classrooms" class="text-blue-600 hover:underline capitalize">classrooms</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">New classroom</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('classrooms.store') }}">
                        @csrf

                        <div >
                            <x-label for="classroom" value="{{ __('Classroom:') }}" />
                            <x-input id="classroom" class="block mt-1 w-full capitalize" type="text" name="classroom" :value="old('classroom')" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="staff_id" value="{{ __('Class Teacher:') }}" />
                            <x-select id="staff_id" class="block mt-1 w-full capitalize" name="staff_id">
                                <option value=""> ...</option>
                                @foreach ($staffs as $staff)
                                    <option value="{{$staff->id}}">{{ $staff->last_name . ' ' . $staff->first_name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="capacity" value="{{ __('Class Capacity:') }}" />
                            <x-input class="block mt-1 w-full" name="capacity" id="capacity" :value="old('capacity')" required />
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add class') }}
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