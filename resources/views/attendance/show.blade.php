@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-semibold text-blue-600 dark:text-yellow-300 mb-6">
            Daftar Kehadiran Kelas {{ $kelas->kelas }}
        </h1>

        <a href="{{ route('attendance.index') }}"
            class="mb-4 inline-block bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-full transition-transform transform hover:scale-105">
            ← Kembali
        </a>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <tbody class="text-gray-700 dark:text-gray-100">
                    @forelse ($attendances as $date => $records)
                        <div class="bg-blue-100 dark:bg-blue-900 px-6 py-3 rounded-full mt-6">
                            <strong class="text-lg text-blue-700 dark:text-yellow-300">Tanggal: {{ $date }}</strong>
                            <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                Diinput oleh: {{ $records->first()->user->name ?? 'Tidak diketahui' }}
                            </div>
                        </div>

                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg mt-2 mb-4">
                            <thead>
                                <tr class="bg-purple-100 dark:bg-purple-700 text-left text-gray-700 dark:text-gray-200">
                                    <th class="py-3 px-6">No</th>
                                    <th class="py-3 px-6">Nama Siswa</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $index => $attendance)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-purple-50 dark:hover:bg-purple-800 transition">
                                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                                        <td class="py-3 px-6">{{ $attendance->student->nm_siswa }}</td>
                                        <td class="py-3 px-6 capitalize">{{ $attendance->keterangan }}</td>
                                        <td class="py-3 px-6">
                                            @if ($attendance->foto_izin && $attendance->foto_izin !== 'noimage.png')
                                                <img src="{{ asset('storage/' . $attendance->foto_izin) }}"
                                                    onclick="openModal('{{ asset('storage/' . $attendance->foto_izin) }}')"
                                                    class="w-12 h-12 object-cover rounded-full cursor-pointer hover:scale-110 transition"
                                                    alt="Foto Izin">
                                            @else
                                                <span class="text-red-500">Tidak ada foto</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @empty
                        <div class="text-center py-4 text-gray-500">Tidak ada data absensi</div>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-4 rounded-xl shadow-xl relative max-w-lg w-full">
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl font-semibold">&times;</button>
                <img id="modal-image" class="max-h-[80vh] mx-auto rounded-xl" alt="Foto Izin Full">
            </div>
        </div>
    </div>

    <script>
        function openModal(imageSrc) {
            // Tampilkan modal
            document.getElementById('modal').classList.remove('hidden');

            // Set gambar pada modal
            document.getElementById('modal-image').src = imageSrc;
        }

        function closeModal() {
            // Sembunyikan modal
            document.getElementById('modal').classList.add('hidden');
        }

        // Menutup modal jika mengklik area luar modal
        document.getElementById('modal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
