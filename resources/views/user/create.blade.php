@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <div
            class="bg-gradient-to-br from-pink-100 via-yellow-100 to-blue-100 dark:bg-gradient-to-br dark:from-pink-900 dark:via-yellow-900 dark:to-blue-900 shadow-xl rounded-2xl overflow-hidden">
            <div class="bg-pink-500 text-white px-6 py-4 rounded-t-2xl">
                <h1 class="text-2xl font-semibold">👤 Tambah Guru</h1>
            </div>
            <form action="{{ route('user.store') }}" method="POST" class="px-6 py-6 space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                </div>

                <!-- Password -->
                <div>
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role</label>
                    <input type="text" id="role" value="Guru"
                        class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 cursor-not-allowed"
                        readonly>
                    <input type="hidden" name="role" value="guru">
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                        Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
