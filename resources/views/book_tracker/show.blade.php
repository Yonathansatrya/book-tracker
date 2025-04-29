@extends('layouts.app')

@section('title', 'Detail Book - ' . $tracker->book->title)
@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-[4px] shadow">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/3">
                <img src="{{ $tracker->book && $tracker->book->cover_image
                    ? asset('storage/' . $tracker->book->cover_image)
                    : asset('no-image.png') }}"
                    alt="Book cover" class="w-full h-64 object-cover rounded-[4px]" />
            </div>

            <div class="md:w-2/3">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $tracker->book->title }}</h2>
                <p class="text-sm text-gray-600 mb-2">By: @foreach ($tracker->book->authors as $author)
                        {{ $author->name }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p class="text-sm text-gray-600 mb-2">Status: {{ $tracker->status }}</p>
                <p class="text-sm text-gray-600 mb-2">Genre:
                    @foreach ($tracker->book->genres as $genre)
                        <span
                            class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-[4px] mb-2">{{ $genre->name }}</span>
                    @endforeach
                </p>
                <p class="text-sm text-gray-600 mb-2">Published: {{ $tracker->book->published_at }}</p>
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
                        class="border rounded-[4px] px-2 py-1 w-24 focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Page..." value="{{ $tracker->last_read_page }}">

                    <button type="submit"
                        class="bg-amber-700 text-white px-4 py-1 rounded-[4px] hover:bg-amber-800 transition">Update</button>
                </form>

                {{-- rating after compleceted book --}}
                @if ($tracker->last_read_page == $tracker->book->total_page)
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold">Berikan Rating Buku {{ $tracker->book->title }}</h3>
                        <form action="{{ route('book-trackers.rating', $tracker->id) }}" method="POST">
                            @csrf
                            <div class="flex items-center gap-2">
                                <label for="rating" class="text-sm text-gray-700">Rating:</label>
                                <div class="flex items-center" id="star-rating">
                                    <span class="star text-2xl cursor-pointer" data-value="1">☆</span>
                                    <span class="star text-2xl cursor-pointer" data-value="2">☆</span>
                                    <span class="star text-2xl cursor-pointer" data-value="3">☆</span>
                                    <span class="star text-2xl cursor-pointer" data-value="4">☆</span>
                                    <span class="star text-2xl cursor-pointer" data-value="5">☆</span>
                                </div>
                                <input type="hidden" name="rating" id="rating" value="{{ $tracker->rating ?? '' }}" />
                            </div>

                            <button type="submit"
                                class="bg-amber-700 text-white px-4 py-1 rounded-[4px] hover:bg-amber-800 transition mt-4">
                                Kirim Rating
                            </button>
                        </form>
                    </div>

                    <script>
                        let currentRating = document.getElementById('rating').value;
                        if (currentRating) {
                            updateStarRating(currentRating);
                        }

                        document.querySelectorAll('.star').forEach(star => {
                            star.addEventListener('click', function() {
                                let ratingValue = this.getAttribute('data-value');
                                document.getElementById('rating').value = ratingValue;
                                updateStarRating(ratingValue);
                            });
                        });

                        function updateStarRating(ratingValue) {
                            document.querySelectorAll('.star').forEach(star => {
                                if (star.getAttribute('data-value') <= ratingValue) {
                                    star.classList.add('text-yellow-500');
                                    star.classList.remove('text-gray-400');
                                } else {
                                    star.classList.add('text-gray-400');
                                    star.classList.remove('text-yellow-500');
                                }
                            });
                        }
                    </script>
                @endif
            </div>
        </div>

        <div class="mt-8">
            <div class="">
                <h3 class="text-lg font-semibold mb-2">Tulis Catatan</h3>
                <div id="quill-editor" class="bg-white rounded border border-gray-300" style="height: 150px;"></div>
            </div>
                <h3 class="text-lg font-semibold mt-6 mb-2">Catatan</h3>
                @if ($tracker->notes->isEmpty())
                    <p class="text-sm text-gray-500">Belum ada catatan.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($tracker->notes as $note)
                            <div class="p-4 rounded-[4px] bg-amber-700 shadow-md">
                                <div class="mb-4">
                                    <h3 class="text-white text-lg font-semibold">
                                        Halaman {{ $note->page_start }}
                                        {{ $note->page_end ? 'sampai ' . $note->page_end : '' }}
                                    </h3>
                                    <div class="text-sm text-white">{!! $note->notes !!}</div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="#"
                                        onclick="showEditNoteModal({{ $note->id }}, {{ $note->page_start }}, {{ $note->page_end ?? 'null' }}, @js($note->notes) )"
                                        class="px-4 py-1 bg-blue-600 text-white rounded-[4px] hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('book-notes.destroy', $note->id) }}" method="POST"
                                        id="delete-form-{{ $note->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $note->id }})"
                                            class="px-4 py-1 bg-red-600 text-white rounded-[4px] hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>
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

        const quill = new Quill('#editor', {
            theme: 'snow'
        });

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

    {{-- di gunakan untuk add notes jangan di hapus --}}
    <form id="form" method="POST" style="display: none;">
        @csrf
    </form>
@endsection
