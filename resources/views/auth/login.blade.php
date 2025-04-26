<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-10 p-8 bg-gradient-to-br from-pink-100 to-yellow-100 rounded-2xl shadow-xl border border-pink-200">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6 flex items-center justify-center gap-2">
            Masuk Akun
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="'Email'" class="text-blue-700 font-semibold" />
                <x-text-input id="email" class="block mt-1 w-full rounded-xl shadow-sm border-pink-300 focus:ring-pink-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="'Password'" class="text-blue-700 font-semibold" />
                <x-text-input id="password" class="block mt-1 w-full rounded-xl shadow-sm border-pink-300 focus:ring-pink-400"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center text-blue-600">
                    <input id="remember_me" type="checkbox" class="rounded border-pink-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
                    <span class="ms-2 text-sm font-medium">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit & Lupa Password -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="text-sm underline text-gray-500 hover:text-blue-600" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif

                <x-primary-button class="ml-3 bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full text-lg font-semibold transition shadow">
                    👉 Masuk
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
