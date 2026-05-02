<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Invoice') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        @php
                            $selectedStudentId = (int) old('student_id', $invoice->student_id);
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
                            <input type="hidden" name="student_id" id="student_id" value="{{ old('student_id', $invoice->student_id) }}" required>
                            <datalist id="student_options">
                                @foreach($students as $student)
                                    <option value="{{ $student->student_id }} - {{ trim($student->other_names . ' ' . $student->last_name) }}" data-student-id="{{ $student->id }}"></option>
                                @endforeach
                            </datalist>
                            @error('student_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $invoice->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" required>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">{{ __('Due Date') }}</label>
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $invoice->due_date) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                                @error('due_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-medium text-gray-700">{{ __('Invoice Items') }}</label>
                                <button type="button" id="add-item" class="inline-flex items-center px-3 py-1.5 bg-slate-100 text-slate-700 rounded-md hover:bg-slate-200 transition text-xs font-semibold uppercase tracking-widest">{{ __('Add Item') }}</button>
                            </div>

                            <div id="invoice-items" class="mt-3 space-y-3">
                                @php
                                    $oldItems = old('invoice_items', $invoice->invoiceItems->map(function ($item) {
                                        return [
                                            'name' => $item->name,
                                            'amount' => $item->amount,
                                            'fee_type_id' => $item->fee_type_id,
                                        ];
                                    })->values()->all());

                                    if (count($oldItems) === 0) {
                                        $oldItems = [['name' => '', 'amount' => '', 'fee_type_id' => '']];
                                    }
                                @endphp

                                @foreach($oldItems as $itemIndex => $item)
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 item-row">
                                        <div class="md:col-span-3">
                                            <select name="invoice_items[{{ $itemIndex }}][fee_type_id]" class="item-fee-type block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                                                <option value="">{{ __('Fee type') }}</option>
                                                @foreach($feeTypes as $feeType)
                                                    <option value="{{ $feeType->id }}" data-fee-name="{{ $feeType->name }}" data-fee-amount="{{ number_format((float) $feeType->amount, 2, '.', '') }}" @selected(($item['fee_type_id'] ?? '') == $feeType->id)>{{ $feeType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="md:col-span-5">
                                            <input type="text" name="invoice_items[{{ $itemIndex }}][name]" value="{{ $item['name'] ?? '' }}" class="item-name block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="{{ __('Item name') }}" required>
                                        </div>
                                        <div class="md:col-span-3">
                                            <input type="number" step="0.01" min="0.01" name="invoice_items[{{ $itemIndex }}][amount]" value="{{ $item['amount'] ?? '' }}" class="item-amount block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="{{ __('Amount') }}" required>
                                        </div>
                                        <div class="md:col-span-1">
                                            <button type="button" class="remove-item w-full inline-flex items-center justify-center px-2 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-xs font-semibold">{{ __('X') }}</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @error('invoice_items')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('invoice_items.*.name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('invoice_items.*.amount')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="sub_total" class="block text-sm font-medium text-gray-700">{{ __('Sub Total') }}</label>
                                <input type="number" step="0.01" min="0" name="sub_total" id="sub_total" value="{{ old('sub_total', $invoice->sub_total) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:border-blue-500 focus:ring-blue-500" readonly>
                            </div>

                            <div>
                                <label for="discount_total" class="block text-sm font-medium text-gray-700">{{ __('Discount Total') }}</label>
                                <input type="number" step="0.01" min="0" name="discount_total" id="discount_total" value="{{ old('discount_total', $invoice->discount_total) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:border-blue-500 focus:ring-blue-500" readonly>
                                @error('discount_total')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="grand_total" class="block text-sm font-medium text-gray-700">{{ __('Grand Total') }}</label>
                                <input type="number" step="0.01" min="0" id="grand_total" value="{{ number_format((float) old('sub_total', $invoice->sub_total) - (float) old('discount_total', $invoice->discount_total), 2, '.', '') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 focus:border-blue-500 focus:ring-blue-500" readonly>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 transition">{{ __('Cancel') }}</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">{{ __('Update Invoice') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <template id="invoice-item-template">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 item-row">
            <div class="md:col-span-5">
                <input type="text" data-name="name" class="item-name block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="{{ __('Item name') }}" required>
            </div>
            <div class="md:col-span-3">
                <input type="number" step="0.01" min="0.01" data-name="amount" class="item-amount block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500" placeholder="{{ __('Amount') }}" required>
            </div>
            <div class="md:col-span-3">
                <select data-name="fee_type_id" class="item-fee-type block w-full px-4 py-2 border border-gray-300 rounded-md focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('Fee type') }}</option>
                    @foreach($feeTypes as $feeType)
                        <option value="{{ $feeType->id }}" data-fee-name="{{ $feeType->name }}" data-fee-amount="{{ number_format((float) $feeType->amount, 2, '.', '') }}">{{ $feeType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-1">
                <button type="button" class="remove-item w-full inline-flex items-center justify-center px-2 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition text-xs font-semibold">{{ __('X') }}</button>
            </div>
        </div>
    </template>

    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            const studentDiscounts = @json($studentDiscounts);
            const form = document.querySelector('form');
            const studentSearchInput = document.getElementById('student_search');
            const studentIdInput = document.getElementById('student_id');
            const studentOptions = Array.from(document.querySelectorAll('#student_options option'));
            const itemsContainer = document.getElementById('invoice-items');
            const addItemButton = document.getElementById('add-item');
            const template = document.getElementById('invoice-item-template');
            const subTotalInput = document.getElementById('sub_total');
            const discountTotalInput = document.getElementById('discount_total');
            const grandTotalInput = document.getElementById('grand_total');

            const syncStudentId = () => {
                const selectedOption = studentOptions.find((option) => option.value === studentSearchInput.value);

                if (selectedOption) {
                    studentIdInput.value = selectedOption.dataset.studentId || '';
                    studentSearchInput.setCustomValidity('');

                    return;
                }

                studentIdInput.value = '';
            };

            const reindexRows = () => {
                const rows = itemsContainer.querySelectorAll('.item-row');

                rows.forEach((row, index) => {
                    row.querySelectorAll('[data-name]').forEach((field) => {
                        const name = field.getAttribute('data-name');
                        field.name = `invoice_items[${index}][${name}]`;
                    });
                });
            };

            const calculateDiscount = (subTotal) => {
                const studentId = studentIdInput.value;

                if (!studentId) {
                    return 0;
                }

                const discounts = studentDiscounts[studentId] || [];
                let totalDiscount = 0;

                discounts.forEach((discount) => {
                    if (discount.type === 'percentage') {
                        totalDiscount += subTotal * ((parseFloat(discount.value) || 0) / 100);
                        return;
                    }

                    totalDiscount += parseFloat(discount.value) || 0;
                });

                return Math.min(subTotal, totalDiscount);
            };

            const updateSubTotal = () => {
                const total = Array.from(itemsContainer.querySelectorAll('.item-amount')).reduce((sum, input) => {
                    return sum + (parseFloat(input.value) || 0);
                }, 0);

                subTotalInput.value = total.toFixed(2);
                updateGrandTotal();
            };

            const updateGrandTotal = () => {
                const subTotal = parseFloat(subTotalInput.value) || 0;
                const discount = calculateDiscount(subTotal);
                discountTotalInput.value = discount.toFixed(2);
                const grandTotal = Math.max(subTotal - discount, 0);

                grandTotalInput.value = grandTotal.toFixed(2);
            };

            const applyFeeTypeSelection = (row) => {
                const feeTypeSelect = row.querySelector('.item-fee-type');
                const nameInput = row.querySelector('.item-name');
                const amountInput = row.querySelector('.item-amount');

                if (!feeTypeSelect || !nameInput || !amountInput) {
                    return;
                }

                const selectedOption = feeTypeSelect.options[feeTypeSelect.selectedIndex];
                const feeName = selectedOption?.dataset?.feeName;
                const feeAmount = selectedOption?.dataset?.feeAmount;

                if (!feeName || !feeAmount) {
                    return;
                }

                nameInput.value = feeName;
                amountInput.value = parseFloat(feeAmount).toFixed(2);
                updateSubTotal();
            };

            const wireRowEvents = (row) => {
                const amountInput = row.querySelector('.item-amount');
                const removeButton = row.querySelector('.remove-item');
                const feeTypeSelect = row.querySelector('.item-fee-type');

                if (amountInput) {
                    amountInput.addEventListener('input', updateSubTotal);
                }

                if (feeTypeSelect) {
                    feeTypeSelect.addEventListener('change', () => applyFeeTypeSelection(row));
                }

                if (removeButton) {
                    removeButton.addEventListener('click', () => {
                        if (itemsContainer.querySelectorAll('.item-row').length === 1) {
                            return;
                        }

                        row.remove();
                        reindexRows();
                        updateSubTotal();
                    });
                }
            };

            addItemButton.addEventListener('click', () => {
                const row = template.content.firstElementChild.cloneNode(true);
                itemsContainer.appendChild(row);
                reindexRows();
                wireRowEvents(row);
                updateSubTotal();
            });

            syncStudentId();
            studentSearchInput.addEventListener('input', () => {
                syncStudentId();
                studentSearchInput.setCustomValidity('');
                updateGrandTotal();
            });
            studentSearchInput.addEventListener('change', () => {
                syncStudentId();
                updateGrandTotal();
            });

            itemsContainer.querySelectorAll('.item-row').forEach((row) => wireRowEvents(row));
            form.addEventListener('submit', (event) => {
                syncStudentId();

                if (!studentIdInput.value) {
                    event.preventDefault();
                    studentSearchInput.setCustomValidity('Please select a student from the suggested list.');
                    studentSearchInput.reportValidity();
                }
            });
            updateSubTotal();
        });
    </script>
</x-app-layout>
