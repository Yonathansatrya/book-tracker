@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
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
            <a href="{{ route('genres.create') }}"
                class="px-4 py-2 bg-amber-700 text-white rounded-md shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Tambah Genre Baru
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full text-left table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Nama Genre</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Deskripsi</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $genre->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ Str::limit($genre->description, 50) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                <a href="{{ route('genres.edit', $genre->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800">Edit</a> |
                                <form id="deleted-genre-{{ $genre->id }}"
                                    action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirmdeleted({{ $genre->id }})"
                                        class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
         function confirmdeleted(genreId) {
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
                    document.getElementById('delete-author-' + authorId).submit();
                }
            })
        }
    </script>
@endsection
