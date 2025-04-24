@extends('layouts.app')

@section('content')
<div
    class="max-w-7xl mx-auto px-4 py-8 bg-gradient-to-r from-teal-100 via-yellow-100 to-pink-100 min-h-screen rounded-lg shadow-lg">
    <h1 class="text-3xl font-bold text-pink-700 mb-6">📚 DATA MBG</h1>

        <!-- Input & Filter Tanggal -->
        <div class="flex flex-col md:flex-row gap-6 mb-6">
            <!-- Input Tanggal -->
            @php
                $today = date('Y-m-d');
            @endphp
            <div class="bg-white shadow-lg rounded-lg p-6 flex-1">
                <h5 class="text-xl font-medium text-gray-700 mb-4">🗓️ Input Tanggal</h5>
                <form action="{{ route('mbgs.storeDate') }}" method="POST" class="flex items-center space-x-6 flex-wrap">
                    @csrf
                    <input type="date" name="date" value="{{ $today }}" min="{{ $today }}"
                        max="{{ $today }}" class="border rounded-lg px-4 py-2 w-60 text-lg" required>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 text-lg font-semibold mt-4 md:mt-0">
                        Simpan
                    </button>
                </form>
            </div>
        </div>

        {{-- filter tanggal --}}
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h5 class="text-xl font-medium text-gray-700 mb-4">📅 Filter Tanggal</h5>
            <form method="GET" action="{{ route('mbgs.index') }}" class="flex items-center space-x-6 flex-wrap"
                id="filter-form">
                <select name="date" id="date" class="border rounded px-4 py-2 text-lg">
                    <option value="">-- Pilih Tanggal --</option>
                    @foreach ($tanggalList as $tgl)
                        <option value="{{ $tgl }}" {{ $selectedDate == $tgl ? 'selected' : '' }}>
                            {{ $tgl }}
                        </option>
                    @endforeach
                </select>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 text-lg font-semibold mt-4 md:mt-0">
                    Filter
                </button>
                @if ($selectedDate)
                    <a href="{{ route('mbgs.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full shadow-md transition transform hover:scale-105 text-lg font-semibold mt-4 md:mt-0">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- MBG List per Tanggal -->
        @foreach ($tanggalList as $tanggal)
            <div class="bg-white shadow-lg rounded-lg mb-8">
                <div class="bg-gray-200 px-6 py-4 rounded-t-lg flex justify-between items-center">
                    <h5 class="text-lg font-semibold text-gray-800">📅 Tanggal {{ $tanggal }}</h5>
                    <a href="{{ route('mbgs.editByDate', ['date' => $tanggal]) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-6 py-3 rounded-full shadow-md">
                        Edit
                    </a>
                </div>

                <!-- Tambahkan div untuk scroll horizontal di mode mobile -->
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
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($classes as $class)
                                @php
                                    $mbg = $mbgs->where('id_kelas', $class->id)->where('date', $tanggal)->first();
                                @endphp
                                <tr
                                    class="{{ $loop->even ? 'bg-yellow-50' : 'bg-pink-50' }} hover:bg-green-100 transition">
                                    <td class="px-4 py-3 font-semibold text-blue-700 text-lg">{{ $class->kelas }}</td>
                                    <td class="px-4 py-3 text-lg text-purple-700">{{ $mbg->total_siswa ?? '❓' }}</td>
                                    <td class="px-4 py-3 text-lg text-green-700 font-bold">
                                        {{ $mbg->total_hadir ?? '0' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div onclick="alert('Silakan edit melalui tombol Edit tanggal.')"
                                            class="cursor-pointer w-6 h-6 rounded-full {{ optional($mbg)->diambil ? 'bg-red-500' : 'bg-gray-300' }} mx-auto ring-2 ring-red-500">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div onclick="alert('Silakan edit melalui tombol Edit tanggal.')"
                                            class="cursor-pointer w-6 h-6 rounded-full {{ optional($mbg)->dikembalikan ? 'bg-green-500' : 'bg-gray-300' }} mx-auto ring-2 ring-green-500">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if (!empty($mbg) && $mbg->foto && basename($mbg->foto) !== 'noimage.png')
                                            <div class="flex justify-center">
                                                <img src="{{ asset('storage/' . $mbg->foto) }}"
                                                    class="h-20 rounded-lg shadow-md cursor-pointer border-2 border-pink-400"
                                                    data-image="{{ asset('storage/' . $mbg->foto) }}" alt="Foto MBG">
                                            </div>
                                        @else
                                            <div class="flex justify-center">
                                                <span class="text-red-500 font-bold">🚫 Belum ada foto</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if (!empty($mbg))
                                            <textarea readonly rows="2" class="w-full border rounded p-2 bg-gray-100 text-sm text-gray-800 cursor-not-allowed"
                                                onclick="alert('Silakan edit melalui tombol Edit tanggal.')">{{ $mbg->keteranganmbg ?? '-' }}</textarea>
                                        @else
                                            <span class="text-gray-400 italic">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach


    <!-- Pagination -->
    <div class="mt-6">
        {{ $mbgs->appends(['date' => $selectedDate])->links() }}
    </div>

        <!-- Modal -->
        <!-- Modal -->
        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] hidden">
            <div class="relative">
                <img id="modal-image" src="" alt="Foto MBG"
                    class="rounded-lg shadow-lg border-4 border-pink-400 max-w-[90vw] max-h-[90vh]">
                <button id="close-modal"
                    class="absolute -top-3 -right-3 bg-white border border-gray-300 rounded-full text-red-600 w-8 h-8 flex items-center justify-center text-xl shadow hover:bg-red-100">
                    &times;
                </button>
            </div>
        </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('img[data-image]').click(function() {
                var imageSrc = $(this).data('image');
                console.log("Klik gambar: ", imageSrc); // Cek apakah URL keluar di console
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

                $('.readonly-checkbox').on('click', function(e) {
                    e.preventDefault();
                    alert("Silakan edit melalui tombol Edit tanggal.");
                });

            });


        function closeModal() {
            $('#modal').addClass('hidden');
        }

        function showImageModal(src) {
            $('#modal-image').attr('src', src);
            $('#modal').removeClass('hidden');
        }
    </script>
</div>
@endsection