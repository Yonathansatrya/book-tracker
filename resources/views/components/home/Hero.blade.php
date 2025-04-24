<section class="bg-white py-4">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-10">
        <div class="py-10">
            <h1 class="text-4xl md:text-5xl font-semibold font-Pattaya leading-tight tracking-widest mb-6">
                What Book Are <br />
                You Looking For ?
            </h1>
            <p class="text-black">Not Sure What To Read Next?</p>
            <p class="text-black mb-[32px]">Our solution will cost you 5 minutes to find your next best.</p>
            <div>
                <a href="{{ route('home') }}" class="inline-flex mt-2 border border-[#875C1A] overflow-hidden group">
                    <span class="bg-white text-black font-semibold px-5 py-2">
                        Explore Now
                    </span>

                    <span class="bg-[#875C1A] px-4 py-2 flex items-center justify-center group-hover:bg-[#A76C25] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5" d="M4 12h16m0 0l-6-6m6 6l-6 6" />
                        </svg>
                    </span>
                </a>

            </div>
        </div>

        <div class="py-10">
            <div class="absolute rotate-[7deg] w-40 h-50 bg-[#2F8A89] shadow-md">
                <img src="{{ asset('dashboard/book_1.svg') }}"
                    class="absolute w-40 rotate-[10deg] shadow-xl -top-6 -right-8" alt="">
            </div>
            <div class="absolute-rotate-[15deg] w-40 h-50 bg-[#FAD428] shadow-md">
                <img src="{{ asset('dashboard/book_2.svg') }}"
                    class="absolute w-40 rotate-[-6deg] shadow-xl top-4 right-20" alt="">
            </div>

            <div class="absolute bg-white p-4 rounded-[4px] shadow-lg w-56">
                <h4 class="font-semibold mb-2">Our Community</h4>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-6 h-6 bg-gray-200 rounded-full"></div>
                    <div class="w-6 h-6 bg-gray-200 rounded-full"></div>
                    <div class="w-6 h-6 bg-gray-200 rounded-full"></div>
                </div>
                <p class="text-xs text-gray-500">+40k Book Lovers Joined</p>
            </div>
        </div>
    </div>

    <div class="max-w-full mx-auto">
        <div class="flex">
            <div class="h-4 w-[40%] py-4 bg-[#FEBE27]/40"></div>
            <div class="h-4 w-[60%] py-4 bg-yellow-400"></div>
        </div>

        <div class="flex">
            <div class="h-4 w-[30%] py-4 bg-[#FE682F]/30"></div>
            <div class="h-4 w-[70%] py-4 bg-[#FE682F]"></div>
        </div>

        <div class="flex">
            <div class="h-4 w-[20%] py-4 bg-[#F52D3A]/30"></div>
            <div class="h-4 w-[80%] py-4 bg-[#F52D3A]"></div>
        </div>
        <div class="flex">
            <div class="h-4 w-[10%] py-4 bg-[#D12468]/30"></div>
            <div class="h-4 w-[90%] py-4 bg-[#D12468]"></div>
        </div>
        <div class="h-4 bg-[#6F1164] py-4 w-full"></div>
    </div>
</section>
