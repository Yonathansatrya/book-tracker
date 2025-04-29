<h2 class="font-bold px-4 py-5 text-2xl text-black">Book</h2>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
    @foreach ($books as $book)
        <a href="{{ route('books.show', $book->id) }}" class="max-w-[180px] bg-white rounded-[4px] shadow p-3 relative">
            <div class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
                <svg class="w-5 h-5 text-amber-700 hover:text-amber-600" fill="none" stroke="currentColor"
                    stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.48 3.499a5.374 5.374 0 0 1 7.607 7.603L12 18.187l-7.09-7.085a5.374 5.374 0 1 1 7.606-7.603z" />
                </svg>
            </div>
            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('no-image.png') }}"
                alt="Book cover" class="w-full h-40 object-cover rounded-lg mb-3">

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
                        <svg class="w-5 h-5 fill-current {{ $i > $book->average_rating ? 'text-gray-300' : '' }}"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09L5.5 12 1 7.91l6.06-.91L10 2l2.94 5 6.06.91L14.5 12l1.378 6.09z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-xs text-gray-600 mb-1">{{ $book->average_rating }}</p>
                <p class="text-xs text-gray-800 font-semibold"><span class="font-bold">{{ $book->ratings_count }}</span>
                    Read the
                    book</p>
            </div>
        </a>
    @endforeach
</div>

<div class="mt-6 justify-center">
    {{ $books->links() }}
</div>
