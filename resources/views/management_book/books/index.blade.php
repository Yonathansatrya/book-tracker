@extends('layouts.app')

@section('title', 'Libary - Book')
@section('content')
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Buku</h2>

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
            <a href="{{ route('books.create') }}"
                class="px-4 py-2 bg-amber-700 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Tambah Buku Baru
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full text-left table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Judul Buku</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Tahun Terbit</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Jumlah Halaman</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Jumlah Ratings</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Genre</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Author</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $book->title }}</td>
                            <td class="py-4 text-sm text-gray-800">{{ $book->published_at }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $book->total_page }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $book->average_rating }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                @foreach ($book->genres as $genre)
                                    <span
                                        class="inline-block px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ $genre->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                @foreach ($book->authors as $author)
                                    <span
                                        class="inline-block px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">{{ $author->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800">Edit</a> |
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block"
                                    id="delete-form-{{ $book->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $book->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
