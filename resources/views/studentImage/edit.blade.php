<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ __('Photo for: ') . session('name') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <x-info-alert id="alert_message">
            {{ session('status') }}
        </x-info-alert>
    @endif

    <div class="py-10">
        <div class=" max-w-7xl mx-auto px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students/{{session('student_id')}}" class="text-blue-600 hover:underline capitalize">Student Details</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/'] capitalize">student image</li>
                </ul>
            </div>
        </div>

        <div class="w-full sm:max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="/updateStudentImage/{{session('student_id')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mt-4">
                            <x-label for="photo_path" value="{{ __('Student Photo:') }}" />
                            <x-input type="file" class="block mt-1 w-full" id="photo_path" name="photo_path" value="old('photo_path')" required />
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