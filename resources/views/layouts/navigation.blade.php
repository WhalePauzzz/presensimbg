<div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100 dark:bg-gray-900">

    {{-- Mobile Sidebar (Overlay) --}}
    <div class="md:hidden" x-show="sidebarOpen" x-transition>
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="sidebarOpen = false"></div>
        <aside class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 z-50 shadow">
            <div class="p-4 flex justify-between items-center border-b dark:border-gray-700">
                <x-application-logo class="h-8 w-auto text-gray-800 dark:text-gray-200" />
                <button @click="sidebarOpen = false" class="text-gray-700 dark:text-white">&times;</button>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('clas.index') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Kelas</a>
                <a href="{{ route('attendance.index') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Attendance</a>
                <a href="{{ route('mbgs.index') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">MBG</a>
            </nav>
        </aside>
    </div>

    {{-- Desktop Sidebar --}}
    <aside class="w-64 bg-white dark:bg-gray-800 border-r hidden md:block">
        <div class="h-16 flex items-center justify-center border-b dark:border-gray-700">
            <x-application-logo class="h-10 w-auto text-gray-800 dark:text-gray-200" />
        </div>
        <nav class="mt-5 px-4 space-y-2">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clas.index') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Kelas</a>
            <a href="{{ route('attendance.index') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Attendance</a>
            <a href="{{ route('mbgs.index') }}"
                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">MBG</a>
        </nav>
        <div class="absolute bottom-0 w-full p-4 border-t">
            <div class="text-sm text-gray-700 dark:text-white">
                {{ Auth::user()->name }}<br>
                <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
            </div>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex-1 flex flex-col w-full">
        {{-- Mobile Header --}}
        <div class="md:hidden bg-white dark:bg-gray-800 shadow p-4 flex items-center justify-between">
            <button @click="sidebarOpen = true">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="text-lg font-bold text-gray-800 dark:text-white">Dashboard</span>
        </div>

        {{-- Optional header --}}
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $header }}</h1>
            </header>
        @endisset

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>
