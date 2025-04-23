@extends('layouts.app')

@section('title', 'Book')

@section('content')
    {{-- side bar --}}
    {{-- <aside class="w-64 p-4 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 text-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-base font-semibold text-gray-800 dark:text-gray-100">Filter Option</h2>
            <button class="text-red-600 text-xs hover:underline">Reset All</button>
        </div>

        <!-- Posted -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Posted</h3>
            <div class="space-y-1">
                <label class="flex items-center"><input type="radio" name="posted" checked class="mr-2"> Today</label>
                <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This week</label>
                <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This month</label>
                <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> This year</label>
                <label class="flex items-center"><input type="radio" name="posted" class="mr-2"> Set up</label>
            </div>
        </div>

        <!-- Categories -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Categories</h3>
            <div class="space-y-1">
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Fiction</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Educational</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Religion & Spiritual</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Poetry</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Graphic Novels & Comics</label>
            </div>
        </div>

        <!-- Author -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Author</h3>
            <input type="text" placeholder="Author's name"
                class="w-full px-2 py-1 text-sm rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-500 mb-2">
            <div class="flex flex-wrap gap-1">
                <span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-xs">Author 1 ✕</span>
                <span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-xs">Author 2 ✕</span>
            </div>
        </div>

        <!-- Rating -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Rating</h3>
            <div class="space-y-1">
                <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 5 stars</label>
                <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 4 stars</label>
                <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 3 stars</label>
                <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 2 stars</label>
                <label class="flex items-center"><input type="radio" name="rating" class="mr-2"> 1 star</label>
            </div>
        </div>

        <!-- Type of Book -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Type of Book</h3>
            <div class="space-y-1">
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Short Reads</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Medium Reads</label>
                <label class="flex items-center"><input type="checkbox" class="mr-2"> Long Reads</label>
            </div>
        </div>

        <!-- Book Published at -->
        <div class="mb-6">
            <h3 class="bg-amber-700 text-white px-3 py-1 rounded text-sm font-semibold mb-2">Book Published at</h3>
            <div class="space-y-1">
                <label class="flex items-center"><input type="radio" name="published" class="mr-2"> Today</label>
                <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This week</label>
                <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This
                    month</label>
                <label class="flex items-center"><input type="radio" name="published" class="mr-2"> This
                    year</label>
                <label class="flex items-center"><input type="radio" name="published" class="mr-2"> Set up</label>
            </div>
        </div>
    </aside> --}}

    <section class="border-2 border-amber-700 rounded-[4px] mx-auto py-4">
        <h2 class="font-bold px-4 text-2xl text-black mb-10">Book</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($books as $book)
                <a href="#"
                    class="block items-center bg-white rounded-[16px] shadow p-5 text-center mx-auto hover:shadow-lg transition-shadow duration-200">

                    <img src="{{ asset('book_cover.svg') }}" alt="Book cover"
                        class="w-full h-46 object-cover rounded-[16px] mb-1 px-2" />

                    <h3 class="text-lg font-bold text-gray-900">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">by: {{ $book->author }}</p>
                    <p class="text-sm text-gray-600 mb-2">{{ $book->description }}</p>
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
        <div class="max-w-[180px] bg-white rounded-xl shadow p-3 relative">
            <!-- Favorite icon -->
            <div class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
                <svg class="w-5 h-5 text-amber-700 hover:text-amber-600" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a5.374 5.374 0 0 1 7.607 7.603L12 18.187l-7.09-7.085a5.374 5.374 0 1 1 7.606-7.603z" />
                </svg>
            </div>

            <!-- Book image -->
            <img src="https://i.ibb.co/3f1M7Nm/book-cover.jpg" alt="Book cover"
                class="w-full h-40 object-cover rounded-lg mb-3">

            <!-- Book info -->
            <div class="text-center">
                <h3 class="text-sm font-bold text-gray-900">Book name</h3>
                <p class="text-xs text-gray-600 mb-1">Author</p>

                <!-- Rating -->
                <div class="flex justify-center space-x-0.5 text-amber-400 text-sm mb-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 0 0 .95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 0 0-.364 1.118l1.286 3.966c.3.922-.755 1.688-1.538 1.118l-3.385-2.46a1 1 0 0 0-1.175 0l-3.385 2.46c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 0 0-.364-1.118L2.075 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 0 0 .95-.69l1.286-3.967z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 0 0 .95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 0 0-.364 1.118l1.286 3.966c.3.922-.755 1.688-1.538 1.118l-3.385-2.46a1 1 0 0 0-1.175 0l-3.385 2.46c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 0 0-.364-1.118L2.075 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 0 0 .95-.69l1.286-3.967z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 0 0 .95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 0 0-.364 1.118l1.286 3.966c.3.922-.755 1.688-1.538 1.118l-3.385-2.46a1 1 0 0 0-1.175 0l-3.385 2.46c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 0 0-.364-1.118L2.075 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 0 0 .95-.69l1.286-3.967z" />
                    </svg>
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 0 0 .95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 0 0-.364 1.118l1.286 3.966c.3.922-.755 1.688-1.538 1.118l-3.385-2.46a1 1 0 0 0-1.175 0l-3.385 2.46c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 0 0-.364-1.118L2.075 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 0 0 .95-.69l1.286-3.967z" />
                    </svg>
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 0 0 .95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 0 0-.364 1.118l1.286 3.966c.3.922-.755 1.688-1.538 1.118l-3.385-2.46a1 1 0 0 0-1.175 0l-3.385 2.46c-.783.57-1.838-.196-1.538-1.118l1.286-3.966a1 1 0 0 0-.364-1.118L2.075 9.394c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 0 0 .95-.69l1.286-3.967z" />
                    </svg>
                </div>

                <!-- Read count -->
                <p class="text-xs text-gray-800 font-semibold"><span class="font-bold">5431</span> Read the book</p>
            </div>
        </div>
    </section>
@endsection
