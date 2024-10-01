<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            {{ $student->other_names . ' ' . $student->last_name }}
        </h2>
    </x-slot>

    @if (session('status'))
    <x-success-alert id="alert_message">
        {{ session('status') }}
    </x-success-alert>
    @endif

    @if (session('warning'))
    <x-danger-alert id="alert_message">
        {{ session('warning') }}
    </x-danger-alert>
    @endif

    @if (session('info'))
    <x-info-alert id="alert_message">
        {{ session('info') }}
    </x-info-alert>
    @endif

    <div class="py-10">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <ul class="px-4 py-2 list-none bg-slate-200">
                    <li class=" inline text-lg"><a href="/students" class="text-blue-600 hover:underline">Students</a></li>
                    <li class="inline text-lg before:p-2 before:content-['/']">Student Details</li>
                </ul>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" overflow-x-auto">
                        <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                            <caption class=" caption-top mb-4 text-xl text-blue-600 text-left md:text-center">Student Information</caption>
                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Photo</th>
                                <td class="p-3 border border-slate-300 text-xl">
                                    @if ($student->photo_path)
                                    <img class="rounded h-28 w-28 object-cover mb-2" src="{{asset('storage/'.$student->photo_path)}}" alt="no image">
                                        <form action="" method="POST" id="remove_image">
                                            @csrf
                                            @method('DELETE')

                                            <button id="{{$student->id}}" class="rounded bg-red-500 p-2 text-sm remove_image">Remove</button>
                                        </form>
                                    @else
                                        <a href="/updateStudentImage/{{$student->id}}/edit" class="rounded capitalize bg-green-500 text-white p-2 text-sm">insert image</a>                          
                                    @endif
                                </td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">EnrollmentDate</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ date('d-M-Y', strtotime($student->enrollment_date)) }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">StudentID</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->student_id }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastName</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->last_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">OtherNames</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->other_names }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">DateOfBirth</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ date('d-M-Y', strtotime($student->date_of_birth)) }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Gender</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->gender }}</td>
                            </tr>

                            <tr class=" ">
                                <th class="p-3 border border-slate-300">Address</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->address }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Phone</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->phone_number }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Email</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->email }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Branch</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ $student->branch_name }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">Created At</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ date('d-M-Y H:i:s', strtotime($student->created_at)) }}</td>
                            </tr>

                            <tr class=" whitespace-nowrap">
                                <th class="p-3 border border-slate-300">LastUpdated</th>
                                <td class="p-3 border border-slate-300 text-xl">{{ date('d-M-Y H:i:s', strtotime($student->updated_at)) }}</td>
                            </tr>

                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="/students/{{$student->id}}/edit" class=" rounded bg-blue-300 py-2 px-3 text-lg">Edit</a>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-3">
                            <a href="{{route('education-history.create')}}" class="p-3 rounded bg-blue-400 text-white font-bold">Add Education</a>
                        </div>
                        
                        @if (count($education_histories)>0)
                        <div class="overflow-x-auto">
                            <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                                <caption class="text-xl mb-4 text-left md:text-center">Educational History</caption>
                                <thead class="bg-blue-300">
                                    <tr class="border-b whitespace-nowrap">
                                        <th class="p-3">Action</th>
                                        <th class="p-3">Previous School</th>
                                        <th class="p-3">Attended Date</th>
                                        <th class="p-3">End Date</th>
                                        <th class="p-3">Level/Class</th>
                                    </tr>
                                </thead>

                                <tbody> 
                                    @forelse ($education_histories as $education_history)
                                    <tr class="border-b whitespace-nowrap">
                                        <td class="p-2 flex items-center space-x-1">
                                            <a href="/education-history/{{$education_history->id}}/edit" class="p-1 bg-slate-400 hover:bg-slate-300 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>     
                                            </a> 

                                            <form action="" method="POST" id="delete_form">
                                                @csrf
                                                @method('DELETE')
                                                <button id="{{$education_history->id}}"  class="btn_remove p-1 bg-red-400 hover:bg-red-300 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td> 
                                        <td class="p-3 capitalize">{{ $education_history->previous_school }}</td>
                                        <td class="p-3">{{ date('d-M-Y', strtotime($education_history->attended_date)) }}</td>
                                        <td class="p-3">{{ date('d-M-Y', strtotime($education_history->end_date)) }}</td>
                                        <td class="p-3">{{ $education_history->level }}</td>
                                    </tr> 
                                    @empty
                                    <tr class=" whitespace-nowrap">
                                       <td colspan="5" class="p-3 text-xl text-red-400 font-bold"><h2>No record found</h2></td> 
                                    </tr>   
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-3">
                            <a href="{{route('studentGuardian.create')}}" class="p-3 rounded bg-blue-400 text-white font-bold">Add Guardian</a>
                        </div>
                        
                        @if (count($student_guardians)>0)
                        <div class="overflow-x-auto">
                            <table class="table-auto border-collapse border border-slate-400 w-full text-left">
                                <caption class="text-xl mb-4 text-left md:text-center">List of Guardian</caption>
                                <thead class="bg-blue-300">
                                    <tr class="border-b whitespace-nowrap">
                                        <th class="p-3">Action</th>
                                        <th class="p-3">Guardian</th>
                                        <th class="p-3">Relation</th>
                                        <th class="p-3">Phone</th>
                                    </tr>
                                </thead>

                                <tbody> 
                                    @foreach ($student_guardians as $student_guardian)
                                    <tr class="border-b whitespace-nowrap">
                                        <td class="p-2 flex items-center space-x-1">
                                            <a href="/studentGuardian/{{$student_guardian->id}}/edit" class="p-1 bg-slate-400 hover:bg-slate-300 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>     
                                            </a> 

                                            <form action="" method="POST" id="delete_form1">
                                                @csrf
                                                @method('DELETE')
                                                <button id="{{$student_guardian->id}}"  class="btn_remove1 p-1 bg-red-400 hover:bg-red-300 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td> 
                                        <td class="p-3 capitalize">{{ $student_guardian->first_name . ' ' . $student_guardian->last_name }}</td>
                                        <td class="p-3">{{ $student_guardian->relation }}</td>
                                        <td class="p-3">{{ $student_guardian->primary_number }}</td>
                                    </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function(){
            setTimeout(() => {
                $('#alert_message').fadeOut();
            }, 3000);

            $(document).on('click', '.btn_remove', function(event){
                event.preventDefault();

                const form = document.getElementById('delete_form');
                const id = $(this).attr('id');
                const dialog = confirm('You are about to delete a record, Click "Ok" to proceed.');

                form.action = '/education-history/' + id;
                if (dialog) {
                    $('#delete_form').submit();
                }
            });

            $(document).on('click', '.btn_remove1', function(event){
                event.preventDefault();

                const form = document.getElementById('delete_form1');
                const id = $(this).attr('id');
                const dialog = confirm('You are about to delete a record, Click "Ok" to proceed.');

                form.action = '/studentGuardian/' + id;
                if (dialog) {
                    $('#delete_form1').submit();
                }
            });

            $(document).on('click', '.remove_image', function(event){
                event.preventDefault();

                const form = document.getElementById('remove_image');
                const id = $(this).attr('id');
                const dialog = confirm('You are about to remove student photo, Click "Ok" to proceed.');

                form.action = '/updateStudentImage/' + id;
                if (dialog) {
                    $('#remove_image').submit();
                }
            });

        });
    </script>

</x-app-layout>