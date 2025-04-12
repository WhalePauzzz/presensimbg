@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
    <div class="bg-white dark:bg-gray-800 shadow rounded-2xl overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Daftar Kelas</h2>
        </div>
        <div class="px-6 py-4">
            <a href="{{ route('clas.create') }}"
               class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg mb-4 transition duration-300">
                + Tambah Kelas
            </a>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white text-sm uppercase">
                        <tr>
                            <th class="text-left px-6 py-3 border-b border-gray-200 dark:border-gray-600">Nama Kelas</th>
                            <th class="text-left px-6 py-3 border-b border-gray-200 dark:border-gray-600">Jurusan</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 dark:text-gray-200">
                        @foreach ($classes as $class)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
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
