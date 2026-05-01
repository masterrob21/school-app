<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-stretch ">
                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                                </svg>                                                                        
                            </span>

                            <div class="ml-2">
                                {{-- <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">{{ number_format(count($no_of_students)) }}</a></h2> --}}
                                <p>Student Records</p>
                            </div>
                        </div>

                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">no of staffs</a></h2>
                                <p>Staffs</p>
                            </div>
                        </div>

                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">{{ App\Models\Invoice::count() }}</a></h2>
                                <p>Total Invoices</p>
                            </div>
                        </div>

                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">{{ App\Models\Invoice::where('status', 'paid')->count() }}</a></h2>
                                <p>Paid Invoices</p>
                            </div>
                        </div>

                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">{{ App\Models\Invoice::where('status', 'unpaid')->count() }}</a></h2>
                                <p>Unpaid Invoices</p>
                            </div>
                        </div>

                        <div class="flex p-4 border-l-4 border-l-blue-500 rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="#" class="text-blue-600 text-2xl font-bold hover:underline">{{ App\Models\RecurringInvoice::where('is_active', true)->count() }}</a></h2>
                                <p>Recurring Invoices</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- display recent invoices and payments --}}
            {{-- <div class="mt-4 bg-white p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 justify-items-stretch ">
                    <div class="card">
                        <div class="card-header text-bg-primary">
                            <h5>Recent Invoices</h5>
                        </div>
                        <div class="card-body">
                            {{-- @if($recentInvoices->isEmpty())
                                <p>No recent invoices.</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentInvoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->customer->name }}</td>
                                            <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge badge-{{ $invoice->status === 'paid' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $invoice->invoice_date->format('m/d/Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ route('invoices.index') }}" class="btn btn-sm btn-primary mt-2">View All Invoices</a>
                            @endif --}}
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header text-bg-primary">
                            <h5>Recent Payments</h5>
                        </div>
                        <div class="card-body">
                            @if($recentPayments->isEmpty())
                                <p>No recent payments.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Invoice #</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentPayments as $payment)
                                            <tr>
                                                <td>{{ $payment->payment_date->format('m/d/Y') }}</td>
                                                <td>{{ $payment->invoice->invoice_number }}</td>
                                                <td>${{ number_format($payment->amount, 2) }}</td>
                                                <td>{{ $payment->payment_method }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{ route('reports.payments') }}" class="btn btn-sm btn-primary mt-2">View All Payments</a>
                            @endif
                        </div>
                    </div> --}}
                </div>
            </div> --}}

             {{-- largest 10 arrears --}}
             <div class="mt-4 bg-white p-4 rounded-lg">
                <div class="overflow-x-auto">
                    <table class=" table-auto w-full text-left">
                        <caption class="md:text-center mb-4">
                            <h1>Ten (10) Largest Arears</h1>
                        </caption>

                        <thead class=" bg-blue-300">
                            <tr class=" whitespace-nowrap">
                                <th class="p-3">Name</th>
                                <th class="p-3">Class</th>
                                <th class="p-3">Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
