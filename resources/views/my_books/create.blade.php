@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('content')
    <div class="container mx-auto p-4 max-w-2xl">
        <h1 class="text-2xl font-bold text-amber-700 mb-4">Tambah Buku</h1>

        <form action="{{ route('my-books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" name="author" id="author" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="total_page" class="block text-sm font-medium text-gray-700">Total Halaman Buku</label>
                <input type="number" name="total_page" id="total_page" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover</label>
                <input type="file" name="cover_image" id="cover_image" class="mt-1 w-full">
            </div>

            <div>
                <label for="genre_ids" class="block text-sm font-medium text-gray-700">Genre</label>
                <select name="genre_ids[]" id="genre_ids" multiple class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach (\App\Models\Genre::all() as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800">Simpan</button>
        </form>
    </div>
@endsection
