@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Siswa</h1>
    
    <form action="{{ route('students.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="nm_siswa" class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
            <input type="text" id="nm_siswa" name="nm_siswa" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
        </div> 

        <div>
            <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
            <select id="id_kelas" name="id_kelas" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-500">
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
