@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Tambah Siswa</h1>
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nm_siswa" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nm_siswa" name="nm_siswa" required>
        </div>
        <div class="mb-3">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select class="form-control" id="id_kelas" name="id_kelas" required>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas->id_kelas }}">{{ $kelas->kelas }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection