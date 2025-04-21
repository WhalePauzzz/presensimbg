@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-gradient-to-br from-yellow-100 via-pink-100 to-blue-100 dark:from-blue-900 dark:via-gray-800 dark:to-purple-900 shadow-lg rounded-2xl p-6">
        <h2 class="text-3xl font-bold text-pink-700 dark:text-pink-300 mb-6 border-b pb-2">🎒 Tambah Kelas</h2>
        <form action="{{ route('clas.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">📚 Nama Kelas</label>
                <input type="text" id="kelas" name="kelas" required
                    class="w-full px-4 py-3 rounded-xl border-2 border-pink-300 dark:border-pink-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-800 dark:text-gray-200 mb-1">📝 Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" required
                    class="w-full px-4 py-3 rounded-xl border-2 border-pink-300 dark:border-pink-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300 transform hover:scale-105">
                    Simpan 🎉
                </button>
                <a href="{{ route('clas.index') }}"
                    class="text-gray-600 dark:text-gray-300 hover:underline hover:text-gray-900 dark:hover:text-white transition text-lg">
                    🔙 Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
