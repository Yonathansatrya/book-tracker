@extends('layouts.app')

@section('title', 'Edit Buku')
@section('content')
    <div class="container mx-auto p-4 max-w-2xl">
        <h1 class="text-2xl font-bold text-amber-700 mb-4">Edit Buku</h1>

        <form action="{{ route('my-books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ $book->title }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year" value="{{ $book->published_year }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="total_page" class="block text-sm font-medium text-gray-700">Jumlah Halaman Buku</label>
                <input type="number" name="total_page" id="total_page" value="{{ $book->total_page }}" required
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ $book->description }}</textarea>
            </div>

            <div>
                <label for="average_rating" class="block text-sm font-medium text-gray-700">Rating Rata-rata</label>
                <input type="number" step="0.1" name="average_rating" id="average_rating"
                    value="{{ $book->average_rating }}" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="ratings_count" class="block text-sm font-medium text-gray-700">Jumlah Rating</label>
                <input type="number" name="ratings_count" id="ratings_count" value="{{ $book->ratings_count }}"
                    class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            @if ($book->cover_image)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Cover Sekarang</label>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="h-32 mt-2 object-cover rounded">
                </div>
            @endif

            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700">Ganti Cover</label>
                <input type="file" name="cover_image" id="cover_image" class="mt-1 w-full">
            </div>

            <div>
                <label for="genre_ids" class="block text-sm font-medium text-gray-700">Genre</label>
                <select name="genre_ids[]" id="genre_ids" multiple class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach (\App\Models\Genre::all() as $genre)
                        <option value="{{ $genre->id }}" {{ $book->genres->contains($genre->id) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800">Update</button>
        </form>
    </div>
@endsection
