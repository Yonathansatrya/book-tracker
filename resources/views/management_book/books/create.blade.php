@extends('layouts.app')

@section('title', 'Tambah Buku')
@section('content')
    <div class="container mx-auto p-4 max-w-xl">
        <h1 class="text-2xl font-bold text-amber-700 mb-6">➕ Tambah Buku Baru</h1>

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input type="text" name="title" placeholder="Judul Buku" class="w-full border p-2 rounded" required>

            <input type="text" name="author" placeholder="Penulis" class="w-full border p-2 rounded" required>

            <input type="number" name="published_year" placeholder="Tahun Terbit" class="w-full border p-2 rounded"
                required>

            <input type="number" name="total_page" placeholder="Jumlah Halaman Buku" class="w-full border p-2 rounded"
                required>

            <textarea name="description" placeholder="Deskripsi" class="w-full border p-2 rounded"></textarea>

            <input type="number" step="0.1" name="average_rating" placeholder="Rating (0 - 5)"
                class="w-full border p-2 rounded">

            <input type="number" name="ratings_count" placeholder="Jumlah Rating" class="w-full border p-2 rounded">

            <label class="block">Cover Buku</label>
            <input type="file" name="cover_image" class="w-full border p-2 rounded">

            <label class="block">Genre</label>
            <select name="genre_ids[]" multiple class="w-full border p-2 rounded">
                @foreach (\App\Models\Genre::all() as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800">
                Simpan
            </button>
        </form>
    </div>
@endsection
