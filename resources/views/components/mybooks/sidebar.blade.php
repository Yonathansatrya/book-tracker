<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm bg-gray-100 text-gray-500 rounded-[4px] sm:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24">
        <path fill="#000"
            d="M4.403 3.903L2.99 5.318L6.171 8.5L2.99 11.682l1.414 1.414L9 8.5zM21 20v-2H3v2zm0-7v-2h-9v2zm0-7V4h-9v2z" />
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white dark:bg-gray-800"
    aria-label="Sidebar">
    <div class="flex flex-col h-full overflow-hidden">
        <div
            class="py-20 px-3 h-full overflow-y-auto scrollbar-thin scrollbar-thumb-amber-600 scrollbar-track-gray-100 dark:scrollbar-thumb-amber-700 dark:scrollbar-track-gray-800">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">My Library</h2>

            <ul class="space-y-6 text-sm text-gray-700 dark:text-gray-200">
                <li>
                    <div
                        class="w-full text-white flex items-center px-4 py-2 text-sm font-semibold bg-amber-700 rounded-[4px]">
                        General
                    </div>
                    <ul class="mt-2 ml-2 space-y-2">
                        <li><a href="{{ route('my-books') }}" class="block px-2 py-1 hover:underline">All</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'want_to_read']) }}"
                                class="block px-2 py-1 hover:underline">Want to read</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'reading']) }}"
                                class="block px-2 py-1 hover:underline">Currently reading</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'finished']) }}"
                                class="block px-2 py-1 hover:underline">Finished</a></li>
                    </ul>

                    <div class="flex items-center mt-3 space-x-2">
                        <input type="text" placeholder="Your Bookshelf Name"
                            class="w-full px-2 py-1 text-sm bg-gray-100 rounded focus:outline-none focus:ring-2 focus:ring-amber-500" />
                        <a href="{{ route('user-books.create') }}"
                            class="px-3 py-1 bg-amber-700 text-white text-sm rounded hover:bg-amber-800">Add</a>
                    </div>
                </li>

                <li>
                    <div
                        class="w-full text-white flex items-center px-4 py-2 text-sm font-semibold bg-amber-700 rounded-[4px]">
                        Your Reading Activity
                    </div>
                    <ul class="mt-2 ml-2 space-y-2">
                        <li><a href="{{ route('my-books', ['status' => 'review_draft']) }}"
                                class="block px-2 py-1 hover:underline">Review Drafts</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'highlight']) }}"
                                class="block px-2 py-1 hover:underline">Kindle Notes & Highlights</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'challenge']) }}"
                                class="block px-2 py-1 hover:underline">Reading Challenge</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'published_at']) }}"
                                class="block px-2 py-1 hover:underline">Year in Books</a></li>
                        <li><a href="{{ route('my-books', ['status' => 'stats']) }}"
                                class="block px-2 py-1 hover:underline">Reading Stats</a></li>
                    </ul>
                </li>

                <li>
                    <div
                        class="w-full text-white flex items-center px-4 py-2 text-sm font-semibold bg-amber-700 rounded-[4px]">
                        Add Books
                    </div>
                    <ul class="mt-2 ml-2 space-y-2">
                        <li><a href="{{ route('search') }}" class="block px-2 py-1 hover:underline">Explore more
                                books</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Shelf</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Genre</a></li>
                        <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Books</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>
