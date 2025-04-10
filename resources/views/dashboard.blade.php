<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <h1 class="my-4">Daftar Siswa</h1>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('students.create') }}" class="btn btn-success">Tambah Siswa</a>
            </div>

            <div class="row">
                @foreach($kelasList as $kelas)
                <div class="col-md-4">
                    <div class="card mb-3 kelas-card" data-kelas-id="{{ $kelas->id_kelas }}">
                        <div class="card-body">
                            <h5 class="card-title">Kelas: {{ $kelas->kelas }}</h5>
                            <p class="card-text">Klik untuk melihat siswa</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div id="student-list" class="mt-4" style="display: none;">
                <h2 class="mb-3">Daftar Siswa Kelas <span id="kelas-name"></span></h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody id="student-body">
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.kelas-card').click(function() {
                    let kelasId = $(this).data('kelas-id');
                    let kelasName = $(this).find('.card-title').text();

                    $.ajax({
                        url: "{{ url('/students/getByClass') }}/" + kelasId,
                        method: "GET",
                        success: function(response) {
                            $('#student-body').html('');
                            $('#kelas-name').text(kelasName);

                            if (response.length > 0) {
                                $.each(response, function(index, student) {
                                    $('#student-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${student.nm_siswa}</td>
                                    <td>${student.classes.jurusan ?? 'Tidak ada jurusan'}</td>
                                </tr>
                            `);
                                });
                            } else {
                                $('#student-body').append('<tr><td colspan="3" class="text-center">Tidak ada siswa</td></tr>');
                            }

                            $('#student-list').show();
                        }
                    });
                });
            });
        </script>
    </div>
</x-app-layout>