<section class="bg-white mb-10">
    <div class="w-full max-w-7xl mx-auto p-6 border-b border-gray-300">
        <h2 class="font-bold text-2xl mb-6">Description</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <p class="text-gray-700 leading-relaxed mb-8">
                    {{ $book->description ?? 'No description available.' }}
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a,
                    mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut
                    interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. Class
                    aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent
                    auctor purus luctus enim egestas, ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac
                    rhoncus nisl, eu tempor urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet
                    lacinia. Aliquam in elementum tellus.
                </p>

                <div class="flex flex-wrap gap-8 text-sm text-gray-600">
                    <div class="flex flex-col">
                        <span class="text-gray-400 mb-1">Written By</span>
                        <span class="font-semibold">{{ $book->authors->pluck('name')->join(', ') ?? '-' }}</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-400 mb-1">Publisher</span>
                        <span class="font-semibold">nama Orang yang Publish</span>
                        {{-- <span class="font-semibold">{{ $book->publisher_at ?? '-' }}</span> --}}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-400 mb-1">Year</span>
                        <span class="font-semibold">{{ $book->published_at ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-center mb-6 text-gray-600 text-sm">
                    <span class="text-yellow-400">⭐</span>
                    <span class="ml-2">{{ $book->average_rating ?? '4.1' }} · {{ $book->reviews ?? '6756' }}
                        reviews</span>
                </div>

                <button
                    class="w-full flex items-center justify-center gap-2 bg-[#875C1A] hover:bg-[#704b15] text-white font-semibold py-3 rounded-md mb-4 transition-all">
                    Want to read
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="m10 17l5-5l-5-5" stroke-width="1" />
                    </svg>
                </button>

                <button
                    class="w-full flex items-center justify-center gap-2 border border-[#875C1A] text-[#875C1A] font-semibold py-3 rounded-md hover:bg-amber-50 transition-all">
                    Buy now
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            d="m10 17l5-5l-5-5" stroke-width="1" />
                    </svg>
                </button>

                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-2">
                            <img src="{{ asset('avatars/avatar1.png') }}" alt="User 1"
                                class="w-7 h-7 rounded-full border-2 border-white">
                            <img src="{{ asset('avatars/avatar2.png') }}" alt="User 2"
                                class="w-7 h-7 rounded-full border-2 border-white">
                            <img src="{{ asset('avatars/avatar3.png') }}" alt="User 3"
                                class="w-7 h-7 rounded-full border-2 border-white">
                        </div>
                        <span class="text-gray-600 text-sm">657 people are currently reading</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-2">
                            <img src="{{ asset('avatars/avatar4.png') }}" alt="User 4"
                                class="w-7 h-7 rounded-full border-2 border-white">
                            <img src="{{ asset('avatars/avatar5.png') }}" alt="User 5"
                                class="w-7 h-7 rounded-full border-2 border-white">
                        </div>
                        <span class="text-gray-600 text-sm">+52k people want to read it</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
