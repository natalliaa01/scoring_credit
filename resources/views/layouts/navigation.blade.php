<!-- resources/views/layouts/navigation.blade.php -->

<nav x-data="{ open: false }" class="bg-bpr-blue-dark border-b border-bpr-blue-medium">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo dan Judul Aplikasi -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('images/logo_msa.png') }}" alt="Logo BPR MSA" class="block h-9 w-auto fill-current">
                        <span class="ml-4 text-white text-xl font-bold whitespace-nowrap">{{ __('Aplikasi Credit Scoring') }}</span> {{-- Judul Aplikasi dengan margin lebih --}}
                    </a>
                </div>
            </div>

            {{-- Navigation Links dipindahkan ke kanan dengan ms-auto dan padding/margin disesuaikan --}}
            <div class="flex items-center"> {{-- Wrapper untuk items-center --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"> {{-- ml-10 untuk jarak dari logo, bukan ms-auto --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="text-white hover:text-bpr-gold-accent"> {{ __('Dashboard') }} </span>
                    </x-nav-link>

                    {{-- Link ke Daftar Aplikasi Kredit --}}
                    <x-nav-link :href="route('aplikasi-kredit.index')" :active="request()->routeIs('aplikasi-kredit.index')">
                        <span class="text-white hover:text-bpr-gold-accent"> {{ __('Aplikasi Kredit') }} </span>
                    </x-nav-link>

                    {{-- Link Manajemen User (DIKOMENTARI SEMENTARA KARENA ROUTE BELUM ADA) --}}
                    <!--
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                            <span class="text-white hover:text-bpr-gold-accent"> {{ __('Manajemen User') }} </span>
                        </x-nav-link>
                    @endif
                    -->
                </div>

                <!-- Settings Dropdown (Profil Pengguna) - Diberi jarak dari navigation links -->
                <div class="hidden sm:flex sm:items-center sm:ml-6"> {{-- ml-6 untuk jarak dari nav links --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-bpr-blue-dark hover:text-bpr-gold-accent focus:outline-none transition ease-in-out duration-150">
                                {{-- Icon Profil (contoh SVG sederhana atau Font Awesome jika diimpor) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1 -9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1 -.437 .695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.79a.75.75 0 0 1 -.438-.695Z" clip-rule="evenodd" />
                                </svg>
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger (Mobile Menu Toggle) -->
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

    <!-- Responsive Navigation Menu (untuk tampilan mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-bpr-blue-dark">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="text-white hover:text-bpr-gold-accent">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('aplikasi-kredit.index')" :active="request()->routeIs('aplikasi-kredit.index')">
                <span class="text-white hover:text-bpr-gold-accent">{{ __('Aplikasi Kredit') }}</span>
            </x-responsive-nav-link>

            {{-- Link Manajemen User Responsif (DIKOMENTARI SEMENTARA KARENA ROUTE BELUM ADA) --}}
            <!--
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                    <span class="text-white hover:text-bpr-gold-accent">{{ __('Manajemen User') }}</span>
                </x-responsive-nav-link>
            @endif
            -->
        </div>

        <!-- Responsive Settings Options (untuk profil dan logout di mobile) -->
        <div class="pt-4 pb-1 border-t border-bpr-blue-medium">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <span class="text-white hover:text-bpr-gold-accent">{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <span class="text-white hover:text-bpr-gold-accent">{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
