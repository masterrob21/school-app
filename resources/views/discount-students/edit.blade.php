<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Discount Student Assignment') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('discount_students.update', $discountStudent) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        @php
                            $selectedStudentId = (int) old('student_id', $discountStudent->student_id);
                            $selectedStudent = $students->firstWhere('id', $selectedStudentId);
                            $selectedStudentLabel = $selectedStudent
                                ? $selectedStudent->student_id . ' - ' . trim($selectedStudent->other_names . ' ' . $selectedStudent->last_name)
                                : '';
                        @endphp

                        <div>
                            <label for="student_search" class="block text-sm font-medium text-gray-700">{{ __('Student') }}</label>
                            <input
                                type="text"
                                id="student_search"
                                list="student_options"
                                value="{{ old('student_search', $selectedStudentLabel) }}"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500"
                                placeholder="{{ __('Search by student ID or name') }}"
                                autocomplete="off"
                                required
                            >
                            <input type="hidden" name="student_id" id="student_id" value="{{ old('student_id', $discountStudent->student_id) }}" required>
                            <datalist id="student_options">
                                @foreach($students as $student)
                                    <option value="{{ $student->student_id }} - {{ trim($student->other_names . ' ' . $student->last_name) }}" data-student-id="{{ $student->id }}"></option>
                                @endforeach
                            </datalist>
                            @error('student_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="discount_id" class="block text-sm font-medium text-gray-700">{{ __('Discount') }}</label>
                            <select name="discount_id" id="discount_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">{{ __('Select discount') }}</option>
                                @foreach($discounts as $discount)
                                    <option value="{{ $discount->id }}" @selected(old('discount_id', $discountStudent->discount_id) == $discount->id)>
                                        {{ $discount->name }} ({{ ucfirst($discount->type) }}: {{ number_format((float) $discount->value, 2) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('discount_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('discount_students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('Cancel') }}</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">{{ __('Update Assignment') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('form');
            const studentSearchInput = document.getElementById('student_search');
            const studentIdInput = document.getElementById('student_id');
            const options = Array.from(document.querySelectorAll('#student_options option'));

            const syncStudentId = () => {
                const selectedOption = options.find((option) => option.value === studentSearchInput.value);

                if (selectedOption) {
                    studentIdInput.value = selectedOption.dataset.studentId || '';
                    studentSearchInput.setCustomValidity('');

                    return;
                }

                studentIdInput.value = '';
            };

            syncStudentId();

            studentSearchInput.addEventListener('input', () => {
                syncStudentId();
                studentSearchInput.setCustomValidity('');
            });

            studentSearchInput.addEventListener('change', syncStudentId);

            form.addEventListener('submit', (event) => {
                syncStudentId();

                if (!studentIdInput.value) {
                    event.preventDefault();
                    studentSearchInput.setCustomValidity('Please select a student from the suggested list.');
                    studentSearchInput.reportValidity();
                }
            });
        });
    </script>
</x-app-layout>
