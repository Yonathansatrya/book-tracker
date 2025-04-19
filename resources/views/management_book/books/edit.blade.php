@extends('layouts.app')

@section('title', 'Edit Buku')
@section('content')
    <div class="container mx-auto p-4 max-w-xl">
        <h1 class="text-2xl font-bold text-amber-700 mb-6">✏️ Edit Buku</h1>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="title" value="{{ $book->title }}" class="w-full border p-2 rounded" required>

            <input type="text" name="author" value="{{ $book->author }}" class="w-full border p-2 rounded" required>

            <input type="number" name="published_year" value="{{ $book->published_year }}"
                class="w-full border p-2 rounded" required>

            <input type="number" name="total_page" value="{{ $book->total_page }}"
                class="w-full border p-2 rounded" required>

            <textarea name="description" class="w-full border p-2 rounded">{{ $book->description }}</textarea>

            <input type="number" step="0.1" name="average_rating" value="{{ $book->average_rating }}"
                class="w-full border p-2 rounded">

            <input type="number" name="ratings_count" value="{{ $book->ratings_count }}" class="w-full border p-2 rounded">

            <label class="block">Ganti Cover (opsional)</label>
            <input type="file" name="cover_image" class="w-full border p-2 rounded">

            <label class="block">Genre</label>
            <select name="genre_ids[]" multiple class="w-full border p-2 rounded">
                @foreach (\App\Models\Genre::all() as $genre)
                    <option value="{{ $genre->id }}" {{ $book->genres->contains($genre->id) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800">
                Update Buku
            </button>
        </form>
    </div>
@endsection
