@extends('layouts.app')

@section('title', 'Add Genre')

@section('content')
    <h1 class="text-xl font-bold mb-4">Add Genre</h1>
    <form method="POST" action="{{ route('genres.store') }}">
        @csrf
        <label>Name:</label>
        <input name="name" class="border p-2 w-full" required>

        <label class="mt-4 block">Description:</label>
        <textarea name="description" class="border p-2 w-full"></textarea>

        <button class="mt-4 bg-blue-500 text-white px-4 py-2">Save</button>
    </form>
@endsection
