@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-6">
        <div class="mb-4 bg-yellow-100 p-6 rounded-2xl shadow-lg border border-yellow-200">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-yellow-900">👩‍🎓 Daftar Siswa</h1>
                    <p class="text-yellow-800 mt-1 text-sm">
                        🏫 Kelas: <span class="font-semibold">{{ $kelas->kelas }}</span> |
                        📚 Jurusan: <span class="font-semibold">{{ $kelas->jurusan }}</span> |
                        👥 Total Siswa: <span class="font-semibold">{{ $kelas->students->count() }}</span>
                    </p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-pink-400 text-white text-sm font-semibold rounded-xl shadow hover:bg-pink-500 transition">
                    ← Kembali ke Kelas
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-yellow-200">
                <thead class="bg-yellow-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-yellow-800">#️⃣ No</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-yellow-800">🧒 Nama Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-yellow-50 bg-yellow-50">
                    @forelse ($kelas->students as $index => $student)
                        <tr class="hover:bg-yellow-100 transition">
                            <td class="px-6 py-4 text-sm text-yellow-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-yellow-900">{{ $student->nm_siswa }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-6 text-center text-yellow-600">😢 Tidak ada siswa di kelas ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
