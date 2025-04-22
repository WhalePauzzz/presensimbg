{{-- NAVBAR UTAMA --}}
<div x-data="{ sidebarOpen: false }"
    class="flex flex-col md:flex-row min-h-screen bg-gradient-to-br from-blue-100 via-pink-100 to-yellow-100 text-gray-800 dark:text-white">

    {{-- Mobile Sidebar (Overlay) --}}
    <div class="md:hidden" x-show="sidebarOpen" x-transition>
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="sidebarOpen = false"></div>
        <aside
            class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-gray-800 z-50 shadow-xl rounded-r-3xl overflow-hidden">
            <div
                class="p-4 flex justify-between items-center border-b border-pink-300 dark:border-pink-700 bg-pink-100 dark:bg-pink-800">
                <img src="{{ asset('images/PRESENSI SMK NEGERI 1 PACITAN.png') }}" alt="Logo"
                    class="h-20 w-auto rounded-xl" />
                <button @click="sidebarOpen = false"
                    class="text-pink-700 dark:text-white text-3xl font-bold">&times;</button>
            </div>

            <nav class="p-4 space-y-3 text-lg font-semibold">
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded-xl transition">📊 Dashboard</a>
                <a href="{{ route('clas.index') }}"
                    class="block px-4 py-2 bg-yellow-100 hover:bg-yellow-200 rounded-xl transition">🏫 Kelas</a>
                <a href="{{ route('attendance.index') }}"
                    class="block px-4 py-2 bg-green-100 hover:bg-green-200 rounded-xl transition">📝 Absensi</a>
                <a href="{{ route('mbgs.index') }}"
                    class="block px-4 py-2 bg-purple-100 hover:bg-purple-200 rounded-xl transition">🍽️ MBG</a>
                <a href="{{ route('user.index') }}"
                    class="block px-4 py-2 bg-indigo-100 hover:bg-indigo-200 rounded-xl transition">👥 Guru</a>
            </nav>

            <div class="pt-4 pb-4 px-4 border-t border-pink-200 dark:border-pink-700 mt-auto">
                @if (auth()->check())
                    <div class="text-sm">
                        <div class="font-bold text-pink-700 dark:text-pink-300">👤 {{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</div>
                    </div>
                @else
                    <div class="font-bold">Guest</div>
                @endif

                <div class="mt-4 space-y-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 bg-red-100 hover:bg-red-200 rounded-xl transition">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>

    {{-- Desktop Sidebar --}}
    <aside
        class="hidden md:flex md:w-64 bg-white dark:bg-gray-800 flex-col border-r border-pink-200 dark:border-pink-600 shadow-xl">
        <div
            class="h-24 flex items-center justify-center bg-pink-100 dark:bg-pink-900 border-b border-pink-300 dark:border-pink-700">
            <img src="{{ asset('images/PRESENSI SMK NEGERI 1 PACITAN.png') }}" alt="Logo"
                class="h-20 w-auto rounded-xl" />
        </div>

        <nav class="flex-1 mt-5 px-4 space-y-3 text-lg font-semibold">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 bg-blue-100 hover:bg-blue-200 rounded-xl transition">📊 Dashboard</a>
            <a href="{{ route('clas.index') }}"
                class="block px-4 py-2 bg-yellow-100 hover:bg-yellow-200 rounded-xl transition">🏫 Kelas</a>
            <a href="{{ route('attendance.index') }}"
                class="block px-4 py-2 bg-green-100 hover:bg-green-200 rounded-xl transition">📝 Absensi</a>
            <a href="{{ route('mbgs.index') }}"
                class="block px-4 py-2 bg-purple-100 hover:bg-purple-200 rounded-xl transition">🍽️ MBG</a>
            <a href="{{ route('user.index') }}"
                class="block px-4 py-2 bg-indigo-100 hover:bg-indigo-200 rounded-xl transition">👥 Guru</a>
        </nav>

        <div class="p-4 border-t border-pink-200 dark:border-pink-600">
            <div class="text-sm mb-2">
                👤 <span class="font-bold">{{ Auth::user()->name }}</span><br>
                <span class="text-xs text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-2 bg-red-100 hover:bg-red-200 rounded-xl transition">
                    🚪 Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 p-6">
        <!-- Mobile Menu Button -->
        <button @click="sidebarOpen = true" class="md:hidden mb-4 text-pink-700 dark:text-white focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        @yield('content')
    </div>
</div>
