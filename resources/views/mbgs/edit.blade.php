@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Data MBG - Tanggal {{ $date }}</h1>

        <form action="{{ route('mbgs.updateByDate') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="date" value="{{ $date }}">

            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-center">
                    <thead class="bg-gray-100 text-sm font-medium text-gray-700">
                        <tr>
                            <th>Kelas</th>
                            <th>Total Siswa</th>
                            <th>Total Hadir</th>
                            <th>Diambil</th>
                            <th>Dikembalikan</th>
                            <th>Foto</th>
                            <th>Upload Foto Baru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            @php
                                $mbg = $mbgs[$class->id] ?? null;
                            @endphp
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $class->kelas }}</td>
                                <td>{{ $mbg->total_siswa ?? 0 }}</td>
                                <td>{{ $mbg->total_hadir ?? 0 }}</td>
                                <td>
                                    <input type="checkbox" name="mbgs[{{ $class->id }}][diambil]"
                                        {{ $mbg && $mbg->diambil ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="mbgs[{{ $class->id }}][dikembalikan]"
                                        {{ $mbg && $mbg->dikembalikan ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @if ($mbg && $mbg->foto && basename($mbg->foto) !== 'noimage.png')
                                        <img src="{{ asset('storage/' . $mbg->foto) }}" alt="Foto"
                                            class="h-16 rounded mx-auto">
                                    @else
                                        <span class="text-red-500">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="file" name="mbgs[{{ $class->id }}][foto]" class="text-sm">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
