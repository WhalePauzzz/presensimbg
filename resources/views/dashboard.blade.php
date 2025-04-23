@extends('layouts.app')

@section('content')
    <div
        class="max-w-6xl mx-auto px-4 py-8 bg-gradient-to-br from-blue-100 via-pink-100 to-yellow-100 min-h-screen rounded-xl shadow-inner">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
            <h1 class="text-4xl font-bold text-pink-700 flex items-center gap-2">
                Daftar Siswa
            </h1>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('students.create') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm sm:text-lg px-4 py-2 sm:px-6 sm:py-3 rounded-full shadow-md transition transform hover:scale-105 font-extrabold">
                    Tambah Siswa
                </a>
            @endif

        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-200 border-l-4 border-green-500 text-green-800 rounded-lg shadow">
                🌟 {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($kelasList as $kelas)
                <a href="{{ route('students.show', $kelas->id) }}"
                    class="block bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-2xl font-bold text-blue-700">{{ $kelas->kelas }} - {{ $kelas->jurusan }}</h2>
                        <span class="text-3xl">📘</span>
                    </div>
                    <p class="text-md text-gray-700">👥 Jumlah Siswa: <span
                            class="font-bold">{{ $kelas->students->count() }}</span></p>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-600 text-lg">
                    🚫 Belum ada data kelas.
                </div>
            @endforelse
        </div>
    </div>
@endsection
