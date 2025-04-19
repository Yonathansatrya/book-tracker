@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">{{ $book->title }}</h1>
        <a href="{{ route('books.edit', $book) }}" class="text-blue-600">Edit</a>
    </div>

    @if($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="h-48 mb-4 rounded shadow">
    @endif

    <p><strong>Author:</strong> {{ $book->author->name }}</p>
    <p><strong>Genre:</strong> {{ $book->genre->name }}</p>
    <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
    <p class="mt-4"><strong>Description:</strong></p>
    <p>{{ $book->description }}</p>

    <form action="{{ route('books.destroy', $book) }}" method="POST" class="mt-4">
        @csrf @method('DELETE')
        <button class="bg-red-500 text-white px-4 py-2">Delete</button>
    </form>
@endsection
