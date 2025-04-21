<x-guest-layout>
    <div class="mb-6 text-lg text-pink-700 bg-pink-100 border-l-4 border-pink-400 p-4 rounded shadow-md">
        💌 {{ __('Lupa kata sandi? Tidak masalah! Masukkan email kamu dan kami akan kirimkan tautan untuk mengatur ulang kata sandi.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="bg-white p-6 rounded-2xl shadow-lg border-2 border-yellow-200">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-lg font-semibold text-blue-700 mb-1">
                📧 Email
            </label>
            <input id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit"
                class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded-full shadow-md transition transform hover:scale-105">
                📮 Kirim Tautan Reset
            </button>
        </div>
    </form>
</x-guest-layout>