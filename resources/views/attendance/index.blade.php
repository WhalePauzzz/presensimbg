@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Daftar Kehadiran</h1>

    @if (session('success'))
        <div class="mb-4 p-4 rounded bg-green-100 text-green-700 dark:bg-green-200">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('attendance.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded mb-6">
        + Tambah Kehadiran
    </a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($kelasList as $kelas)
            <a href="{{ route('attendance.show', $kelas->id) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 block hover:ring-2 ring-blue-400 transition">
                <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Kelas: {{ $kelas->kelas }}</h5>
                <p class="text-gray-600 dark:text-gray-300">Klik untuk melihat absensi</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
