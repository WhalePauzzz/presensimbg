<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-yellow-100 via-pink-100 to-blue-100">
    <div class="min-h-screen flex flex-col justify-center items-center py-8">
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-pink-700 mt-2 text-center">Selamat Datang 👋</h1>
        </div>

        <div class="w-full sm:max-w-md px-8 py-6 bg-gradient-to-br from-white via-pink-50 to-yellow-50 border-4 border-pink-200 rounded-[30px] shadow-2xl transition transform hover:scale-[1.02]">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
