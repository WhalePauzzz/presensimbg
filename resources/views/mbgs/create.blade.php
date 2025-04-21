@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-gradient-to-r from-purple-400 via-pink-300 to-yellow-200 p-8 rounded-xl shadow-lg">
        <h2 class="text-3xl font-semibold mb-6 text-white text-center">
            ✨ Tambah Data MBG
        </h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-700 border-l-4 border-red-500 p-4 rounded-lg shadow">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mbgs.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="date" class="block text-lg text-gray-800 font-medium mb-2">Pilih Tanggal:</label>
                <input type="date" name="date"
                    class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 shadow-lg transform transition hover:scale-105">
                    Generate Data
                </button>
            </div>
        </form>
    </div>
@endsection
