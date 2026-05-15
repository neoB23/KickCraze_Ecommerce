@vite('resources/css/app.css')
@php
    $images = [
        ['src' => 'Images/s1.webp', 'name' => 'Air Max Elevate', 'price' => '₱7,800.00', 'cat' => "Men's Footwear"],
        ['src' => 'Images/s2.webp', 'name' => 'React Phantom',   'price' => '₱8,900.00', 'cat' => "Men's Footwear"],
        ['src' => 'Images/s3.webp', 'name' => 'Zoom Eclipse',    'price' => '₱10,300.00','cat' => "Men's Footwear"],
        ['src' => 'Images/s1.webp', 'name' => 'Air Max Stratus', 'price' => '₱7,500.00', 'cat' => "Men's Footwear"],
        ['src' => 'Images/s2.webp', 'name' => 'React Neo',       'price' => '₱8,600.00', 'cat' => "Women's Footwear"],
        ['src' => 'Images/s3.webp', 'name' => 'Zoom Nova',       'price' => '₱9,750.00', 'cat' => "Women's Footwear"],
    ];
    $imageCount = count($images);
@endphp

<section x-data="{
        currentIndex: 0,
        imageCount: {{ $imageCount }},
        visibleItems: 3,
        get maxIndex() { return Math.max(0, this.imageCount - this.visibleItems) },
        get transformValue() { return `translateX(-${this.currentIndex * (100 / this.visibleItems)}%)` },
        next() { if (this.currentIndex < this.maxIndex) this.currentIndex++ },
        prev() { if (this.currentIndex > 0) this.currentIndex-- }
    }"
    class="relative w-full py-24 bg-white">

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12 pb-6 border-b border-zinc-200">
            <div>
                <span class="inline-block text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 mb-3">— Curated For You</span>
                <h2 class="text-5xl md:text-6xl font-black text-zinc-950 tracking-tighter uppercase leading-[0.9]">Latest</h2>
                <h2 class="text-5xl md:text-6xl font-black text-zinc-400 tracking-tighter uppercase leading-[0.9]">Releases</h2>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.25em] text-zinc-900 hover:text-zinc-600 transition group">
                    Shop All
                    <span class="w-8 h-px bg-zinc-300 group-hover:bg-zinc-900 group-hover:w-12 transition-all"></span>
                </a>
                <div class="flex gap-2">
                    <button @click="prev()"
                            :disabled="currentIndex === 0"
                            class="w-12 h-12 bg-white border-2 border-zinc-200 text-zinc-950 rounded-full flex items-center justify-center hover:bg-zinc-950 hover:text-white hover:border-zinc-950 disabled:opacity-30 disabled:hover:bg-white disabled:hover:border-zinc-200 disabled:hover:text-zinc-950 disabled:cursor-not-allowed transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()"
                            :disabled="currentIndex === maxIndex"
                            class="w-12 h-12 bg-zinc-950 border-2 border-zinc-950 text-white rounded-full flex items-center justify-center hover:bg-white hover:text-zinc-950 disabled:opacity-30 disabled:hover:bg-zinc-950 disabled:hover:text-white disabled:cursor-not-allowed transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Track --}}
        <div class="overflow-hidden">
            <div class="flex transition-transform duration-700 ease-out" x-bind:style="{ 'transform': transformValue }">
                @foreach ($images as $img)
                    <div class="flex-shrink-0 w-full sm:w-[33.333%] px-3">
                        <a href="{{ route('products.index') }}" class="group block cursor-pointer">
                            <div class="relative bg-zinc-100 rounded-3xl overflow-hidden aspect-[4/5] mb-5 ring-1 ring-zinc-200 group-hover:ring-zinc-900 transition-all duration-500">
                                @if($loop->index < 2)
                                    <div class="absolute top-4 left-4 z-10 inline-flex items-center gap-1.5 px-3 py-1.5 bg-zinc-950 text-white text-[9px] font-black tracking-[0.25em] rounded-full uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                        Just In
                                    </div>
                                @endif
                                <span class="absolute top-4 right-4 z-10 inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/90 backdrop-blur text-zinc-700 hover:text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
                                </span>
                                <img src="/{{ $img['src'] }}"
                                    alt="{{ $img['name'] }}"
                                    class="w-full h-full object-cover object-center transition duration-700 ease-out group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="flex items-start justify-between gap-4">
                                <div class="min-w-0">
                                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-zinc-500 mb-1">{{ $img['cat'] }}</p>
                                    <h4 class="text-base md:text-lg font-black text-zinc-950 uppercase tracking-tight group-hover:text-zinc-600 transition-colors truncate">{{ $img['name'] }}</h4>
                                </div>
                                <p class="text-base font-black text-zinc-950 whitespace-nowrap">{{ $img['price'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
