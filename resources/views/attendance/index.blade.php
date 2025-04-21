@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-gradient-to-br from-blue-100 via-pink-100 to-yellow-100 min-h-screen rounded-xl shadow-inner">
    <h1 class="text-3xl font-bold text-pink-700 dark:text-white mb-6">
        📚 Daftar Kehadiran
    </h1>

    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-200 text-green-700 dark:bg-green-300 dark:text-green-800">
            ✅ {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('attendance.create') }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-medium py-2 px-6 rounded-full shadow-md mb-6 transform hover:scale-105 transition duration-300">
        ➕ Tambah Kehadiran
    </a>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kelasList as $kelas)
            <a href="{{ route('attendance.show', $kelas->id) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:ring-2 ring-blue-400 transition transform hover:scale-105">
                <h5 class="text-xl font-semibold text-blue-700 dark:text-white mb-2">
                    Kelas: {{ $kelas->kelas }}
                </h5>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Klik untuk melihat absensi</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
