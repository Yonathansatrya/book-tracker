@extends('layouts.app')

@section('title', 'Book - ' . $tracker->book->title)
@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-[4px] shadow mb-5">
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
            <form id="noteForm" action="{{ route('book-notes.store') }}" method="POST">
                @csrf
                <h3 class="text-lg font-semibold mb-2">Tulis Catatan</h3>
                <div class="grid grid-cols-3 gap-4 mb-2">
                    <div class="flex flex-col w-full sm:w-auto">
                        <label for="page_start" class="mb-1 text-sm text-center font-medium text-gray-700">
                            Halaman Mulai
                        </label>
                        <input type="number" name="page_start" id="page_start" required
                            class="py-2 px-4 shadow-md rounded-[4px] border border-gray-300 focus:ring focus:ring-amber-300 w-full sm:w-auto">
                    </div>

                    <div class="flex items-center justify-center w-full sm:w-auto">
                        <p class="text-gray-600 font-medium">hingga</p>
                    </div>

                    <div class="flex flex-col w-full sm:w-auto">
                        <label for="page_end" class="mb-1 text-sm text-center font-medium text-gray-700">
                            Halaman Akhir
                        </label>
                        <input type="number" name="page_end" id="page_end" placeholder="Opsional"
                            class="py-2 px-4 shadow-md rounded-[4px] border border-gray-300 focus:ring focus:ring-amber-600 w-full sm:w-auto">
                    </div>
                </div>
                <div id="editor" class="bg-white border border-gray-300 rounded shadow-md mb-4"
                    style="min-height: 150px;" placeholder="test">
                </div>
                {{-- kirimkan isi dari quilljs --}}
                <input type="hidden" name="notes" id="notes">
                {{-- ambil id book_user --}}
                <input type="hidden" name="book_user_id" value="{{ $tracker->id }}">

                <script>
                    const quill = new Quill('#editor', {
                        theme: 'snow'
                    });

                    const form = document.querySelector('#noteForm');
                    const notesInput = document.getElementById('notes');

                    form.addEventListener('submit', function(e) {
                        notesInput.value = quill.root.innerHTML;
                        console.log('Notes value:', notesInput.value);
                    });
                </script>
                <button type="submit"
                    class="bg-[#875C1A] hover:bg-[#6c4713] text-white font-semibold py-2 px-4 rounded-[4px] transition mt-2">
                    Submit
                </button>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto p-6 bg-white rounded-[4px] shadow-lg">
        <h3 class="text-2xl text-center font-bold mt-6 mb-4 text-[#6c4713]">Catatan</h3>

        @if ($tracker->notes->isEmpty())
            <p class="text-lg text-[#6c4713]">Belum ada catatan.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach ($tracker->notes as $note)
                    <div
                        class="bg-white p-4 rounded shadow-md space-y-4 hover:scale-[1.01] hover:shadow-md hover:shadow-amber-700 transition-transform duration-400">
                        <div class="text-xl text-center text-[#6c4713] font-semibold">
                            Halaman: {{ $note->page_start }} - {{ $note->page_end }}
                        </div>

                        <div class="prose max-w-none">
                            {!! $note->notes !!}
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <form action="{{ route('book-notes.destroy', $note->id) }}" method="POST"
                                id="delete-form-{{ $note->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $note->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-[4px] transition">
                                    Delete
                                </button>
                            </form>
                            <button onclick="openEditModal({{ $note->id }})"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-[4px] transition">
                                Edit
                            </button>
                        </div>
                    </div>

                    <!-- MODAL EDIT -->
                    <div id="editModal-{{ $note->id }}"
                        class="fixed inset-0 bg-black/50 bg-opacity-50 z-50 hidden flex items-center justify-center">
                        <div class="bg-white rounded-lg p-6 w-full max-w-4xl relative">
                            <button onclick="closeEditModal({{ $note->id }})"
                                class="absolute top-2 right-2 text-gray-500 text-2xl font-bold"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                    viewBox="0 0 24 24">
                                    <path fill="#000"
                                        d="m12 12.708l3.246 3.246q.14.14.344.15t.364-.15t.16-.354t-.16-.354L12.708 12l3.246-3.246q.14-.14.15-.344t-.15-.364t-.354-.16t-.354.16L12 11.292L8.754 8.046q-.14-.14-.344-.15t-.364.15t-.16.354t.16.354L11.292 12l-3.246 3.246q-.14.14-.15.345q-.01.203.15.363t.354.16t.354-.16zM12.003 21q-1.867 0-3.51-.708q-1.643-.709-2.859-1.924t-1.925-2.856T3 12.003t.709-3.51Q4.417 6.85 5.63 5.634t2.857-1.925T11.997 3t3.51.709q1.643.708 2.859 1.922t1.925 2.857t.709 3.509t-.708 3.51t-1.924 2.859t-2.856 1.925t-3.509.709M12 20q3.35 0 5.675-2.325T20 12t-2.325-5.675T12 4T6.325 6.325T4 12t2.325 5.675T12 20m0-8" />
                                </svg>
                            </button>

                            <form id="noteEditForm-{{ $note->id }}"
                                action="{{ route('book-notes.update', $note->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <h3 class="text-lg text-center font-semibold mb-2 text-[#6c4713]">Edit Catatan</h3>

                                <div class="grid grid-cols-3 gap-4 mb-2">
                                    <div class="flex flex-col w-full sm:w-auto">
                                        <label class="mb-1 text-sm text-center font-medium text-gray-700">
                                            Halaman Mulai
                                        </label>
                                        <input type="number" name="page_start" required value="{{ $note->page_start }}"
                                            class="py-2 px-4 shadow-md rounded-[4px] border border-gray-300 focus:ring focus:ring-amber-300 w-full sm:w-auto">
                                    </div>

                                    <div class="flex items-center justify-center w-full sm:w-auto">
                                        <p class="text-gray-600 font-medium">hingga</p>
                                    </div>

                                    <div class="flex flex-col w-full sm:w-auto">
                                        <label class="mb-1 text-sm text-center font-medium text-gray-700">
                                            Halaman Akhir
                                        </label>
                                        <input type="number" name="page_end" value="{{ $note->page_end }}"
                                            class="py-2 px-4 shadow-md rounded-[4px] border border-gray-300 focus:ring focus:ring-amber-600 w-full sm:w-auto">
                                    </div>
                                </div>

                                <div id="editor-{{ $note->id }}"
                                    class="bg-white border border-gray-300 rounded shadow-md mb-4"
                                    style="min-height: 150px;"></div>

                                <input type="hidden" name="notes" id="edit_notes_{{ $note->id }}">
                                <input type="hidden" name="book_user_id" value="{{ $note->book_user_id }}">

                                <button type="submit"
                                    class="bg-[#875C1A] hover:bg-[#6c4713] text-white font-semibold py-2 px-4 rounded-[4px] transition mt-2">
                                    Simpan Perubahan
                                </button>
                            </form>

                            <script>
                                const quillEdit{{ $note->id }} = new Quill("#editor-{{ $note->id }}", {
                                    theme: 'snow'
                                });
                                quillEdit{{ $note->id }}.root.innerHTML = @json($note->notes);

                                document.querySelector('#noteEditForm-{{ $note->id }}').addEventListener('submit', function() {
                                    document.querySelector('#edit_notes_{{ $note->id }}').value = quillEdit{{ $note->id }}.root
                                        .innerHTML;
                                });
                            </script>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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

        function confirmDelete(noteId) {
            const swalWithTailwindButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'bg-red-600 text-white font-semibold px-4 py-2 rounded-[4px] hover:bg-red-700 transition',
                    cancelButton: 'bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded-[4px] hover:bg-gray-400 transition'
                },
                buttonsStyling: false
            });

            swalWithTailwindButtons.fire({
                title: "Apakah kamu yakin?",
                text: "Catatan yang dihapus tidak bisa dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + noteId).submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithTailwindButtons.fire({
                        title: "Dibatalkan",
                        text: "Catatan tidak jadi dihapus.",
                        icon: "error"
                    });
                }
            });
        }

        // fucntion modal Edit catatan
        function openEditModal(id) {
            document.getElementById(`editModal-${id}`).classList.remove('hidden');
        }

        function closeEditModal(id) {
            document.getElementById(`editModal-${id}`).classList.add('hidden');
        }
    </script>
@endsection
