@extends('layouts.app')

@section('title', 'New Read Book')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-amber-700 mb-4">Baca Buku Baru</h1>
        <form action="{{ route('book-trackers.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-lg font-medium">Buku</label>
                <select name="book_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" @selected(old('book_id', $tracker->book_id ?? '') == $book->id)>
                            {{ $book->title }} - {{ $book->authors->pluck('name')->implode(', ') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Status</label>
                <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach (['want_to_read', 'reading', 'finished'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $tracker->status ?? '') == $status)>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Halaman Saat Ini</label>
                <input type="number" name="last_read_page"
                    value="{{ old('last_read_page', $tracker->last_read_page ?? 0) }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5"
                    value="{{ old('rating', $tracker->rating ?? '') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Mulai</label>
                    <input type="date" name="started_at" value="{{ old('started_at', $tracker->started_at ?? '') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Selesai</label>
                    <input type="date" name="finished_at" value="{{ old('finished_at', $tracker->finished_at ?? '') }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('my-books') }}" class="bg-amber-700 text-white font-semibold px-4 py-2 rounded-[4px]">Kembali</a>
        </form>
    </div>
@endsection
