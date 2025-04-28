@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <section class="px-4 sm:px-10 lg:px-[120px] mb-[48px] py-10">
        <h3 class="text-left font-semibold text-[16px] text-black mb-3">Continue</h3>

        <div class="bg-[#FFF2DE] rounded-[4px] justify-center grid grid-cols-1 sm:grid-cols-2 shadow-sm p-6 px-10">
            <div class="flex flex-col items-center justify-center gap-4 px-4">
                <h2 class="text-[16px] font-semibold text-center lg:text-left mb-4 lg:mb-0">
                    Currently Reading Books ({{ $totalBook }})
                </h2>

                <div class="flex gap-4">
                    <a href="{{ route('my-books') }}"
                        class="bg-[#61481C] text-white text-sm px-4 py-2 rounded-[4px] flex items-center gap-2">
                        View All Books
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24">
                            <defs>
                                <path id="weuiArrowOutlined0" fill="currentColor"
                                    d="m7.588 12.43l-1.061 1.06L.748 7.713a.996.996 0 0 1 0-1.413L6.527.52l1.06 1.06l-5.424 5.425z">
                                </path>
                            </defs>
                            <use fill-rule="evenodd" href="#weuiArrowOutlined0" transform="rotate(-180 5.02 9.505)"></use>
                        </svg>
                    </a>
                    <a href="{{ route('user-books.create') }}"
                        class="bg-white border border-[#61481C] text-[#61481C] text-sm px-4 py-2 rounded-[4px]">Add a
                        Book</a>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div class="text-center">
                    <img src="http://127.0.0.1:8000/dashboard-assets/book_1.svg" class="w-full h-40 object-cover rounded mb-2"
                        alt="">
                    <p class="text-xs font-semibold">Hypocrite World</p>
                    <p class="text-xs text-gray-600">By Sophia Hill</p>
                </div>
                <div class="text-center">
                    <img src="http://127.0.0.1:8000/dashboard-assets/book_2.svg" class="w-full h-40 object-cover rounded mb-2"
                        alt="">
                    <p class="text-xs font-semibold">The Lady Beauty Scarlett</p>
                    <p class="text-xs text-gray-600">By Arthur Doyle</p>
                </div>
                <div class="text-center">
                    <img src="http://127.0.0.1:8000/dashboard-assets/book_3.svg" class="w-full h-40 object-cover rounded mb-2"
                        alt="">
                    <p class="text-xs font-semibold">Your Simple Book Cover</p>
                    <p class="text-xs text-gray-600">By Ken Adams</p>
                </div>
                <div class="text-center">
                    <img src="http://127.0.0.1:8000/dashboard-assets/book_4.svg" class="w-full h-40 object-cover rounded mb-2"
                        alt="">
                    <p class="text-xs font-semibold">Great Travel At Dessert</p>
                    <p class="text-xs text-gray-600">By Sanchit Howdi</p>
                </div>
                <div class="text-center">
                    <img src="http://127.0.0.1:8000/dashboard-assets/book_5.svg" class="w-full h-40 object-cover rounded mb-2"
                        alt="">
                    <p class="text-xs font-semibold">Secrets in a silicon valley startups</p>
                    <p class="text-xs text-gray-600">By Sanchit Howdi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 sm:px-10 lg:px-[120px] mb-[48px]">
        <div class="mx-auto">
            <h2 class="text-xl font-semibold text-gray-900">Reading Goals</h2>
            <p class="text-sm text-gray-600 mb-6">Read everyday, see your stats soar and finish more books!</p>

            <div class="bg-gray-100 py-5 rounded-[3px] flex flex-col items-center justify-center">
                <div class="relative w-32 h-32">
                    <div class="absolute inset-0 rotate-[calc(var(--rotate,0)*1deg)]">
                        <div class="w-32 h-32 border-8 border-b-transparent border-t-transparent border-l-transparent border-r-amber-700 rounded-full transform rotate-[-90deg] origin-center"
                            style="--rotate: {{ ($Completedbook / $totalBook) * 360 }};"></div>
                    </div>

                    <div
                        class="absolute w-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-sm text-gray-700">
                        <p class="text-sm text-gray-800">{{ $Completedbook }} <span class="text-xs">books completed</span></p>
                        <p class="text-sm text-gray-800">{{ $ScheduleBooks }} <span class="text-xs">behind schedule</span></p>
                    </div>
                </div>

                <button
                    class="mt-4 px-5 py-2 text-sm font-medium text-white bg-amber-700 rounded-md hover:bg-[#7a552e] transition">
                    Set a New Goal
                </button>
            </div>
        </div>
    </section>

    <section class="px-4 sm:px-10 lg:px-[120px] mb-[48px]">
        <h2 class="text-xl font-semibold mb-2">Discover Your Next Favorite Book!</h2>
        <p class="text-sm text-black mb-6">
            Type a prompt about the books you're interested in, and our smart tool will guide you to a matching review.
            Start exploring now!
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 rounded-[4px] bg-[#FFF2DE] gap-4 py-10 px-15">
            <div class="bg-[#875C1A] hover:bg-amber-600 text-white px-5 py-10 rounded-[4px] shadow cursor-pointer">
                <p class="text-lg font-semibold">By Shelf</p>
                <p class="text-xs mt-1">Recommendations based on your bookshelves.</p>
            </div>
            <div class="bg-[#423726] hover:bg-amber-700 text-white px-5 py-10 rounded-[4px] shadow cursor-pointer">
                <p class="text-lg font-semibold">By books</p>
                <p class="text-xs mt-1">Recommendations based on some books you choose.</p>
            </div>
            <div class="bg-[#875C1A] hover:bg-yellow-900 text-white px-5 py-10 rounded-[4px] shadow cursor-pointer">
                <p class="text-lg font-semibold">By Genre</p>
                <p class="text-xs mt-1">Recommendations based on your favorite genres.</p>
            </div>
        </div>
    </section>
@endsection
