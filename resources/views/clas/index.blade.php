@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-gradient-to-br from-pink-100 via-yellow-100 to-blue-100 dark:bg-gradient-to-br dark:from-pink-900 dark:via-yellow-900 dark:to-blue-900 shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-pink-500 text-white px-6 py-4 rounded-t-2xl">
            <h1 class="text-2xl font-semibold">📚 DAFTAR KELAS</h1>
        </div>
        <div class="px-6 py-4">
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('clas.create') }}"
                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-2 px-6 rounded-lg mb-4 transition duration-300 transform hover:scale-105">
                + Tambah Kelas
            </a>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl">
                    <thead class="bg-pink-200 dark:bg-pink-700 text-gray-700 dark:text-white text-sm uppercase rounded-t-xl">
                        <tr>
                            <th class="text-left px-6 py-3 border-b border-gray-200 dark:border-gray-600">Nama Kelas</th>
                            <th class="text-left px-6 py-3 border-b border-gray-200 dark:border-gray-600">Jurusan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-200">
                        @foreach ($classes as $class)
                        <tr class="hover:bg-yellow-50 dark:hover:bg-yellow-800 transition transform hover:scale-105">
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $class->kelas }}</td>
                            <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">{{ $class->jurusan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection