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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">

        {{-- Navbar --}}
        @include('layouts.navigation')

        {{-- Page Heading (Opsional) --}}
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow-md">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        {{-- Main Content --}}
        {{-- <main class="flex-grow py-8">
            @yield('content')
        </main> --}}

        {{-- Footer (Opsional) --}}
        <footer class="bg-white py-10 px-6 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-sm text-gray-400">
                <!-- About -->
                <div>
                    <h3 class="text-gray-400 text-base font-semibold mb-4 tracking-wide">ABOUT</h3>
                    <p class="leading-relaxed text-gray-400">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-gray-400 text-base font-semibold mb-4 tracking-wide">CATEGORIES</h3>
                    <ul class="space-y-2">
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Website Design</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">UI Design</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Web Development</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Video Editor</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Theme Creator</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Templates</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-gray-400 text-base font-semibold mb-4 tracking-wide">QUICK LINKS</h3>
                    <ul class="space-y-2">
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">About Us</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Contact Us</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Contribute</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Privacy Policy</a></li>
                        <li><a href="#" onclick="event.preventDefault()" class="hover:text-black">Sitemap</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- Bottom Footer -->
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} All Rights Reserved by WBIFY.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" onclick="event.preventDefault()" class="hover:text-black transition-colors"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" onclick="event.preventDefault()" class="hover:text-black transition-colors"><i class="fab fa-twitter"></i></a>
                    <a href="#" onclick="event.preventDefault()" class="hover:text-black transition-colors"><i class="fab fa-dribbble"></i></a>
                    <a href="#" onclick="event.preventDefault()" class="hover:text-black transition-colors"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>