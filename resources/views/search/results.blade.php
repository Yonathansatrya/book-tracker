@extends('layouts.app')

@section('title', 'Search Results')
@section('content')
    <section class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 p-4 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <form action="{{ route('search') }}" method="GET">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Filter Option</h2>
                    <a href="{{ route('search') }}" class="text-red-600 text-xs hover:underline">Reset All</a>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                <path fill="#fff"
                                    d="M16 30a14 14 0 1 1 14-14a14 14 0 0 1-14 14m0-26a12 12 0 1 0 12 12A12 12 0 0 0 16 4" />
                                <path fill="#fff" d="M20.59 22L15 16.41V7h2v8.58l5 5.01z" />
                            </svg>
                        </span> Posted
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="radio" name="posted" value="all" class="mr-2"
                                {{ request('posted', 'all') === 'all' ? 'checked' : '' }}>
                            All
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="posted" value="today" class="mr-2"
                                {{ request('posted') === 'today' ? 'checked' : '' }}>
                            Today
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="posted" value="week" class="mr-2"
                                {{ request('posted') === 'week' ? 'checked' : '' }}>
                            This week
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="posted" value="month" class="mr-2"
                                {{ request('posted') === 'month' ? 'checked' : '' }}>
                            This month
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="posted" value="year" class="mr-2"
                                {{ request('posted') === 'year' ? 'checked' : '' }}>
                            This year
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m5.6 19.92l1.524-1.219l.01-.008c.318-.255.479-.383.658-.474q.241-.123.508-.178C8.499 18 8.706 18 9.122 18h8.681c1.118 0 1.678 0 2.105-.218a2 2 0 0 0 .874-.874C21 16.48 21 15.92 21 14.804V7.197c0-1.118 0-1.678-.218-2.105a2 2 0 0 0-.875-.874C19.48 4 18.92 4 17.8 4H6.2c-1.12 0-1.68 0-2.108.218a2 2 0 0 0-.874.874C3 5.52 3 6.08 3 7.2v11.471c0 1.066 0 1.599.218 1.872a1 1 0 0 0 .783.377c.35 0 .766-.334 1.599-1" />
                            </svg>
                        </span>Categories
                    </h3>
                    <div class="space-y-3">
                        @php
                            $selectedCategories = request()->input('categories', []);
                        @endphp

                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="Fiction" class="mr-2"
                                {{ in_array('Fiction', $selectedCategories) ? 'checked' : '' }}>
                            Fiction
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="Educational" class="mr-2"
                                {{ in_array('Educational', $selectedCategories) ? 'checked' : '' }}>
                            Educational
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="Religion & Spiritual" class="mr-2"
                                {{ in_array('Religion & Spiritual', $selectedCategories) ? 'checked' : '' }}>
                            Religion & Spiritual
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="Poetry" class="mr-2"
                                {{ in_array('Poetry', $selectedCategories) ? 'checked' : '' }}>
                            Poetry
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="categories[]" value="Graphic Novels & Comics" class="mr-2"
                                {{ in_array('Graphic Novels & Comics', $selectedCategories) ? 'checked' : '' }}>
                            Graphic Novels & Comics
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2048 2048">
                                <path fill="#fff"
                                    d="M1468 1139q-52 43-89 96q-83-42-173-62t-184-21q-108 0-206 27t-184 76t-154 119t-119 155t-76 185t-27 206H128q0-146 43-281t124-247t193-196t254-129q-54-36-96-83t-72-102t-46-116t-16-126q0-106 40-199t110-162t163-110t199-41t199 40t162 110t110 163t41 199q0 65-16 126t-45 117t-73 102t-97 83q43 14 83 31t80 40M640 640q0 80 30 149t82 122t122 83t150 30q79 0 149-30t122-82t83-122t30-150q0-79-30-149t-82-122t-123-83t-149-30q-80 0-149 30t-122 82t-83 123t-30 149m1090 511q66 0 125 25t102 69t69 102t26 125q0 66-25 124t-69 102t-103 69t-125 26q-97 0-177-54l-292 292q-19 19-45 19t-45-19t-19-45t19-45l292-292q-54-80-54-177q0-66 25-124t69-102t102-69t125-26m0 514q40 0 75-15t61-41t42-62t16-75q0-40-15-75t-42-61t-61-42t-76-15q-40 0-75 15t-61 42t-42 61t-15 75q0 40 15 75t41 61t62 42t75 15" />
                            </svg>
                        </span>Author
                    </h3>
                    <div id="authors-container" class="space-y-3">
                        <input type="text" placeholder="Author's name"
                            class="w-full px-2 py-1 text-sm rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#875C1A] mb-2">
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="#fff"
                                    d="M7.966 17.883L12 15.463l4.054 2.464l-1.056-4.58l3.544-3.055l-4.669-.42L12 5.547l-1.854 4.298l-4.669.402l3.544 3.098zM12 16.66l-4.515 2.71q-.16.079-.296.064q-.137-.016-.266-.094q-.129-.08-.196-.226q-.067-.148-.012-.319l1.197-5.071l-3.983-3.444q-.135-.117-.168-.266q-.034-.15.028-.29t.164-.231t.282-.117l5.234-.444l2.048-4.816q.068-.165.196-.238T12 3.806t.288.073t.195.238l2.067 4.816l5.235.444q.183.026.288.116t.158.232q.061.14.028.29q-.034.149-.169.266l-3.982 3.444l1.196 5.09q.056.171-.012.309t-.196.217q-.129.078-.265.093q-.137.016-.297-.063zm7.116-10.604l-1.29.75q-.13.065-.239-.003t-.058-.205l.342-1.42l-1.132-.945q-.106-.087-.067-.207q.04-.12.178-.141l1.505-.129l.58-1.349q.044-.128.185-.128t.182.13l.579 1.347l1.5.129q.138.022.178.141q.039.12-.067.207l-1.132.946l.342 1.419q.05.137-.059.205q-.108.068-.237.004zm-7.097 5.669" />
                            </svg>
                        </span>Rating
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="radio" name="rating" value="" class="mr-2"
                                {{ request('rating') === null ? 'checked' : '' }}> All
                        </label>
                        @for ($i = 5; $i >= 1; $i--)
                            <label class="flex items-center">
                                <input type="radio" name="rating" value="{{ $i }}" class="mr-2"
                                    {{ request('rating') == $i ? 'checked' : '' }}>
                                {{ $i }} star{{ $i > 1 ? 's' : '' }}
                            </label>
                        @endfor
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <g fill="none" stroke="#fff" stroke-width="1.5">
                                    <path
                                        d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"
                                        opacity="0.5" />
                                    <path stroke-linecap="round" d="M8 10h8m-8 4h5" />
                                </g>
                            </svg>
                        </span>Page Count
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="type[]" value="short" class="mr-2"
                                {{ in_array('short', (array) request('type', [])) ? 'checked' : '' }}> Short Reads
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="type[]" value="medium" class="mr-2"
                                {{ in_array('medium', (array) request('type', [])) ? 'checked' : '' }}> Medium Reads
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="type[]" value="long" class="mr-2"
                                {{ in_array('long', (array) request('type', [])) ? 'checked' : '' }}> Long Reads
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="flex bg-[#875C1A] text-white px-3 py-2 rounded text-sm font-semibold mb-2 gap-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32">
                                <path fill="#fff"
                                    d="M16 30a14 14 0 1 1 14-14a14 14 0 0 1-14 14m0-26a12 12 0 1 0 12 12A12 12 0 0 0 16 4" />
                                <path fill="#fff" d="M20.59 22L15 16.41V7h2v8.58l5 5.01z" />
                            </svg>
                        </span>Book Published at
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="radio" name="published" value="all-time" class="mr-2" checked
                                {{ request('published') == 'all-time' ? 'checked' : '' }}> All
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="published" value="today" class="mr-2"
                                {{ request('published') == 'today' ? 'checked' : '' }}> Today
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="published" value="week" class="mr-2"
                                {{ request('published') == 'week' ? 'checked' : '' }}> This week
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="published" value="month" class="mr-2"
                                {{ request('published') == 'month' ? 'checked' : '' }}> This month
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="published" value="year" class="mr-2"
                                {{ request('published') == 'year' ? 'checked' : '' }}> This year
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="published" value="setup" class="mr-2"
                                {{ request('published') == 'setup' ? 'checked' : '' }}> Set Up
                        </label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="px-4 py-2 bg-[#875C1A] text-white rounded hover:bg-amber-800">
                        Apply Filter
                    </button>
                </div>
            </form>
        </aside>

        {{-- Content --}}
        <div class="flex-1 p-4">
            @include('components.search.content')
        </div>
    </section>
    @include('components.home.footer')
@endsection
