{{-- resources/views/book_trackers/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Book Tracker')
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4">Book Tracker</h1>

    <a href="{{ route('book_trackers.create') }}" class="bg-amber-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Track Buku</a>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[10px]">
        @foreach ($trackers as $tracker)
            <div class="border p-4 items-center justify-center rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold">{{ $tracker->book->title }} by {{ $tracker->book->author }}</h2>
                <p class="text-sm text-gray-600 mb-1">Status: <strong>{{ ucfirst(str_replace('_', ' ', $tracker->status)) }}</strong></p>
                <p class="text-sm text-gray-600 mb-1">Halaman saat ini: {{ $tracker->last_read_page }} / {{ $tracker->book->total_page }}</p>
                @if ($tracker->rating)
                    <p class="text-sm text-gray-600 mb-1">Rating: {{ $tracker->rating }}/5</p>
                @endif
                <div class="flex gap-2 mt-2">
                    <a href="{{ route('book_trackers.edit', $tracker) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('book_trackers.destroy', $tracker) }}" method="POST" onsubmit="return confirm('Yakin hapus tracking ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
