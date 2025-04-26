<section class="bg-white mb-[40px]">
    <div class="w-full max-w-7xl mx-auto p-6 border-b border-gray-300">
        <h2 class="font-bold text-2xl mb-4">About the author</h2>

        @foreach ($book->authors as $author)
            <div class="mb-8" x-data="{ expanded: false }">
                <p class="text-gray-700 leading-relaxed" :class="{ 'line-clamp-3': !expanded }">
                    {{ $author->bio }}
                </p>

                <button
                    @click="expanded = !expanded"
                    class="text-sm text-amber-700 mt-2 hover:underline focus:outline-none"
                >
                    <span x-text="expanded ? 'Show less' : 'Show more'"></span>
                </button>
            </div>
        @endforeach
    </div>
</section>
