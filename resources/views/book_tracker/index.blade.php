@extends('layouts.app')

@section('title', 'Book Tracker')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl text-center py-10 font-bold mb-4">Book Tracker</h1>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        @endif

        <div class="">
            <a href="{{ route('my-books') }}" class="py-2 px-6 bg-blue-300 text-white rounded-[4px]"> Kembali Ke Libary</a>

            <a href="{{ route('book-trackers.create') }}"
                class="bg-amber-700 text-white px-4 py-2 rounded-[4px] mb-4 inline-block">+
                Track Buku</a>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-[10px] px-10 py-10 shadow-sm shadow-amber-700">
            @foreach ($trackers as $tracker)
                <div class="p-4 py-5 px-5 items-center justify-center rounded-[4px] shadow-lg shadow-blue-100">
                    <h2 class="text-xl font-semibold">{{ $tracker->book->title }} by {{ $tracker->book->author }}</h2>
                    <p class="text-sm text-gray-600 mb-1">Status:
                        <strong>{{ ucfirst(str_replace('_', ' ', $tracker->status)) }}</strong>
                    </p>
                    <p class="text-sm text-gray-600 mb-1">Halaman saat ini: {{ $tracker->last_read_page }} /
                        {{ $tracker->book->total_page }}</p>
                    @if ($tracker->rating)
                        <p class="text-sm text-gray-600 mb-1">Rating: {{ $tracker->rating }}/5</p>
                    @endif
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('book-trackers.edit', $tracker) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form id="delete-tracker-form-{{ $tracker->id }}"
                            action="{{ route('book-trackers.destroy', $tracker) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDeleteTracker({{ $tracker->id }})"
                                class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function confirmDeleteTracker(trackerId) {
            Swal.fire({
                title: 'Yakin ingin menghapus Bacaan ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-tracker-form-' + trackerId).submit();
                }
            });
        }
    </script>
@endsection
