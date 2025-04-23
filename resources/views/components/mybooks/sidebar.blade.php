<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar"
    class="fixed py-4 w-64 h-screen overflow-y-auto transition-transform -translate-x-full sm:translate-x-0 bg-white dark:bg-gray-800 scrollbar-thin scrollbar-thumb-amber-600 scrollbar-track-gray-100 dark:scrollbar-thumb-amber-700 dark:scrollbar-track-gray-800"
    aria-label="Sidebar">
    <div class="h-full px-3">
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
                    <button class="px-3 py-1 bg-amber-700 text-white text-sm rounded hover:bg-amber-800">Add</button>
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
                    <li><a href="{{ route('my-books', ['status' => 'published_year']) }}"
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
                    <li><a href="#" class="block px-2 py-1 hover:underline">Explore more books</a></li>
                    <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Shelf</a></li>
                    <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Genre</a></li>
                    <li><a href="#" class="block px-2 py-1 hover:underline">Recommandations by Books</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
