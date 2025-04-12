@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 border-b pb-2">Tambah Kelas</h2>
        <form action="{{ route('clas.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label for="kelas" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Kelas</label>
                <input type="text" id="kelas" name="kelas" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" required
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex items-center justify-between mt-6">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Simpan
                </button>
                <a href="{{ route('clas.index') }}"
                    class="text-gray-600 dark:text-gray-300 hover:underline hover:text-gray-900 dark:hover:text-white transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
