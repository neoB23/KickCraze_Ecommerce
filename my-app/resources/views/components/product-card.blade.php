@vite('resources/css/app.css')
@php
    $images = [
        ['src' => 'Images/s1.webp', 'name' => 'Air Max Elevate', 'price' => '$140.00'],
        ['src' => 'Images/s2.webp', 'name' => 'React Phantom', 'price' => '$160.00'],
        ['src' => 'Images/s3.webp', 'name' => 'Zoom Eclipse', 'price' => '$185.00'],
        ['src' => 'Images/s1.webp', 'name' => 'Air Max Stratus', 'price' => '$135.00'],
        ['src' => 'Images/s2.webp', 'name' => 'React Neo', 'price' => '$155.00'],
        ['src' => 'Images/s3.webp', 'name' => 'Zoom Nova', 'price' => '$175.00'],
    ];
    $imageCount = count($images);
    $visibleItems = 3; 
@endphp

<div x-data="{ 
        currentIndex: 0, 
        imageCount: {{ $imageCount }},
        visibleItems: 3, 
        get maxIndex() { return this.imageCount - this.visibleItems },
        get transformValue() { 
            return `translateX(-${this.currentIndex * (100 / this.visibleItems)}%)` 
        },
        next() {
            if (this.currentIndex < this.maxIndex) {
                this.currentIndex++;
            }
        },
        prev() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        }
    }" 
    class="relative w-full py-20 bg-white">
    
    {{-- Header and Controls --}}
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-end mb-12 border-b border-gray-200 pb-6">
        <div>
            <h3 class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-2">Curated For You</h3>
            <h1 class="font-black text-4xl md:text-5xl text-gray-900 tracking-tighter uppercase">Latest Releases</h1>
        </div>

        {{-- Scroll Buttons --}}
        <div class="flex gap-4">
            <button @click="prev()" 
                    :disabled="currentIndex === 0" 
                    class="p-4 bg-white border border-gray-200 text-black rounded-full hover:bg-gray-900 hover:text-white hover:border-gray-900 disabled:opacity-50 disabled:hover:bg-white disabled:hover:border-gray-200 disabled:hover:text-black disabled:cursor-not-allowed transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="next()" 
                    :disabled="currentIndex === maxIndex" 
                    class="p-4 bg-white border border-gray-200 text-black rounded-full hover:bg-gray-900 hover:text-white hover:border-gray-900 disabled:opacity-50 disabled:hover:bg-white disabled:hover:border-gray-200 disabled:hover:text-black disabled:cursor-not-allowed transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- Slider Container --}}
    <div class="overflow-hidden px-4 sm:px-6 lg:px-8 max-w-[1400px] mx-auto">
        <div id="sliderTrack"
            class="flex transition-transform duration-700 ease-out"
            x-bind:style="{ 'transform': transformValue }">
            
            @foreach ($images as $img)
                <div class="flex-shrink-0 w-full sm:w-[33.333%] px-3"> 
                    <a href="{{ route('products.index') }}" class="group block cursor-pointer">
                        <div class="relative bg-gray-50 rounded-2xl overflow-hidden aspect-[4/5] mb-6">
                            {{-- Optional Badge --}}
                            @if($loop->index < 2)
                                <div class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Just In</div>
                            @endif
                            <img src="/{{ $img['src'] }}"
                                alt="{{ $img['name'] }}"
                                class="w-full h-full object-cover object-center transition duration-700 ease-out group-hover:scale-105"
                            >
                            <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1 group-hover:text-gray-600 transition-colors">{{ $img['name'] }}</h4>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Men's Footwear</p>
                            </div>
                            <p class="text-lg font-bold text-gray-900">{{ $img['price'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>