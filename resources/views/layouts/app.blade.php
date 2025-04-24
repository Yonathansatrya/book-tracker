<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Goodreads')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</head>

<body class="font-Outfit">
    <header class="sticky top-0 z-50 bg-white">
        <nav class="shadow-sm py-3 flex items-center justify-between">
            <div class="px-15">
                <a href="/">
                    <img src="{{ asset('logo.svg') }}" alt="BookTracker" class="h-6">
                </a>
            </div>

            @auth
                <div class="hidden px-8 lg:flex gap-x-6 items-center">
                    <a href="{{ route('dashboard.user') }}" class="text-sm font-semibold text-black">Home</a>
                    <a href="{{ route('my-books') }}" class="text-sm font-semibold text-black">My Books</a>
                    <a href="{{ route('books.index') }}" class="text-sm font-semibold text-black">Browse</a>
                    <a href="#" class="text-sm font-semibold text-black">Community</a>
                </div>
            @endauth

            <form method="GET" action="{{ route('search') }}" class="hidden sm:flex items-center flex-1 max-w-2xl">
                <div class="relative flex-1">
                    <input type="text" name="q" placeholder="Need help finding your book ?"
                        class="w-full pl-10 pr-10 py-2 rounded-md bg-gray-100 text-sm text-gray-700 focus:outline-none" />
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                        viewBox="0 0 16 16" fill="currentColor">
                        <path
                            d="M6 9.5A2 2 0 0 1 7.937 11H13.5a.5.5 0 0 1 .09.992L13.5 12l-5.563.001a2 2 0 0 1-3.874 0L2.5 12a.5.5 0 0 1-.09-.992L2.5 11h1.563A2 2 0 0 1 6 9.5m0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2m4-8A2 2 0 0 1 11.937 4H13.5a.5.5 0 0 1 .09.992L13.5 5l-1.563.001a2 2 0 0 1-3.874 0L2.5 5a.5.5 0 0 1-.09-.992L2.5 4h5.563A2 2 0 0 1 10 2.5m0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                    </svg>
                </div>
            </form>

            {{-- <div class="hidden md:flex items-center max-w-md flex-1 mx-4">
                <div class="relative w-full">
                    <input type="text" placeholder="Need help finding your book?"
                        class="w-full pl-10 pr-10 py-2 rounded-md bg-gray-100 text-sm text-gray-700 focus:outline-none" />
                    <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16" />
                    </svg>
                </div>
            </div> --}}

            <div class="flex px-15 items-center gap-3">
                @auth
                    <button type="button"
                        class="relative rounded-full p-1 text-black hover:text-[] focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M218.35 178c-5.77-10-14.35-37.87-14.35-74a76 76 0 1 0-152 0c0 36.13-8.59 64-14.36 73.95A12 12 0 0 0 48 196h44.23a36 36 0 0 0 71.54 0H208a12 12 0 0 0 10.35-18M128 220a28 28 0 0 1-27.71-24h55.42A28 28 0 0 1 128 220m83.45-34a3.91 3.91 0 0 1-3.44 2H48a3.91 3.91 0 0 1-3.44-2a4 4 0 0 1 0-4C52 169.17 60 139.32 60 104a68 68 0 1 1 136 0c0 35.31 8 65.17 15.44 78a4 4 0 0 1 .01 4" />
                        </svg>
                    </button>
                    <div class="relative">
                        <button id="user-menu-toggle" class="focus:outline-none">
                            <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/300" alt="Avatar">
                        </button>
                        <div id="user-menu"
                            class="hidden absolute right-0 z-50 mt-2 w-48 bg-white shadow-md rounded-md py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your
                                Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                                    Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:hidden md:flex gap-2">
                        <a href="{{ route('login') }}"
                            class="bg-amber-800 text-white px-4 py-2 rounded hover:bg-[#875C1A] text-sm">Sign In</a>
                        <a href="{{ route('register') }}"
                            class="bg-amber-800 text-white px-4 py-2 rounded hover:bg-[#875C1A] text-sm">Sign Up</a>
                    </div>
                @endauth

                <button id="mobile-menu-btn" class="md:hidden ml-2 focus:outline-none">
                    <svg class="w-6 h-6 text-amber-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>

        <div id="mobile-menu" class="hidden lg:hidden px-6 mt-2 space-y-2 pb-4">
            @auth
                <a href="{{ route('dashboard.user') }}" class="block text-sm font-semibold text-black">Home</a>
                <a href="{{ route('genres.index') }}" class="block text-sm font-semibold text-black">My Books</a>
                <a href="{{ route('books.index') }}" class="block text-sm font-semibold text-black">Browse</a>
                <a href="{{ route('books.index') }}" class="block text-sm font-semibold text-black">Community</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm font-semibold text-black">Sign Out</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block bg-amber-800 text-white py-2 px-4 rounded text-sm text-center hover:bg-amber-700">Sign
                    In</a>
                <a href="{{ route('register') }}"
                    class="block bg-amber-800 text-white py-2 px-4 rounded text-sm text-center hover:bg-amber-700">Sign
                    Up</a>

                <div class="relative items-center flex-1">
                    <input type="text" placeholder="Need help finding your book ?"
                        class="w-full pl-10 pr-10 py-2 rounded-md bg-gray-100 text-sm text-gray-700 focus:outline-none" />
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                        viewBox="0 0 16 16" fill="currentColor">
                        <path
                            d="M6 9.5A2 2 0 0 1 7.937 11H13.5a.5.5 0 0 1 .09.992L13.5 12l-5.563.001a2 2 0 0 1-3.874 0L2.5 12a.5.5 0 0 1-.09-.992L2.5 11h1.563A2 2 0 0 1 6 9.5m0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2m4-8A2 2 0 0 1 11.937 4H13.5a.5.5 0 0 1 .09.992L13.5 5l-1.563.001a2 2 0 0 1-3.874 0L2.5 5a.5.5 0 0 1-.09-.992L2.5 4h5.563A2 2 0 0 1 10 2.5m0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                    </svg>
                </div>
            @endauth
        </div>
    </header>

    <div class="mx-auto bg-white">
        @yield('content')
    </div>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        const userMenuToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-menu');

        if (userMenuToggle) {
            userMenuToggle.addEventListener('click', function() {
                userMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!userMenu.contains(e.target) && !userMenuToggle.contains(e.target)) {
                    userMenu.classList.add('hidden');
                }
            });
        }
    </script>
    <style>
        body {
            font-family: var(--font-Outfit);
        }
    </style>
</body>

</html>
