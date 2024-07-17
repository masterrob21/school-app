<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Education History Edit: ') . session('name') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <x-alert class="bg-green-400">
            {{ session('success') }}
        </x-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students/{{session('student_id')}}" class="text-blue-600 hover:underline">Student Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Previous Education</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/education-history/{{$education->id}}">
                        @csrf
                        @method('PATCH')

                        <div class="mt-4">
                            <x-label for="previous_school" value="{{ __('Previous School:') }}" />
                            <x-input id="previous_school" class="block mt-1 w-full" type="text" name="previous_school" value="{{$education->previous_school}}" required autocomplete="previous_school" />
                        </div>

                        <div class="mt-4">
                            <x-label for="attended_date" value="{{ __('Attended Date:') }}" />
                            <x-input class="block mt-1 w-full" type="date" name="attended_date" id="attended_date" value="{{$education->attended_date}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="end_date" value="{{ __('End Date:') }}" />
                            <x-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" value="{{$education->end_date}}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="level" value="{{ __('Class/Level:') }}" />
                            <x-input id="level" class="block mt-1 w-full" type="text" name="level" value="{{$education->level}}" required />
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