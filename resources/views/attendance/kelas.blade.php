<div class="container mt-4">
    <h3>Daftar Siswa</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
