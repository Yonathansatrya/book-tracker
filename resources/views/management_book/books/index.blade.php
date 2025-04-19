@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Books</h1>
    <a href="{{ route('books.create') }}" class="text-blue-500 underline">+ Add Book</a>
    <div class="">
        <thead>
            <table class="table-auto
                w-full mt-4 border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Author</th>
                    <th class="border border-gray-300 px-4 py-2">Genre</th>
                    <th class="border border-amber-700 px-4 py-3">Total Halaman</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
                <tbody>
                    @foreach ($books as $index => $book)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $book->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $book->author }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @foreach ($book->genres as $genre)
                                    <span class="text-sm text-gray-600">{{ $genre->name }}</span>
                                    @if (!$loop->last)
                                        <span class="text-sm text-gray-600">, </span>
                                    @endif
                                @endforeach
                            <td class="border border-amber-700 px-4 py-3">{{ $book->total_page }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('books.edit', $book) }}" class="text-yellow-500 underline ml-2">Edit</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 underline"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </thead>
    </div>
@endsection
