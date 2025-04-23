@extends('layouts.app')

@section('title', 'Detail Book Read')

@section('content')
    {{-- <div class="flex justify-between items-center mb-6">
        <a href="{{ route('my-books.index') }}"
            class="inline-flex items-center bg-amber-700 text-white rounded-md px-4 py-2 text-sm font-semibold hover:bg-amber-800 transition">
            ← Back
        </a>
        <a href="{{ route('my-books.index') }}"
            class="inline-flex items-center bg-amber-700 text-white rounded-md px-4 py-2 text-sm font-semibold hover:bg-amber-800 transition">
            Next →
        </a>
    </div> --}}
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">

        <div class="flex flex-col md:flex-row gap-6">

            <div class="md:w-1/3">
                <img src="{{ asset('book_cover.svg') }}" alt="Book cover" class="w-full h-64 object-cover rounded-lg">
            </div>

            <div class="md:w-2/3">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $tracker->book->title }}</h2>
                <p class="text-black mb-4">by {{ $tracker->book->author->name ?? 'Unknown' }}</p>

                <div class="mb-4">
                    <p class="text-sm text-gray-700">
                        Progress: <span class="font-semibold">{{ $tracker->last_read_page }}</span> /
                        {{ $tracker->book->total_page }} halaman
                    </p>
                </div>

                <form action="{{ route('book-trackers.updateProgress', $tracker->id) }}" method="POST"
                    class="flex items-center gap-2 update-form">
                    @csrf
                    @method('PUT')
                    <input type="number" name="last_read_page"
                        class="border rounded px-2 py-1 w-24 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Page..." value="{{ $tracker->last_read_page }}">
                    <button type="submit"
                        class="bg-amber-700 text-white px-4 py-1 rounded-[4px] hover:bg-amber-800 transition">Update</button>
                </form>

                <div class="mt-2">
                    <h4 class="text-lg font-semibold mb-2">Tambah Catatan</h4>
                    <form action="{{ route('book-notes.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="book_user_id" value="{{ $tracker->id }}">
                        <div class="grid grid-cols-3 items-center gap-2">
                            <div>
                                <label for="page_start" class="block text-sm font-medium text-gray-700 mb-1">Halaman</label>
                                <input type="number" name="page_start" id="page_start"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                                    required>
                            </div>

                            <div class="text-center mt-6 text-sm text-gray-600">
                                Hingga
                            </div>

                            <div>
                                <label for="page_end" class="block text-sm font-medium text-gray-700 mb-1">Halaman</label>
                                <input type="number" name="page_end" id="page_end" placeholder="Opsional"
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="notes" id="notes" rows="3"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                                required></textarea>
                        </div>

                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Simpan
                            Catatan</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-2">Catatan</h3>

            @if ($tracker->notes->isEmpty())
                <p class="text-sm text-gray-500">Belum ada catatan.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($tracker->notes as $note)
                        <div class="p-4 rounded-lg bg-amber-700 shadow-md">
                            <div class="justify-between items-center">
                                <div class="mb-4">
                                    <h3 class="text-white text-lg font-semibold">Halaman {{ $note->page_start }} sampai {{ $note->page_end }}
                                    </h3>
                                    <p class="text-sm text-white ">{{ $note->notes }}</p>
                                </div>
                                <div class="flex gap-2">
                                    {{-- {{ route('book-notes.edit', $note->id) }} --}}
                                    <a href="#"
                                        class="px-4 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('book-notes.destroy', $note->id) }}" method="POST"
                                        id="delete-form-{{ $note->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $note->id }})"
                                            class="px-4 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>

                                    <script>
                                        function confirmDelete(noteId) {
                                            const swalWithBootstrapButtons = Swal.mixin({
                                                customClass: {
                                                    confirmButton: "btn btn-success",
                                                    cancelButton: "btn btn-danger"
                                                },
                                                buttonsStyling: false
                                            });

                                            swalWithBootstrapButtons.fire({
                                                title: "Are you sure?",
                                                text: "You won't be able to revert this!",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonText: "Yes, delete it!",
                                                cancelButtonText: "No, cancel!",
                                                reverseButtons: true
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    document.getElementById('delete-form-' + noteId).submit();
                                                    swalWithBootstrapButtons.fire({
                                                        title: "Deleted!",
                                                        text: "Your note has been deleted.",
                                                        icon: "success"
                                                    });
                                                } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                    swalWithBootstrapButtons.fire({
                                                        title: "Cancelled",
                                                        text: "Your note is safe :)",
                                                        icon: "error"
                                                    });
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <script>
        document.querySelectorAll('.update-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Update progress?",
                    text: "Pastikan kamu yakin ingin mengubah halaman terakhir.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, update!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

@endsection
