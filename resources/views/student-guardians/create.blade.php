<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('parent / guardian: ') . session('name') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-alert class="bg-green-400">
            {{ session('status') }}
        </x-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students/{{session('student_id')}}" class="text-blue-600 hover:underline capitalize">Student Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">parent / guardian</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('studentGuardian.store') }}">
                        @csrf

                        <div >
                            <x-input id="student_id" class="block mt-1 w-full" type="hidden" name="student_id" value="{{session('student_id')}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="guardian_id" value="{{ __('Parent/Guardian:') }}" />
                            <x-select id="guardian_id" class="block mt-1 w-full" name="guardian_id" required autofocus>
                                <option value=""> ...</option>
                                @foreach ($guardians as $guardian)
                                    <option value="{{$guardian->id}}">{{$guardian->first_name . ' ' . $guardian->last_name . ' | ' . $guardian->primary_number}}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="relation_id" value="{{ __('Relation:') }}" />
                            <x-select id="relation_id" class="block mt-1 w-full" name="relation_id" required>
                                <option value=""> ...</option>
                                @foreach ($relations as $relation)
                                    <option value="{{$relation->id}}">{{$relation->relation}}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mt-4 capitalize">
                            <x-button>
                                {{ __('Add guardian') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>