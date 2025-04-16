@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Input Absensi</h1>

        <!-- Pilih Kelas -->
        <form method="GET" class="mb-6" action="{{ route('attendance.create') }}">
            <div class="mb-4">
                <label for="filter_kelas" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas</label>
                <select name="kelas" id="filter_kelas" class="w-full ..." onchange="this.form.submit()">
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

                <table class="min-w-full table-auto border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Nama</th>
                            <th class="border px-4 py-2">Kelas</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Foto Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $student->nm_siswa }}</td>
                                <td class="border px-4 py-2">{{ $student->classes->kelas ?? '-' }}</td>
                                <td class="border px-4 py-2">

                                    <input type="hidden" name="attendance[{{ $student->id }}][id_siswa]"
                                        value="{{ $student->id_siswa }}">

                                    <input type="date" name="attendance[{{ $student->id }}][date]"
                                        value="{{ date('Y-m-d') }}" class="..." required>
                                </td>
                                <td class="border px-4 py-2">
                                    <select name="attendance[{{ $student->id }}][keterangan]" class="..." required
                                        onchange="togglePhotoInput(this)">
                                        <option value="present" selected>Hadir</option>
                                        <option value="absent">Absen</option>
                                    </select>
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="file" name="attendance[{{ $student->id }}][foto_izin]"
                                        class="w-full border rounded px-2 py-1 attendance-photo" disabled>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        @else
            <p class="text-gray-600">Silakan pilih kelas terlebih dahulu untuk mengisi absensi.</p>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
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
