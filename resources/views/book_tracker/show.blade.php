@extends('layouts.app')

@section('title', 'Detail Book - ' . $tracker->book->title)
@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow">
        <div class="flex flex-col md:flex-row gap-6">

            <div class="md:w-1/3">
                <img src="{{ asset('book_cover.svg') }}" alt="Book cover" class="w-full h-64 object-cover rounded-lg">
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
                        <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded mb-2">{{ $genre->name }}</span>
                    @endforeach
                </p>
                <p class="text-sm text-gray-600 mb-2">Published: {{ $tracker->book->published_year }}</p>
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

                    <button type="button" onclick="showAddNoteModal({{ $tracker->id }})"
                        class="bg-amber-700 text-white px-4 py-1 rounded-[4px] hover:bg-amber-800 transition">
                        Tambah Catatan
                    </button>
                </form>
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
                                    <h3 class="text-white text-lg font-semibold">Halaman {{ $note->page_start }} sampai
                                        {{ $note->page_end }}
                                    </h3>
                                    <p class="text-sm text-white ">{{ $note->notes }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="#"
                                        onclick="showEditNoteModal({{ $note->id }}, {{ $note->page_start }}, {{ $note->page_end ?? 'null' }}, @js($note->notes) )"
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

        function showAddNoteModal(bookUserId) {
            swal.fire({
                title: "Tambah Catatan",
                html: `
                    <input type="number" id="page_start" class="swal2-input" placeholder="Halaman mulai">
                    <input type="number" id="page_end" class="swal2-input" placeholder="Halaman akhir (opsional)">
                    <textarea id="notes" class="swal2-textarea" placeholder="Catatan" rows="4"></textarea>
                `,
                confirmButtonText: "Simpan",
                showCancelButton: true,
                preConfirm: () => {
                    const pageStart = document.getElementById('page_start').value;
                    const pageEnd = document.getElementById('page_end').value;
                    const notes = document.getElementById('notes').value;

                    if (!pageStart || !notes) {
                        Swal.showValidationMessage("Halaman mulai dan catatan tidak boleh kosong");
                        return false;
                    }

                    const form = document.getElementById('form')
                    form.innerHTML = '';
                    const csrf = document.querySelector('input[name="_token"]').cloneNode();
                    form.appendChild(csrf);
                    form.method = 'POST';
                    form.action = "{{ route('book-notes.store') }}";

                    const userId = document.createElement('input');
                    userId.type = 'hidden';
                    userId.name = 'book_user_id';
                    userId.value = bookUserId;
                    form.appendChild(userId);

                    const pageStartInput = document.createElement('input');
                    pageStartInput.type = 'hidden';
                    pageStartInput.name = 'page_start';
                    pageStartInput.value = pageStart;
                    form.appendChild(pageStartInput);

                    const pageEndInput = document.createElement('input');
                    pageEndInput.type = 'hidden';
                    pageEndInput.name = 'page_end';
                    pageEndInput.value = pageEnd;
                    form.appendChild(pageEndInput);

                    const notesInput = document.createElement('input');
                    notesInput.type = 'hidden';
                    notesInput.name = 'notes';
                    notesInput.value = notes;
                    form.appendChild(notesInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }

        function showEditNoteModal(noteId, pageStart, pageEnd, notes) {
            Swal.fire({
                title: "Edit Catatan",
                html: `
                    <input type="number" id="edit_page_start" class="swal2-input" placeholder="Halaman mulai" value="${pageStart}">
                    <input type="number" id="edit_page_end" class="swal2-input" placeholder="Halaman akhir (opsional)" value="${pageEnd !== null ? pageEnd : ''}">
                    <textarea id="edit_notes" class="swal2-textarea" placeholder="Catatan">${notes}</textarea>
                `,
                confirmButtonText: "Update",
                showCancelButton: true,
                preConfirm: () => {
                    const newPageStart = document.getElementById('edit_page_start').value;
                    const newPageEnd = document.getElementById('edit_page_end').value;
                    const newNotes = document.getElementById('edit_notes').value;

                    if (!newPageStart || !newNotes) {
                        Swal.showValidationMessage("Halaman mulai dan catatan tidak boleh kosong");
                        return false;
                    }

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/book-notes/${noteId}`;

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'PUT';
                    form.appendChild(method);

                    const inputStart = document.createElement('input');
                    inputStart.type = 'hidden';
                    inputStart.name = 'page_start';
                    inputStart.value = newPageStart;
                    form.appendChild(inputStart);

                    const inputEnd = document.createElement('input');
                    inputEnd.type = 'hidden';
                    inputEnd.name = 'page_end';
                    inputEnd.value = newPageEnd;
                    form.appendChild(inputEnd);

                    const inputNotes = document.createElement('input');
                    inputNotes.type = 'hidden';
                    inputNotes.name = 'notes';
                    inputNotes.value = newNotes;
                    form.appendChild(inputNotes);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

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
