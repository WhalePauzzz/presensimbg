<div class="container mt-4">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Daftar Siswa</h3>
    <table class="min-w-full table-auto border-collapse border border-gray-300 shadow-md rounded-lg">
        <thead class="bg-blue-100 text-gray-800">
            <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Nama Siswa</th>
                <th class="px-4 py-2 text-left">NIS</th>
                <th class="px-4 py-2 text-left">Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr class="bg-white hover:bg-blue-50">
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $student->name }}</td>
                <td class="border px-4 py-2">{{ $student->nis }}</td>
                <td class="border px-4 py-2">{{ $student->kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
