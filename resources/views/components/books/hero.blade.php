<section class="bg-white mb-[40px]">
    <div class="w-full max-w-7xl mx-auto p-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold">Foget a mentor (Find a sponsor)</h1>
                <div class="flex items-center text-sm text-gray-600 mt-1">
                    <span class="text-yellow-400">⭐</span>
                    <span class="ml-1">{{ $book->rating ?? '4.1' }} · {{ $book->reviews ?? '6756' }} reviews</span>
                </div>
            </div>
            <div class="flex items-center space-x-4 text-sm text-gray-600 mt-4 md:mt-0">
                <a href="#" class="hover:underline flex items-center space-x-1">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7.5 14.5V9.116q0-.672.472-1.144T9.116 7.5h8.957l-3.075-3.075l.714-.713L20 8l-4.288 4.308l-.714-.708l3.075-3.1H9.115q-.269 0-.442.173t-.173.443V14.5zM5.616 20q-.672 0-1.144-.472T4 18.385V4.615h1v13.77q0 .269.173.442t.443.173h10.769q.269 0 .442-.173t.173-.442V14.5h1v3.885q0 .67-.472 1.143q-.472.472-1.143.472z" />
                        </svg>
                    </span>
                    <span>Share</span>
                </a>
                @if (auth()->check())
                    <a href="#" class="hover:underline flex items-center space-x-1">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4.24 12.25a4.2 4.2 0 0 1-1.24-3A4.25 4.25 0 0 1 7.25 5c1.58 0 2.96.86 3.69 2.14h1.12A4.24 4.24 0 0 1 15.75 5A4.25 4.25 0 0 1 20 9.25c0 1.17-.5 2.25-1.24 3L11.5 19.5zm15.22.71C20.41 12 21 10.7 21 9.25A5.25 5.25 0 0 0 15.75 4c-1.75 0-3.3.85-4.25 2.17A5.22 5.22 0 0 0 7.25 4A5.25 5.25 0 0 0 2 9.25c0 1.45.59 2.75 1.54 3.71l7.96 7.96z" />
                            </svg>
                        </span>
                        <span>Save to your shelf</span>
                    </a>
                @endif
            </div>
        </div>

        <div id="bg-container" class="rounded-[4px] flex justify-center items-center p-10">
            <img id="book-cover" src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                class="max-h-90 shadow-lg transform rotate-6" crossorigin="anonymous">
        </div>

        {{-- berguna sebagai pengambilan warna bg dari warna buku foto(img) --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.2/color-thief.umd.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const img = document.getElementById('book-cover');
                const container = document.getElementById('bg-container');

                function applyColor() {
                    if (img.complete && img.naturalHeight !== 0) {
                        try {
                            const colorThief = new ColorThief();
                            const color = colorThief.getColor(img);
                            container.style.backgroundColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
                        } catch (e) {
                            console.error('Gagal ambil warna:', e);
                        }
                    } else {
                        setTimeout(applyColor, 100);
                    }
                }
                applyColor();
            });
        </script>
    </div>
</section>
