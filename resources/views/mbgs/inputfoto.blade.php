@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Upload Foto MBG</h2>

        <form action="{{ route('mbgs.storeFoto', $mbg->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="foto" class="block text-gray-700 font-medium mb-1">Pilih Foto:</label>
                <input type="file" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none"
                    name="foto" required>
            </div>
            <div class="flex justify-between mt-6">
                <a href="{{ route('mbgs.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                    ← Kembali
                </a>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Upload
                </button>
            </div>
        </form>
    </div>
@endsection
