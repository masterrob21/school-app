<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('guardian Edit for: ') . session('name') }}
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
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">Guardian</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/studentGuardian/{{$student_guardian->id}}">
                        @csrf
                        @method('PATCH')

                        <div class="mt-4">
                            <x-label for="guardian_id" value="{{ __('Parent/Guardian:') }}" />
                            <x-select id="guardian_id" class="block mt-1 w-full capitalize" name="guardian_id" required>
                                <option value="{{$student_guardian->guardian_id}}">{{$student_guardian->last_name . ' ' . $student_guardian->first_name}}
                                    @foreach ($guardians as $guardian)
                                        <option value="{{$guardian->id}}">{{$guardian->last_name . ' ' . $guardian->first_name}}</option>
                                    @endforeach
                                </option>
                            </x-select>
                        </div>

                        <div class="mt-4">
                            <x-label for="relation_id" value="{{ __('Relation:') }}" />
                            <x-select class="block mt-1 w-full capitalize" name="relation_id" id="relation_id" required>
                                <option value="{{$student_guardian->relation_id}}">{{$student_guardian->relation}}</option>
                                @foreach ($relations as $relation)
                                    <option value="{{$relation->id}}">{{$relation->relation}}</option>
                                @endforeach
                            </x-select>
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