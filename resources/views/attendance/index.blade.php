@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Kehadiran</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('attendance.create') }}" class="btn btn-primary mb-3">Tambah Kehadiran</a>

    <div class="row">
        @foreach($kelasList as $kelas)
            <div class="col-md-4">
                <div class="card mb-3 kelas-card" data-kelas-id="{{ $kelas->id_kelas }}">
                    <div class="card-body">
                        <h5 class="card-title">Kelas: {{ $kelas->kelas }}</h5>
                        <p class="card-text">Klik untuk melihat absensi</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="attendance-list" class="mt-4" style="display: none;">
        <h2 class="mb-3">Daftar Kehadiran Kelas <span id="kelas-name"></span></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody id="attendance-body">
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
                url: "{{ url('/attendance/getByClass') }}/" + kelasId,
                method: "GET",
                success: function(response) {
                    $('#attendance-body').html('');
                    $('#kelas-name').text(kelasName);
                    
                    if (response.length > 0) {
                        $.each(response, function(index, attendance) {
                            let foto = attendance.foto_izin ? 
                                `<a href="/storage/${attendance.foto_izin}" target="_blank" class="btn btn-info btn-sm">Lihat Foto</a>` :
                                '<img src="/storage/noimage.png" class="img-thumbnail" width="50">';

                            $('#attendance-body').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${attendance.student.nm_siswa}</td>
                                    <td>${attendance.date}</td>
                                    <td>${attendance.keterangan.charAt(0).toUpperCase() + attendance.keterangan.slice(1)}</td>
                                    <td>${foto}</td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#attendance-body').append('<tr><td colspan="5" class="text-center">Tidak ada data absensi</td></tr>');
                    }
                    
                    $('#attendance-list').show();
                }
            });
        });
    });
</script>
@endsection