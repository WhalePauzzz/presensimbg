@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-6">
        <div class="mb-4 bg-white p-6 rounded-xl shadow-md">
            <div class="flex items-center justify-between mb-4">
                <div class="">
                    <h1 class="text-3xl font-bold text-gray-800">Daftar Siswa</h1>
                    <p class="text-gray-500 mt-1">
                        Kelas: <span class="font-semibold text-gray-700">{{ $kelas->kelas }}</span> |
                        Jurusan: <span class="font-semibold text-gray-700">{{ $kelas->jurusan }}</span> |
                        Total Siswa: <span class="font-semibold text-gray-700">{{ $kelas->students->count() }}</span>
                    </p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition">
                    ← Kembali ke Kelas
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($kelas->students as $index => $student)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->nm_siswa }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-6 text-center text-gray-500">Tidak ada siswa di kelas ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
