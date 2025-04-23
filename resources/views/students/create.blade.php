@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto px-6 py-8 bg-white/80 rounded-2xl shadow-xl border border-yellow-200">
        <h1 class="text-3xl font-bold text-pink-600 mb-6 text-center">🧒 Tambah Siswa Baru</h1>

        <form action="{{ route('students.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="nm_siswa" class="block text-sm font-semibold text-purple-700 mb-1">📛 Nama Siswa</label>
                <input type="text" id="nm_siswa" name="nm_siswa" required
                    class="w-full border-2 border-pink-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition">
            </div>

            <div>
                <label for="id_kelas" class="block text-sm font-semibold text-purple-700 mb-1">🏫 Pilih Kelas</label>
                <select id="id_kelas" name="id_kelas" required
                    class="w-full border-2 border-yellow-300 rounded-xl px-4 py-2 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 transition">
                    <option disabled selected>-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-gradient-to-r from-pink-400 via-yellow-400 to-green-400 hover:from-pink-500 hover:to-green-500 text-white font-bold px-6 py-2 rounded-full shadow-md transition">
                    💾 Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
