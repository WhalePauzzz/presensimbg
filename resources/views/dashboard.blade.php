@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <a href="{{ route('students.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Siswa
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($kelasList as $kelas)
            <a href="{{ route('students.show', $kelas->id) }}" class="block bg-white shadow rounded-xl p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $kelas->kelas }} - {{ $kelas->jurusan }}</h2>
                <p class="text-sm text-gray-600">Jumlah Siswa: {{ $kelas->students->count() }}</p>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500">
                Belum ada data kelas.
            </div>
        @endforelse
    </div>
</div>
@endsection
