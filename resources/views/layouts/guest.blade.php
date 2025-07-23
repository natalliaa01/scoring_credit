<!-- resources/views/layouts/guest.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aplikasi Credit Scoring') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-bpr-text-dark antialiased bpr-background-light"> {{-- Latar belakang biru pastel --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4"> {{-- Padding global --}}
        {{-- Kontainer utama form login/register --}}
        <div class="w-full sm:max-w-sm md:max-w-md mt-6 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-lg border border-bpr-gray-medium"> {{-- Lebar lebih ringkas, padding standar, shadow kuat, rounded --}}
            <div class="mb-6 text-center"> {{-- Logo dan judul di tengah atas --}}
                <a href="/">
                    <img src="{{ asset('images/logo_msa.png') }}" alt="Logo BPR MSA" class="w-24 h-auto mx-auto mb-2"> {{-- Logo lebih kecil agar ringkas --}}
                </a>
                <h2 class="text-2xl font-extrabold text-bpr-blue-dark font-heading">{{ __('Aplikasi Credit Scoring') }}</h2> {{-- Judul aplikasi --}}
            </div>

            {{ $slot }} {{-- Ini adalah tempat formulir login/register akan dirender --}}
        </div>
    </div>
</body>
</html>
