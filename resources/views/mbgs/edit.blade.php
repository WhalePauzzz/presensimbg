@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 bg-gradient-to-br from-green-100 via-blue-100 to-purple-100 rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold text-blue-700 mb-6 flex items-center gap-2">
        ✏️ Edit Data MBG - Tanggal {{ $date }}
    </h1>

    <form action="{{ route('mbgs.updateByDate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="bg-white shadow-lg rounded-xl overflow-x-auto p-4">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-blue-200 text-sm font-medium text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Total Siswa</th>
                        <th class="px-4 py-3">Total Hadir</th>
                        <th class="px-4 py-3">Diambil</th>
                        <th class="px-4 py-3">Dikembalikan</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Upload Foto Baru</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    @php
                    $mbg = $mbgs[$class->id] ?? null;
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold text-lg">{{ $class->kelas }}</td>
                        <td>{{ $mbg->total_siswa ?? 0 }}</td>
                        <td>{{ $mbg->total_hadir ?? 0 }}</td>
                        <td>
                            <input type="hidden" name="mbgs[{{ $class->id }}][diambil]" value="0">
                            <input type="checkbox" name="mbgs[{{ $class->id }}][diambil]" value="1"
                                {{ isset($mbg) && $mbg->diambil == 1 ? 'checked' : '' }}
                                class="w-6 h-6 rounded-full bg-green-200">
                        </td>
                        <td>
                            <input type="hidden" name="mbgs[{{ $class->id }}][dikembalikan]" value="0">
                            <input type="checkbox" name="mbgs[{{ $class->id }}][dikembalikan]" value="1"
                                {{ isset($mbg) && $mbg->dikembalikan == 1 ? 'checked' : '' }}
                                class="w-6 h-6 rounded-full bg-red-200">
                        </td>
                        <td>
                            @if ($mbg && $mbg->foto && basename($mbg->foto) !== 'noimage.png')
                            <img src="{{ asset('storage/' . $mbg->foto) }}" alt="Foto"
                                class="h-16 rounded-md mx-auto">
                            @else
                            <span class="text-red-500 text-sm">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            <input type="file" name="mbgs[{{ $class->id }}][foto]" class="text-sm border-2 border-blue-400 p-2 rounded-lg">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8 flex justify-end gap-4 flex-wrap">
            <button type="button"
                onclick="window.location.href='{{ route('mbgs.index') }}'"
                class="bg-white text-blue-700 border border-blue-500 hover:bg-blue-50 px-6 py-3 rounded-lg text-lg font-medium shadow">
                ⬅️ Kembali ke Index
            </button>
            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg shadow-xl text-lg font-semibold">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

            form.addEventListener('submit', function(e) {
                let hasChanges = false;

                const checkboxes = form.querySelectorAll('input[type="checkbox"]');
                const files = form.querySelectorAll('input[type="file"]');

                // Cek jika ada checkbox yang statusnya berubah
                checkboxes.forEach(cb => {
                    if (cb.checked !== cb.defaultChecked) {
                        hasChanges = true;
                    }
                });

                // Cek jika ada file yang dipilih
                files.forEach(fileInput => {
                    if (fileInput.files.length > 0) {
                        hasChanges = true;
                    }
                });

                // Kalau tidak ada perubahan, hentikan submit
                if (!hasChanges) {
                    e.preventDefault();
                    alert('⚠️ Wajib mengubah minimal satu data sebelum menyimpan!');
                }
            });
        });
    </script>

</div>
@endsection