@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze')
@section('content')

<div class="w-full bg-zinc-950">

    {{-- Hero --}}
    @include('components.image-slide')

    {{-- Curated Highlights + KickCraze Standard (dark) --}}
    @include('components.Upper-sub-nav')

    {{-- ELEVATE ESSENTIALS — category bento on light --}}
    <section id="category-grid" class="bg-white py-24">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-14 pb-6 border-b border-zinc-200">
                <div>
                    <span class="inline-block text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-3">— Shop by Category</span>
                    <h2 class="text-5xl md:text-6xl font-black text-zinc-950 tracking-tighter uppercase leading-[0.9]">Elevate</h2>
                    <h2 class="text-5xl md:text-6xl font-black text-zinc-400 tracking-tighter uppercase leading-[0.9]">Essentials</h2>
                </div>
                <a href="{{ route('sale') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.25em] text-zinc-900 hover:text-zinc-600 transition group">
                    View All Categories
                    <span class="w-8 h-px bg-zinc-300 group-hover:bg-zinc-900 group-hover:w-12 transition-all"></span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $categories = [
                        ['route' => 'mens',   'img' => '/Images/mens.webp',   'label' => "Men's",       'sub' => '01 / Footwear',  'offset' => false],
                        ['route' => 'womens', 'img' => '/Images/womens.webp', 'label' => "Women's",     'sub' => '02 / Footwear',  'offset' => true],
                        ['route' => 'kids',   'img' => '/Images/kids.webp',   'label' => "Kids'",       'sub' => '03 / Footwear',  'offset' => false],
                        ['route' => 'sale',   'img' => '/Images/nr.webp',     'label' => "New<br>Releases", 'sub' => '04 / Drops', 'offset' => true],
                    ];
                @endphp
                @foreach($categories as $cat)
                    <a href="{{ route($cat['route']) }}"
                       class="group block overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 bg-zinc-900 relative aspect-[4/5] {{ $cat['offset'] ? 'lg:translate-y-10' : '' }} ring-1 ring-zinc-200 hover:ring-zinc-900">
                        <img src="{{ $cat['img'] }}" alt="{{ strip_tags($cat['label']) }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.2s] ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                        <div class="absolute top-5 left-5">
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-white/80">{{ $cat['sub'] }}</span>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 flex items-end justify-between">
                            <p class="font-black text-2xl md:text-3xl text-white uppercase tracking-tighter leading-[0.9]">{!! $cat['label'] !!}</p>
                            <span class="w-10 h-10 rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center text-white transform translate-x-3 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BRAND VISION — Video story --}}
    <section class="relative bg-zinc-950 py-24 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white/[0.03] rounded-full blur-[160px]"></div>
        </div>
        <div class="relative max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative z-10">
                    <span class="inline-block text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-4">— Behind the Design</span>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white mb-8 leading-[0.95] uppercase tracking-tighter">
                        Crafted for the <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-zinc-500">Relentless</span>
                    </h1>
                    <p class="font-medium text-base md:text-lg text-zinc-400 mb-10 leading-relaxed max-w-lg">
                        Every silhouette is sourced, authenticated, and built to outlast the streets it was made for. Engineered for the days that don't slow down.
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-7 py-4 bg-white text-zinc-950 text-xs font-black uppercase tracking-[0.25em] rounded-full hover:bg-zinc-200 transition-all duration-300 shadow-[0_0_40px_rgba(255,255,255,0.1)] group">
                        Explore Our Story
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>

                <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-black/50 aspect-[16/9] group ring-1 ring-zinc-800">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-transparent transition duration-500 z-10 pointer-events-none"></div>
                    <iframe
                        class="absolute inset-0 w-full h-full scale-105"
                        src="https://www.youtube.com/embed/LBukoM3CLic?mute=1&autoplay=1&loop=1&controls=0&showinfo=0&modestbranding=1"
                        title="Brand Video"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest Releases carousel --}}
    @include('components.product-card')

</div>

@endsection
