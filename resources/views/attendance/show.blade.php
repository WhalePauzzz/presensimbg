@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">
        Daftar Kehadiran Kelas {{ $kelas->kelas }}
    </h1>

    <a href="{{ route('attendance.index') }}" class="mb-4 inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
        ← Kembali
    </a>

    <div class="overflow-x-auto mt-4">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-200">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Nama Siswa</th>
                    <th class="py-2 px-4">Tanggal</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Foto</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-100">
                @forelse ($attendances as $index => $attendance)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $attendance->student->nm_siswa }}</td>
                        <td class="py-2 px-4">{{ $attendance->date }}</td>
                        <td class="py-2 px-4 capitalize">{{ $attendance->keterangan }}</td>
                        <td class="py-2 px-4">
                            @if ($attendance->foto_izin)
                                <a href="{{ asset('storage/' . $attendance->foto_izin) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Foto</a>
                            @else
                                <img src="{{ asset('storage/noimage.png') }}" class="w-12 h-12 object-cover rounded border" alt="Tidak ada foto">
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada data absensi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
