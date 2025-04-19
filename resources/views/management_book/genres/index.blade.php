@extends('layouts.app')

@section('title', 'Genres')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Genres</h1>
    <a href="{{ route('genres.create') }}" class="text-blue-500 underline">+ Add Genre</a>

    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $index => $genre)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $genre->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('genres.edit', $genre) }}" class="text-yellow-500 underline ml-2">Edit</a>
                        <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
