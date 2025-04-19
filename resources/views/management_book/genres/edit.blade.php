@extends('layouts.app')

@section('title', 'Edit Genre')

@section('content')
    <h1 class="text-xl font-bold mb-4">Edit Genre</h1>
    <form method="POST" action="{{ route('genres.update', $genre) }}">
        @csrf @method('PUT')
        <label>Name:</label>
        <input name="name" value="{{ $genre->name }}" class="border p-2 w-full" required>

        <label class="mt-4 block">Description:</label>
        <textarea name="description" class="border p-2 w-full">{{ $genre->description }}</textarea>

        <button class="mt-4 bg-blue-500 text-white px-4 py-2">Update</button>
    </form>
@endsection
