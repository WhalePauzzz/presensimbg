<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 p-8 bg-gradient-to-br from-pink-100 to-yellow-100 rounded-3xl shadow-xl">
        <h2 class="text-3xl font-bold text-center text-pink-700 mb-6">📝 Daftar Akun Baru</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-lg text-pink-800" />
                <x-text-input id="name" class="block mt-1 w-full rounded-full px-4 py-2 text-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" class="text-lg text-pink-800" />
                <x-text-input id="email" class="block mt-1 w-full rounded-full px-4 py-2 text-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" class="text-lg text-pink-800" />
                <x-text-input id="password" class="block mt-1 w-full rounded-full px-4 py-2 text-lg"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-lg text-pink-800" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-full px-4 py-2 text-lg"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>

                <x-primary-button class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-6 py-2 rounded-full text-lg transition transform hover:scale-105">
                    Daftar 🚀
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
