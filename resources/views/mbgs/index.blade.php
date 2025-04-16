@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">DATA MBG</h1>

        <!-- Input Tanggal -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <h5 class="text-lg font-medium text-gray-700 mb-3">Input Tanggal</h5>
            <form action="{{ route('mbgs.storeDate') }}" method="POST" class="flex items-center space-x-4">
                @csrf
                <input type="date" name="date" class="border rounded-lg px-4 py-2 w-48" required>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Simpan</button>
            </form>
        </div>

        <!-- Filter Tanggal -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <form method="GET" action="{{ route('mbgs.index') }}" class="flex items-center space-x-4">
                <label for="date" class="font-medium">Filter Tanggal:</label>
                <select name="date" id="date" class="border rounded px-3 py-2">
                    @foreach ($tanggalList as $tgl)
                        <option value="{{ $tgl }}" {{ $selectedDate == $tgl ? 'selected' : '' }}>
                            {{ $tgl }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

        <!-- MBG List per Tanggal -->
        @foreach ($tanggalList as $tanggal)
            <div class="bg-white shadow rounded-lg mb-8">
                <div class="bg-gray-200 px-4 py-3 rounded-t-lg">
                    <div class="bg-gray-200 px-4 py-3 rounded-t-lg flex justify-between items-center">
                        <h5 class="text-md font-semibold text-gray-800">Tanggal: {{ $tanggal }}</h5>
                        <a href="{{ route('mbgs.editByDate', ['date' => $tanggal]) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-4 py-2 rounded">
                            Edit
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-center">
                        <thead class="bg-gray-100 text-sm font-medium text-gray-700">
                            <tr>
                                <th>Kelas</th>
                                <th>Total Siswa</th>
                                <th>Total Hadir</th>
                                <th>Diambil</th>
                                <th>Dikembalikan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                @php
                                    $mbg = $mbgs->where('id_kelas', $class->id)->where('date', $tanggal)->first();
                                @endphp
                                <tr>
                                    <td>{{ $class->kelas }}</td>
                                    <td>{{ $mbg->total_siswa ?? 0 }}</td>
                                    <td>{{ $mbg->total_hadir ?? 0 }}</td>
                                    <td>
                                        <input type="checkbox" class="readonly-checkbox"
                                            data-message="Silakan edit melalui tombol Edit tanggal"
                                            {{ optional($mbg)->diambil ? 'checked' : '' }} disabled>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="readonly-checkbox"
                                            data-message="Silakan edit melalui tombol Edit tanggal"
                                            {{ optional($mbg)->dikembalikan ? 'checked' : '' }} disabled>
                                    </td>
                                    <td class="px-4 py-2">
                                        @if (!empty($mbg) && $mbg->foto && basename($mbg->foto) !== 'noimage.png')
                                            <img src="{{ asset('storage/' . $mbg->foto) }}"
                                                class="h-20 rounded shadow cursor-pointer"
                                                data-image="{{ asset('storage/' . $mbg->foto) }}" alt="Foto MBG">
                                        @else
                                            <span class="text-red-600 font-medium">Belum diinput</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if (empty($mbg) || !$mbg->foto || basename($mbg->foto) === 'noimage.png')
                                            <a href="{{ route('mbgs.inputFoto', $mbg->id ?? 0) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1 rounded">Upload
                                                Foto</a>
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
    <div class="mt-4">
        {{ $mbgs->appends(['date' => $selectedDate])->links() }}
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-4 rounded shadow-lg relative max-w-lg w-full">
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl">&times;</button>
            <img id="modal-image" class="max-h-[80vh] mx-auto rounded" alt="Foto MBG Full">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-status').change(function() {
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
                    success: function(response) {
                        console.log(response.message);
                    },
                    error: function() {
                        alert("Gagal mengupdate status!");
                    }
                });
            });
            $('img[data-image]').click(function() {
                var imageSrc = $(this).data('image'); // Mendapatkan sumber gambar dari atribut data-image
                $('#modal-image').attr('src', imageSrc); // Mengubah gambar di modal
                $('#modal').removeClass('hidden'); // Menampilkan modal
            });

            // Menutup modal ketika tombol close diklik
            $('#close-modal').click(function() {
                $('#modal').addClass('hidden'); // Menyembunyikan modal
            });

            // Menutup modal jika mengklik area luar modal
            $('#modal').click(function(event) {
                if ($(event.target).is('#modal')) {
                    $('#modal').addClass('hidden'); // Menyembunyikan modal jika mengklik area luar
                }
            });
            $('.readonly-checkbox').on('click', function(e) {
                e.preventDefault();
                alert($(this).data('message'));
            });

            $('img[data-image]').click(function() {
                var imageSrc = $(this).data('image');
                $('#modal-image').attr('src', imageSrc);
                $('#modal').removeClass('hidden');
            });

            $('#close-modal').click(function() {
                $('#modal').addClass('hidden');
            });

            $('#modal').click(function(event) {
                if ($(event.target).is('#modal')) {
                    $('#modal').addClass('hidden');
                }
            });
        });
    </script>
@endsection
