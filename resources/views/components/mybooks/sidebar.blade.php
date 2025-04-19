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

{{-- <aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-gray-50 dark:bg-gray-800"
    aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">My Library</h2>
        <ul class="space-y-4 text-sm text-gray-700 dark:text-gray-200">

            <!-- General -->
            <li>
                <button type="button" class="flex items-center w-full text-left font-medium hover:text-amber-600"
                    data-collapse-toggle="general-menu">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Z">
                        </path>
                    </svg>
                    General
                </button>
                <ul id="general-menu" class="ml-6 mt-2 space-y-1">
                    <li><a href="#" class="hover:underline">Want to read</a></li>
                    <li><a href="#" class="hover:underline">Currently reading</a></li>
                    <li><a href="#" class="hover:underline">Finished</a></li>
                </ul>
            </li>

            <!-- Projects -->
            <li>
                <button type="button" class="flex items-center w-full text-left font-medium hover:text-amber-600"
                    data-collapse-toggle="projects-menu">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" stroke-width="1.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z">
                        </path>
                    </svg>
                    Projects
                </button>
                <ul id="projects-menu" class="ml-6 mt-2 space-y-1">
                    <li><a href="#" class="hover:underline">Review Drafts</a></li>
                    <li><a href="#" class="hover:underline">Kindle Notes & Highlights</a></li>
                    <li><a href="#" class="hover:underline">Reading Challenge</a></li>
                    <li><a href="#" class="hover:underline">Year in Books</a></li>
                    <li><a href="#" class="hover:underline">Reading Stats</a></li>
                </ul>
            </li>

            <!-- Add Books -->
            <li>
                <button type="button" class="flex items-center w-full text-left font-medium hover:text-amber-600"
                    data-collapse-toggle="addbooks-menu">
                    <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Books
                </button>
                <ul id="addbooks-menu" class="ml-6 mt-2 space-y-1">
                    <li><a href="#" class="hover:underline">Explore more books</a></li>
                    <li><a href="#" class="hover:underline">Recommendations by Shelf</a></li>
                    <li><a href="#" class="hover:underline">Recommendations by Genre</a></li>
                    <li><a href="#" class="hover:underline">Recommendations by Books</a></li>
                </ul>
            </li>

        </ul>
    </div>
</aside> --}}

<aside id="default-sidebar"
    class="fixed py-4 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white dark:bg-gray-800"
    aria-label="Sidebar">
    <div class="h-full px-5">
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">My Library</h2>
        <ul class="space-y-6 text-sm text-gray-700 dark:text-gray-200">
            <li>
                <button type="button"
                    class="flex w-full text-white items-center px-4 py-2 text-sm font-semibold bg-amber-600 hover:text-amber-800 rounded-[4px]"
                    data-collapse-toggle="general-menu1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m102.594 25.97l90.062 345.78L481.844 395L391.75 49.22zm-18.906 1.593c-30.466 11.873-55.68 53.098-49.75 75.312l3.25 11.78c.667-1.76 1.36-3.522 2.093-5.28C49.19 85.668 65.84 62.61 89.657 50.47l-5.97-22.907zm44.937 18.906l247.813 21.593l80.937 305.156l-249.344-20.064L128.626 46.47zM94.53 69.155c-16.66 10.01-29.916 28.068-38 47.406c-5.245 12.552-8.037 25.64-8.75 36.532l64.814 235.28c.293-.55.572-1.105.875-1.655c10.6-19.254 27.822-37.696 51.124-48.47L94.53 69.156zm74.876 287.563c-17.673 9.067-31.144 23.712-39.562 39c-4.464 8.105-7.262 16.36-8.688 23.75l11.688 42.405l1.625.125c-3.825-27.528 11.382-60.446 41.25-81.03l-6.314-24.25zm26.344 34.03c-32.552 17.26-46.49 52.402-41.844 72.906l289.844 24.53c-5.315-7.75-8.637-17.84-8.594-28.342l-22.562-9.063l46.625-7.31l-13.595-12.97c5.605-6.907 13.688-13.025 24.78-17.656L195.75 390.75z" />
                    </svg>
                    General
                </button>

                <ul id="general-menu1" class="ml-6 mt-4 space-y-4 hidden">
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Want to read</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Currently reading</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Finished</a></li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="flex w-full text-white items-center px-4 py-2 text-sm font-semibold bg-amber-600 hover:text-amber-800 rounded-[4px]"
                    data-collapse-toggle="general-menu2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m102.594 25.97l90.062 345.78L481.844 395L391.75 49.22zm-18.906 1.593c-30.466 11.873-55.68 53.098-49.75 75.312l3.25 11.78c.667-1.76 1.36-3.522 2.093-5.28C49.19 85.668 65.84 62.61 89.657 50.47l-5.97-22.907zm44.937 18.906l247.813 21.593l80.937 305.156l-249.344-20.064L128.626 46.47zM94.53 69.155c-16.66 10.01-29.916 28.068-38 47.406c-5.245 12.552-8.037 25.64-8.75 36.532l64.814 235.28c.293-.55.572-1.105.875-1.655c10.6-19.254 27.822-37.696 51.124-48.47L94.53 69.156zm74.876 287.563c-17.673 9.067-31.144 23.712-39.562 39c-4.464 8.105-7.262 16.36-8.688 23.75l11.688 42.405l1.625.125c-3.825-27.528 11.382-60.446 41.25-81.03l-6.314-24.25zm26.344 34.03c-32.552 17.26-46.49 52.402-41.844 72.906l289.844 24.53c-5.315-7.75-8.637-17.84-8.594-28.342l-22.562-9.063l46.625-7.31l-13.595-12.97c5.605-6.907 13.688-13.025 24.78-17.656L195.75 390.75z" />
                    </svg>
                    Your Reading Activity
                </button>

                <ul id="general-menu2" class="ml-6 mt-4 space-y-4 hidden">
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Review Drafts</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Kindle Notes & Highlights</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Reading Challenge</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Year in Books</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Reading Stats</a></li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="flex w-full text-white items-center px-4 py-2 text-sm font-semibold bg-amber-600 hover:text-amber-800 rounded-[4px]"
                    data-collapse-toggle="general-menu3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-2" fill="none" stroke="currentColor"
                        stroke-width="1.5" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m102.594 25.97l90.062 345.78L481.844 395L391.75 49.22zm-18.906 1.593c-30.466 11.873-55.68 53.098-49.75 75.312l3.25 11.78c.667-1.76 1.36-3.522 2.093-5.28C49.19 85.668 65.84 62.61 89.657 50.47l-5.97-22.907zm44.937 18.906l247.813 21.593l80.937 305.156l-249.344-20.064L128.626 46.47zM94.53 69.155c-16.66 10.01-29.916 28.068-38 47.406c-5.245 12.552-8.037 25.64-8.75 36.532l64.814 235.28c.293-.55.572-1.105.875-1.655c10.6-19.254 27.822-37.696 51.124-48.47L94.53 69.156zm74.876 287.563c-17.673 9.067-31.144 23.712-39.562 39c-4.464 8.105-7.262 16.36-8.688 23.75l11.688 42.405l1.625.125c-3.825-27.528 11.382-60.446 41.25-81.03l-6.314-24.25zm26.344 34.03c-32.552 17.26-46.49 52.402-41.844 72.906l289.844 24.53c-5.315-7.75-8.637-17.84-8.594-28.342l-22.562-9.063l46.625-7.31l-13.595-12.97c5.605-6.907 13.688-13.025 24.78-17.656L195.75 390.75z" />
                    </svg>
                    Add Books
                </button>

                <ul id="general-menu3" class="ml-6 mt-4 space-y-4 hidden">
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Explore more books</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Recommendations by Shelf</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Recommendations by Genre</a></li>
                    <li><a href="#" class="block text-sm text-gray-700 hover:underline">Recommendations by Book</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<script>
    document.querySelectorAll('button[data-collapse-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const menuId = button.getAttribute('data-collapse-toggle');
            const menu = document.getElementById(menuId);
            const arrow = button.querySelector('[data-icon-arrow]');

            menu.classList.toggle('hidden');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    });
    document.querySelectorAll('button[data-collapse-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const menuId = button.getAttribute('data-collapse-toggle');
            const menu = document.getElementById(menuId);
            const arrow = button.querySelector('[data-icon-arrow]');

            menu.classList.toggle('hidden');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    });
    document.querySelectorAll('button[data-collapse-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const menuId = button.getAttribute('data-collapse-toggle');
            const menu = document.getElementById(menuId);
            const arrow = button.querySelector('[data-icon-arrow]');

            menu.classList.toggle('hidden');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    });
</script>
