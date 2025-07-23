<!-- resources/views/auth/login.blade.php -->

<x-guest-layout>
    <div class="text-center mb-6">
        <h3 class="text-xl font-bold text-bpr-blue-dark font-heading">{{ __('Login ke Akun Anda') }}</h3>
        <p class="text-bpr-text-light text-sm mt-1">{{ __('Masukkan kredensial Anda untuk melanjutkan.') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="sr-only" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H5.25a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H5.25A2.25 2.25 0 0 0 3 6.75m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.902l-5.4 2.7a2.25 2.25 0 0 1-2.13 0l-5.4-2.7a2.25 2.25 0 0 1-1.07-1.902V6.75" />
                    </svg>
                </div>
                <x-text-input id="email" class="block w-full pl-10 pr-3 py-2 border-b-2 border-gray-300 focus:border-bpr-blue-medium focus:ring-0 shadow-none rounded-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="sr-only" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <x-text-input id="password" class="block w-full pl-10 pr-3 py-2 border-b-2 border-gray-300 focus:border-bpr-blue-medium focus:ring-0 shadow-none rounded-none" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex justify-between items-center mt-4 mb-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-bpr-blue-dark shadow-sm focus:ring-bpr-blue-dark">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-bpr-blue-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bpr-blue-medium" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center justify-center mt-6"> {{-- Tombol Login di tengah --}}
            <x-primary-button class="w-full px-6 py-2.5 bg-bpr-blue-dark hover:bg-bpr-blue-medium focus:bg-bpr-blue-medium active:bg-bpr-blue-dark focus:outline-none focus:ring-2 focus:ring-bpr-blue-dark focus:ring-offset-2 shadow-md font-heading text-lg">
                {{ __('Login') }}
            </x-primary-button>
        </div>

        {{-- Link "Belum punya akun?" di bawah tombol login --}}
        <div class="flex items-center justify-center mt-4">
            @if (Route::has('register'))
                <a class="underline text-sm text-gray-600 hover:text-bpr-blue-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bpr-blue-medium" href="{{ route('register') }}">
                    {{ __('Belum punya akun?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
