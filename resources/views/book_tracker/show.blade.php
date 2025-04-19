@extends('layouts.app')

@section('title', 'book')
@section('content')
    <section>
        <div>

        </div>
        <div class="mt-[40px]">
            {{-- <form action="{{ route('book-notes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="book_tracker_id" value="{{ $bookTracker->id }}">

            <div class="form-group">
                <label for="page_start">Halaman Mulai</label>
                <input type="number" name="page_start" class="form-control" id="page_start" required>
            </div>

            <div class="form-group">
                <label for="page_end">Halaman Akhir</label>
                <input type="number" name="page_end" class="form-control" id="page_end" required>
            </div>

            <div class="form-group">
                <label for="notes">Catatan</label>
                <textarea name="notes" class="form-control" id="notes" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Catatan</button>
        </form> --}}
        </div>
    </section>
@endsection
