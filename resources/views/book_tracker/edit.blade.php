@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Edit Tracking Buku</h1>
        <form action="{{ route('book-trackers.update', $tracker) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Buku</label>
                <select name="book_id" class="w-full border rounded px-3 py-2">
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" @selected(old('book_id', $tracker->book_id ?? '') == $book->id)>
                            {{ $book->title }} - {{ $book->author }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    @foreach (['want_to_read', 'reading', 'finished'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $tracker->status ?? '') == $status)>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Halaman Saat Ini</label>
                <input type="number" name="last_read_page" value="{{ old('last_read_page', $tracker->last_read_page ?? 0) }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5"
                    value="{{ old('rating', $tracker->rating ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Mulai</label>
                    <input type="date" name="started_at" value="{{ old('started_at', $tracker->started_at ?? '') }}"
                        class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block mb-1 font-semibold">Tanggal Selesai</label>
                    <input type="date" name="finished_at" value="{{ old('finished_at', $tracker->finished_at ?? '') }}"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <button type="submit" class="bg-amber-700 text-white px-4 py-2 rounded-[4px]">Simpan</button>
            <a href="{{ route('book-trackers.index') }}" class="bg-amber-700 text-white font-semibold px-4 py-2 rounded-[4px]">Kembali</a>
        </form>
    </div>
@endsection
