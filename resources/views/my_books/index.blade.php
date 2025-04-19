@extends('layouts.app')

@section('title', 'My Books')
@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-amber-700">My Books</h1>
            <a href="{{ route('my-books.create') }}" class="bg-amber-700 text-white px-4 py-2 rounded hover:bg-amber-800">
                + Add Book
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-4">
            @forelse ($books as $userBook)
                @php $book = $userBook->book; @endphp
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-xl font-semibold text-amber-700">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-600">by {{ $book->author }}</p>
                    <p class="text-sm text-gray-500">Published: {{ $book->published_year }}</p>
                    <p class="text-sm text-gray-400">Total Halaman : {{ $book->total_page }}</p>
                    <div class="mt-2">
                        <span class="text-sm text-gray-600">Genres:</span>
                        @foreach ($book->genres as $genre)
                            <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded">{{ $genre->name }}</span>
                        @endforeach
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('my-books.edit', $book->id) }}" class="text-amber-700 hover:underline">Edit</a>
                        <form action="{{ route('my-books.destroy', $book->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Belum ada buku ditambahkan.</p>
            @endforelse
        </div>
    </div>
@endsection
