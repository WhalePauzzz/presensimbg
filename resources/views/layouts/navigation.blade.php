<div x-data="{ sidebarOpen: false }" class="flex flex-col md:flex-row min-h-screen bg-gray-100 dark:bg-gray-900">

    {{-- Mobile Sidebar (Overlay) --}}
    <div class="md:hidden" x-show="sidebarOpen" x-transition>
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="sidebarOpen = false"></div>
        <aside class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 z-50 shadow flex flex-col">
            <div class="p-4 flex justify-between items-center border-b dark:border-gray-700">
                <img src="{{ asset('images/PRESENSI SMK NEGERI 1 PACITAN.png') }}" alt="Logo SMK Negeri 1 Pacitan" class="h-20 w-auto" />
                <button @click="sidebarOpen = false" class="text-gray-700 dark:text-white text-2xl">&times;</button>
            </div>

            <nav class="p-4 space-y-2 flex-1">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('clas.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Kelas</a>
                <a href="{{ route('attendance.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Attendance</a>
                <a href="{{ route('mbgs.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">MBG</a>
            </nav>

            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    @if(auth()->check())
                    <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm">{{ Auth::user()->email }}</div>
                    @else
                    <div class="font-medium text-base">{{ __('Guest') }}</div>
                    <div class="font-medium text-sm">{{ __('No Email') }}</div>
                    @endif
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">{{ __('Profile') }}</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>

    {{-- Desktop Sidebar --}}
    <aside class="hidden md:flex md:w-64 bg-white dark:bg-gray-800 flex-col border-r dark:border-gray-700">
        <div class="h-16 flex items-center justify-center border-b dark:border-gray-700">
            <img src="{{ asset('images/PRESENSI SMK NEGERI 1 PACITAN.png') }}" alt="Logo SMK Negeri 1 Pacitan" class="h-20 w-auto" />
        </div>

        <nav class="flex-1 mt-5 px-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('clas.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Kelas</a>
            <a href="{{ route('attendance.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Attendance</a>
            <a href="{{ route('mbgs.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">MBG</a>
        </nav>

        <div class="w-full p-4 border-t dark:border-gray-600">
            <div class="text-sm text-gray-700 dark:text-white">
                {{ Auth::user()->name }}<br>
                <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full text-left text-sm px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 p-6">
        <!-- Mobile menu button -->
        <button @click="sidebarOpen = true" class="md:hidden mb-4 text-gray-600 dark:text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        @yield('content')
    </div>
</div>