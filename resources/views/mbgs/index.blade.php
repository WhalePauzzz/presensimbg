@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Data MBGs</h2>

    <!-- Input Tanggal -->
    <div class="bg-white shadow rounded-lg mb-6 p-4">
        <h5 class="text-lg font-medium text-gray-700 mb-3">Input Tanggal</h5>
        <form action="{{ route('mbgs.storeDate') }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <input type="date" name="date" class="border rounded-lg px-4 py-2 w-48" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Simpan</button>
        </form>
    </div>

    <!-- MBG List per Tanggal -->
    @foreach ($tanggalList as $tanggal)
    <div class="bg-white shadow rounded-lg mb-8">
        <div class="bg-gray-200 px-4 py-3 rounded-t-lg">
            <h5 class="text-md font-semibold text-gray-800">Tanggal: {{ $tanggal }}</h5>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-center">
                <thead class="bg-gray-100 text-sm font-medium text-gray-700">
                    <tr>
                        <th class="px-4 py-2">Kelas</th>
                        <th class="px-4 py-2">Total Siswa</th>
                        <th class="px-4 py-2">Total Hadir</th>
                        <th class="px-4 py-2">Diambil</th>
                        <th class="px-4 py-2">Dikembalikan</th>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach ($classes as $class)
                        @php
                            $mbg = $mbgs->where('id_kelas', $class->id_kelas)->where('date', $tanggal)->first();
                        @endphp
                        <tr>
                            <td class="px-4 py-2">{{ $class->kelas }}</td>
                            <td class="px-4 py-2">{{ $mbg->total_siswa ?? 0 }}</td>
                            <td class="px-4 py-2">{{ $mbg->total_hadir ?? 0 }}</td>
                            <td class="px-4 py-2">
                                <input type="checkbox" class="toggle-status rounded" data-id="{{ $mbg->id_mbg ?? 0 }}" data-field="diambil"
                                       {{ optional($mbg)->diambil ? 'checked' : '' }}>
                            </td>
                            <td class="px-4 py-2">
                                <input type="checkbox" class="toggle-status rounded" data-id="{{ $mbg->id_mbg ?? 0 }}" data-field="dikembalikan"
                                       {{ optional($mbg)->dikembalikan ? 'checked' : '' }}>
                            </td>
                            <td class="px-4 py-2">
                                @if (!empty($mbg) && $mbg->foto)
                                    <img src="{{ asset('storage/' . $mbg->foto) }}" class="h-20 rounded shadow">
                                @else
                                    <span class="text-red-600 font-medium">Belum diinput</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if (empty($mbg) || !$mbg->foto)
                                    <a href="{{ route('mbgs.inputFoto', $mbg->id_mbg ?? 0) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">Upload Foto</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.toggle-status').change(function () {
            let mbgId = $(this).data('id');
            let field = $(this).data('field');
            let status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('mbgs.updateStatus') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: mbgId,
                    field: field,
                    status: status
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function () {
                    alert("Gagal mengupdate status!");
                }
            });
        });
    });
</script>
@endsection
