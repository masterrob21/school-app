<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('students.index') }}" :active="request()->routeIs('students.index') || request()->routeIs('students.show') || request()->routeIs('students.create')">
                        {{ __('Students') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('guardians.index') }}" :active="request()->routeIs('guardians.index') || request()->routeIs('guardians.show') || request()->routeIs('guardians.create')">
                        {{ __('Guardians') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('staffs.index') }}" :active="request()->routeIs('staffs.index') || request()->routeIs('staffs.show') || request()->routeIs('staffs.create')">
                        {{ __('Staff') }}
                    </x-nav-link>
                    
                    <x-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index') || request()->routeIs('user.show') || request()->routeIs('user.create')">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Setup Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{__('Setup')}}
                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    {{-- <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div> --}}

                                    <!-- Course -->
                                    <x-dropdown-link href="/courses">
                                        {{ __('Courses') }}
                                    </x-dropdown-link>

                                    <!-- department -->
                                    <x-dropdown-link href="/departments">
                                        {{ __('Departments') }}
                                    </x-dropdown-link>

                                    <!-- occupation -->
                                    <x-dropdown-link href="/occupations">
                                        {{ __('Occupations') }}
                                    </x-dropdown-link>

                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('students.index') }}" :active="request()->routeIs('students.index') || request()->routeIs('students.show') || request()->routeIs('students.create')">
                {{ __('Students') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('guardians.index') }}" :active="request()->routeIs('guardians.index') || request()->routeIs('guardians.show') || request()->routeIs('guardians.create')">
                {{ __('Guardians') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('staffs.index') }}" :active="request()->routeIs('staffs.index') || request()->routeIs('staffs.show') || request()->routeIs('staffs.create')">
                {{ __('Staff') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('user.index') }}" :active="request()->routeIs('user.index') || request()->routeIs('user.show') || request()->routeIs('user.create')">
                {{ __('Users') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Setup -->
                
                <div class="border-t border-gray-200"></div>

                {{-- <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div> --}}

                <!--Courses -->
                <x-responsive-nav-link href="/courses" :active="request()->routeIs('courses.index') || request()->routeIs('courses.show') || request()->routeIs('courses.create')">
                    {{ __('Courses') }}
                </x-responsive-nav-link>

                <!--department -->
                <x-responsive-nav-link href="/departments" :active="request()->routeIs('departments.index') || request()->routeIs('departments.show') || request()->routeIs('departments.create')">
                    {{ __('Departments') }}
                </x-responsive-nav-link>

                <!--department -->
                <x-responsive-nav-link href="/occupations" >
                    {{ __('Occupations') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>
