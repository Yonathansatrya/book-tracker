@extends('layouts.app')

@section('title', 'Search Results')
@section('content')
    <section class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 p-4 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 ">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Filter Option</h2>
                <button class="text-red-600 text-xs hover:underline">Reset All</button>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Posted</h3>
                <div class="space-y-3">
                    <label class="flex items-center"><input type="radio" name="posted" checked class="mr-2">
                        Today</label>
                    <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This week</label>
                    <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This month</label>
                    <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This year</label>
                    <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> Set up</label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Categories</h3>
                <div class="space-y-3">
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Fiction</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Educational</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Religion & Spiritual</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Poetry</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Graphic Novels & Comics</label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Author</h3>
                <input type="text" placeholder="Author's name"
                    class="w-full px-2 py-1 text-sm rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 mb-2">
                <div class="flex flex-wrap gap-1">
                    <span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-xs">Author 1 ✕</span>
                    <span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-xs">Author 2 ✕</span>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Rating</h3>
                <div class="space-y-3">
                    <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 5 stars</label>
                    <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 4 stars</label>
                    <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 3 stars</label>
                    <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 2 stars</label>
                    <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 1 star</label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Type of Book</h3>
                <div class="space-y-3">
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Short Reads</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Medium Reads</label>
                    <label class="flex items-center"><input type="checkbox" class="mr-2"> Long Reads</label>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Book Published at</h3>
                <div class="space-y-3">
                    <label class="flex items-center"><input type="radio" name="published" class="mr-2"> Today</label>
                    <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This
                        week</label>
                    <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This
                        month</label>
                    <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This
                        year</label>
                    <label class="flex items-center"><input type="radio" name="published" class="mr-2"> Set
                        up</label>
                </div>
            </div>
        </aside>

        {{-- Content --}}
        <div class="flex-1 p-4">
            <h2 class="font-bold px-4 text-2xl text-black mb-6">Book</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($books as $book)
                    <a href="#" class="max-w-[180px] bg-white rounded-xl shadow p-3 relative">
                        <div class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
                            <svg class="w-5 h-5 text-amber-700 hover:text-amber-600" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a5.374 5.374 0 0 1 7.607 7.603L12 18.187l-7.09-7.085a5.374 5.374 0 1 1 7.606-7.603z" />
                            </svg>
                        </div>
                        <img src="{{ asset('book_cover.svg') }}" alt="Book cover" alt="Book cover"
                            class="w-full h-40 object-cover rounded-lg mb-3">

                        <div class="text-center">
                            <h3 class="text-sm font-bold text-gray-900">{{ $book->title }}</h3>
                            <p class="text-xs text-gray-600 mb-1">
                                @foreach ($book->authors as $author)
                                    {{ $author->name }}@if (!$loop->last)
                                    @endif
                                @endforeach
                            </p>
                            <div class="flex justify-center space-x-0.5 text-amber-400 text-sm mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 fill-current {{ $i > 2 ? 'text-gray-300' : '' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-800 font-semibold"><span class="font-bold">5431</span> Read the
                                book</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @include('components.home.footer')
@endsection
