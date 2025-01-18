<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounting') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-items-stretch ">
                       <div class="flex p-4 border border-solid rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4"/>
                                </svg>                                      
                            </span>

                            <div class="ml-2">
                                <h2"><a href="{{ route('accountcharts.index') }}" class="text-blue-600 text-2xl font-bold hover:underline">Chart of Account</a></h2>
                                <p>Add, update & update.</p>
                            </div>
                       </div>

                       <div class="flex p-4 border border-solid rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M4 4a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2v14a1 1 0 1 1 0 2H5a1 1 0 1 1 0-2V5a1 1 0 0 1-1-1Zm5 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1Zm-5 4a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H9Zm5 0a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1h-1Zm-3 4a2 2 0 0 0-2 2v3h2v-3h2v3h2v-3a2 2 0 0 0-2-2h-2Z" clip-rule="evenodd"/>
                                </svg>                                     
                            </span>

                            <div class="ml-2">
                                <h2"><a href="{{ route('general-journal.create') }}" class="text-blue-600 text-2xl font-bold hover:underline">Journal Entries</a></h2>
                                <p>Add</p>
                            </div>
                        </div>

                        <div class="flex p-4 border border-solid rounded-md bg-gray-100">
                            <span class="w-16 h-16 bg-blue-200 rounded-full inline-flex justify-center items-center">
                                <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M3 21h18M4 18h16M6 10v8m4-8v8m4-8v8m4-8v8M4 9.5v-.955a1 1 0 0 1 .458-.84l7-4.52a1 1 0 0 1 1.084 0l7 4.52a1 1 0 0 1 .458.84V9.5a.5.5 0 0 1-.5.5h-15a.5.5 0 0 1-.5-.5Z"/>
                                </svg>                                                                        
                            </span>

                            <div class="ml-2">
                                <h2"><a href="{{ route('general-journal.index') }}" class="text-blue-600 text-2xl font-bold hover:underline">Transactions</a></h2>
                                <p>view</p>
                            </div>
                       </div>
                       
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>