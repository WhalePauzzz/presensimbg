@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6 bg-gradient-to-br from-blue-200 via-purple-200 to-pink-200 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6 text-center">Input Absensi</h1>

        <!-- Pilih Kelas -->
        <form method="GET" class="mb-6" action="{{ route('attendance.create') }}">
            <div class="mb-4">
                <label for="filter_kelas" class="block text-lg font-medium text-gray-700 mb-2">Pilih Kelas</label>
                <select name="kelas" id="filter_kelas" class="w-full p-3 border-2 border-pink-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" onchange="this.form.submit()">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        @if (!empty($students) && count($students) > 0)
            <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kelas" value="{{ request('kelas') }}">

                <table class="min-w-full table-auto border border-gray-300 rounded-lg shadow-md">
                    <thead class="bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 text-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Kelas</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Foto Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="bg-white hover:bg-gray-50 transition-all">
                                <td class="border px-4 py-3">{{ $student->nm_siswa }}</td>
                                <td class="border px-4 py-3">{{ $student->classes->kelas ?? '-' }}</td>
                                <td class="border px-4 py-3">
                                    <input type="hidden" name="attendance[{{ $student->id }}][id_siswa]" value="{{ $student->id_siswa }}">
                                    <input type="date" name="attendance[{{ $student->id }}][date]" value="{{ date('Y-m-d') }}" class="w-full p-3 border-2 border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                                </td>
                                <td class="border px-4 py-3">
                                    <select name="attendance[{{ $student->id }}][keterangan]" class="w-full p-3 border-2 border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" required onchange="togglePhotoInput(this)">
                                        <option value="present" selected>Hadir</option>
                                        <option value="absent">Absen</option>
                                    </select>
                                </td>
                                <td class="border px-4 py-3">
                                    <input type="file" name="attendance[{{ $student->id }}][foto_izin]" class="w-full border-2 border-pink-300 rounded-lg px-2 py-1 mt-1 attendance-photo" disabled>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6 flex justify-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-colors">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        @else
            <p class="text-center text-gray-600">Silakan pilih kelas terlebih dahulu untuk mengisi absensi.</p>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        function togglePhotoInput(select) {
            const photoInput = select.closest('tr').querySelector('.attendance-photo');
            if (select.value === 'absent') {
                photoInput.disabled = false;
            } else {
                photoInput.disabled = true;
                photoInput.value = '';
            }
        }

        // Set default tanggal untuk semua input saat satu diubah
        document.addEventListener('DOMContentLoaded', function() {
            const dateInputs = document.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const value = this.value;
                    dateInputs.forEach(i => i.value = value);
                });
            });
        });
    </script>
@endsection
