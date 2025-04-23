@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Buku Saya</h1>

        <form action="{{ route('user-books.update', $userBook->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                    value="{{ old('title', $book->title) }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="published_year" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('published_year') border-red-500 @enderror"
                    value="{{ old('published_year', $book->published_year) }}">
                @error('published_year')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="total_page" class="block text-sm font-medium text-gray-700">Jumlah Halaman</label>
                <input type="number" name="total_page" id="total_page"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('total_page') border-red-500 @enderror"
                    value="{{ old('total_page', $book->total_page) }}">
                @error('total_page')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Sampul</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="mt-1 block w-full text-sm text-gray-700 file:border file:rounded-md file:p-2 file:bg-gray-50 file:text-gray-700 @error('cover_image') border-red-500 @enderror">
                @error('cover_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                @if ($book->cover_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover Image" width="150">
                    </div>
                @endif
            </div>

            <div class="mb-4">
                <label for="genre_ids" class="block text-sm font-medium text-gray-700">Pilih Genre</label>
                <select name="genre_ids[]" id="genre_ids"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('genre_ids') border-red-500 @enderror"
                    multiple>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ in_array($genre->id, old('genre_ids', $book->genres->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
                @error('genre_ids')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author_ids" class="block text-sm font-medium text-gray-700">Pilih Author</label>
                <select name="author_ids[]" id="author_ids"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('author_ids') border-red-500 @enderror"
                    multiple>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ in_array($author->id, old('author_ids', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_ids')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Perbarui Buku
                </button>
                <a href="{{ route('user-books.index') }}"
                    class="px-6 py-2 bg-amber-700 text-white rounded-md shadow-md hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-amber-500">Kembali</a>
            </div>
        </form>
    </div>
@endsection
