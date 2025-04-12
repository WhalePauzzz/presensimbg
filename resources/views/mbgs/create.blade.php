@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Tambah Data MBG</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 border border-red-300 p-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mbgs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date" class="block text-gray-700 font-medium mb-1">Pilih Tanggal:</label>
                <input type="date" name="date"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Generate Data
                </button>
            </div>
        </form>
    </div>
@endsection
