@extends('layouts.app')

@section('title', 'My books')
@section('content')
    @include('components.mybooks.sidebar')
    {{-- Tampilan Book --}}
    <div class="p-4 sm:ml-64">
        <section>
            <h2 class="text-center font-semibold text-amber-700 py-5 px-4 text-3xl">Buku Bacaan Kamu</h2>
            <div class="grid grid-cols-1 lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 gap-8 mb-4">
                @foreach ($trackers as $tracker)
                    <a href="{{ route('book-trackers.show', $tracker->id) }}"
                        class="block items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto hover:shadow-lg transition-shadow duration-200">

                        <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
                            class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

                        <h3 class="text-xl font-bold text-gray-900">{{ $tracker->book->title }}</h3>
                        <p class="text-md text-gray-700 mb-2">By: @foreach ($tracker->book->authors as $author)
                                {{ $author->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </p>
                        <p class="text-sm text-gray-600 mb-2">
                            Genre:
                            @foreach ($tracker->book->genres as $genre)
                                <span
                                    class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded mb-2">{{ $genre->name }}</span>
                            @endforeach
                        </p>
                        <p class="text-sm text-gray-500 mb-2">Status: {{ $tracker->status }}</p>
                        <p class="text-sm text-gray-500 mb-2">Progress: <span
                                class="font-semibold">{{ $tracker->last_read_page }}</span> /
                            {{ $tracker->book->total_page }} halaman</p>
                        <div class="flex justify-center items-center text-yellow-500 mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 fill-current {{ $i > 4 ? 'text-gray-300' : '' }}" viewBox="0 0 20 20">
                                    <path
                                        d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                                </svg>
                            @endfor
                        </div>

                        <p class="text-sm text-gray-700">
                            <span class="font-semibold">512</span> Read the book
                        </p>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-center mb-4">
                <a href="{{ route('book-trackers.create') }}"
                    class="bg-amber-700 text-white px-4 py-2 rounded-md hover:bg-amber-800 transition duration-200">Tambah
                    Buku Bacaan</a>
            </div>
        </section>
        <section>
            <div class="items-center bg-white rounded-[4px] shadow-xl p-5 text-center mx-auto sm:mx-1">
                @forelse ($books as $userBook)
                    @php $book = $userBook->book; @endphp
                    <h2 class="text-center font-semibold text-amber-700 py-5 px-4 text-3xl">Buku Kepunyaanmu</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mx-auto gap-4 mb-4">
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <h2 class="text-xl font-semibold text-amber-700">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600">by {{ $book->author }}</p>
                            <p class="text-sm text-gray-500">Published: {{ $book->published_at }}</p>
                            <div class="mt-2">
                                <span class="text-sm text-gray-600">Genre:</span>
                                @foreach ($book->genres as $genre)
                                    <span
                                        class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded">{{ $genre->name }}</span>
                                @endforeach
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('user-books.edit', $book->id) }}"
                                    class="text-amber-700 hover:underline">Edit</a>
                                <form action="{{ route('user-books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mb-4">
                        <a href="{{ route('book-trackers.index') }}"
                            class="bg-amber-700 text-white px-4 py-2 rounded-md hover:bg-amber-800 transition duration-200">Lihat
                            Semua</a>
                    </div>
                @empty
                    <p class="text-gray-600">Belum ada buku ditambahkan.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
