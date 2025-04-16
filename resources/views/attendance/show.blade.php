@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">
            Daftar Kehadiran Kelas {{ $kelas->kelas }}
        </h1>

        <a href="{{ route('attendance.index') }}"
            class="mb-4 inline-block bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            ← Kembali
        </a>

        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                <tbody class="text-gray-700 dark:text-gray-100">
                    @forelse ($attendances as $date => $records)
                        <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded mt-6">
                            <strong>Tanggal: {{ $date }}</strong>
                            <div class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                Diinput oleh: {{ $records->first()->user->name ?? 'Tidak diketahui' }}
                            </div>
                        </div>

                        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow mt-2 mb-4">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-600 text-left text-gray-700 dark:text-gray-200">
                                    <th class="py-2 px-4">No</th>
                                    <th class="py-2 px-4">Nama Siswa</th>
                                    <th class="py-2 px-4">Status</th>
                                    <th class="py-2 px-4">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $index => $attendance)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                                        <td class="py-2 px-4">{{ $attendance->student->nm_siswa }}</td>
                                        <td class="py-2 px-4 capitalize">{{ $attendance->keterangan }}</td>
                                        <td class="py-2 px-4">
                                            @if ($attendance->foto_izin && $attendance->foto_izin !== 'noimage.png')
                                                <img src="{{ asset('storage/' . $attendance->foto_izin) }}"
                                                    onclick="openModal('{{ asset('storage/' . $attendance->foto_izin) }}')"
                                                    class="w-12 h-12 object-cover rounded border cursor-pointer hover:scale-105 transition"
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
            <div class="bg-white p-4 rounded shadow-lg relative max-w-lg w-full">
                <button onclick="closeModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
                <img id="modal-image" class="max-h-[80vh] mx-auto rounded" alt="Foto Izin Full">
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
