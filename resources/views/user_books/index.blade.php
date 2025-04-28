@extends('layouts.app')

@section('title', 'Libary Buku Saya')
@section('content')
    <div class="max-w-7xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Genre</h2>

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

        <div class="mb-4">
            <a href="{{ route('user-books.create') }}"
                class="px-4 py-2 bg-amber-700 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Tambah Buku Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($userBooks as $userBook)
                <div class="bg-white rounded-2xl shadow-md p-4">
                    <h2 class="text-xl font-semibold">{{ $userBook->book->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $userBook->book->published_at }}</p>

                    <div class="mt-2 flex justify-between">
                        <a href="{{ route('user-books.edit', $userBook->id) }}"
                            class="text-amber-700 hover:underline">Edit</a>
                        <form id="delete-user-book-form-{{ $userBook->id }}"
                            action="{{ route('user-books.destroy', $userBook->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $userBook->id }})"
                                class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Tidak ada buku.</p>
            @endforelse
        </div>
    </div>
    <script>
        function confirmDelete(userBookId) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-user-book-form-' + userBookId).submit();
                }
            });
        }
    </script>
@endsection
