@extends('layouts.app')

@section('title', 'My books')
@section('content')
    @include('components.mybooks.sidebar')


    {{-- Tampilan Book --}}
    <div class="p-4 sm:ml-64">
        <section>
            <div class="grid grid-cols-1 lg:grid-cols-5 md:grid-cols-3 sm:grid-cols-2 gap-8 mb-4">
                @foreach ($books as $userBook)
                    @php
                        $book = $userBook->book;
                        $tracker = $book->trackers->first();
                    @endphp

                    <div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto">
                        <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
                            class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

                        <h3 class="text-lg font-bold text-gray-900">{{ $book->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $book->author }}</p>

                        <!-- Rating -->
                        @if ($tracker && $tracker->rating)
                            <div class="flex justify-center items-center text-yellow-500 mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $tracker->rating ? 'fill-current' : 'text-gray-300 fill-current' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                                    </svg>
                                @endfor
                            </div>
                        @endif

                        <p class="text-sm text-gray-700">
                            Halaman dibaca:
                            <span class="font-semibold">{{ $tracker->last_read_page ?? '0' }} /
                                {{ $book->total_page }}</span>
                        </p>
                    </div>
                @endforeach
                <div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto">
                    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
                        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

                    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
                    <p class="text-sm text-gray-600 mb-2">Author</p>

                    <!-- Star -->
                    <div class="flex justify-center items-center text-yellow-500 mb-1">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                    </div>

                    <p class="text-sm text-gray-700">
                        <span class="font-semibold">512</span> Read the book
                    </p>
                </div>
                <a href="{{ route('book-trackers.show', ['bookTracker' => $bookTracker->id]) }}" class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto">

                </a>
                <div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
                    @forelse ($books as $userBook)
                        @php $book = $userBook->book; @endphp
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <h2 class="text-xl font-semibold text-amber-700">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600">by {{ $book->author }}</p>
                            <p class="text-sm text-gray-500">Published: {{ $book->published_year }}</p>
                            <div class="mt-2">
                                <span class="text-sm text-gray-600">Genre:</span>
                                @foreach ($book->genres as $genre)
                                    <span
                                        class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded">{{ $genre->name }}</span>
                                @endforeach
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('my-books.edit', $book->id) }}"
                                    class="text-amber-700 hover:underline">Edit</a>
                                <form action="{{ route('my-books.destroy', $book->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Belum ada buku ditambahkan.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
    </section>
@endsection
{{--
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div>
<div class="items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto sm:mx-0">
    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

    <h3 class="text-lg font-bold text-gray-900">Book name</h3>
    <p class="text-sm text-gray-600 mb-2">Author</p>

    <!-- Star -->
    <div class="flex justify-center items-center text-yellow-500 mb-1">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
        <svg class="w-5 h-5 text-gray-300 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
        </svg>
    </div>

    <p class="text-sm text-gray-700">
        <span class="font-semibold">512</span> Read the book
    </p>
</div> --}}
