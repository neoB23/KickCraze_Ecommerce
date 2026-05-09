@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze')
@section('content')

{{-- Top Message Slider --}}


  @include('components.Upper-sub-nav')

<div class="w-full">
    {{-- High-end Hero Slider (includes overlay text) --}}
    @include('components.image-slide')

        {{-- Product Images --}}
      <section id="category-grid" class="py-20 max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 tracking-tighter uppercase">Elevate</h2>
                <h2 class="text-5xl md:text-6xl font-black text-gray-400 tracking-tighter uppercase leading-none">Essentials</h2>
            </div>
            <a href="{{ route('sale') }}" class="mt-4 md:mt-0 text-lg font-bold border-b-2 border-black pb-1 hover:text-gray-600 hover:border-gray-600 transition">View All Categories</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Category 1: Men's --}}
            <a href="{{ route('mens') }}" class="group block overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 bg-gray-50 relative aspect-[4/5]"> 
                <img src="/Images/mens.webp" alt="Men's Shoes" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                    <p class="font-bold text-3xl text-white uppercase tracking-wider">Men's</p>
                    <span class="bg-white/20 backdrop-blur-md rounded-full p-2 text-white transform translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </a>
            
            {{-- Category 2: Women's --}}
            <a href="{{ route('womens') }}" class="group block overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 bg-gray-50 relative aspect-[4/5] lg:translate-y-8">
                <img src="/Images/womens.webp" alt="Women's Shoes" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                    <p class="font-bold text-3xl text-white uppercase tracking-wider">Women's</p>
                    <span class="bg-white/20 backdrop-blur-md rounded-full p-2 text-white transform translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </a>
            
            {{-- Category 3: Kids' --}}
            <a href="{{ route('kids') }}" class="group block overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 bg-gray-50 relative aspect-[4/5]">
                <img src="/Images/kids.webp" alt="Kids' Shoes" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                    <p class="font-bold text-3xl text-white uppercase tracking-wider">Kids'</p>
                    <span class="bg-white/20 backdrop-blur-md rounded-full p-2 text-white transform translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </a>
            
            {{-- Category 4: New Releases --}}
            <a href="{{ route('sale') }}" class="group block overflow-hidden rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 bg-gray-50 relative aspect-[4/5] lg:translate-y-8">
                <img src="/Images/nr.webp" alt="New Release Footwear" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700 ease-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>
                <div class="absolute bottom-6 left-6 right-6 flex items-center justify-between">
                    <p class="font-bold text-3xl text-white uppercase tracking-wider leading-tight">New<br>Releases</p>
                    <span class="bg-white/20 backdrop-blur-md rounded-full p-2 text-white transform translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </div>
            </a>
        </div>
    </section>

    {{-- Brand Vision / Video Section --}}
    <section class="py-24 bg-zinc-50 overflow-hidden relative">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                {{-- Text Content --}}
                <div class="relative z-10 px-4 md:px-8">
                    <h3 class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-4">Behind the Design</h3>
                    <h1 class="text-5xl md:text-6xl font-black text-gray-900 mb-8 leading-[1.1] uppercase tracking-tighter">
                        Crafted for the <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-500">Relentless</span>
                    </h1>
                    <p class="font-medium text-lg md:text-xl text-gray-600 mb-10 leading-relaxed">
                        Designed with soft, heavyweight loopback cotton, the Wordmark Paris Hoodie provides sophistication and warmth for any occasion.
                        The precision stitching and robust materials node to the City of Light and its alluring day-to-night transformation.
                    </p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-lg font-bold text-black border-b-2 border-black pb-1 hover:text-gray-600 hover:border-gray-600 transition group">
                        Explore Our Story 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                
                {{-- Video Player Container --}}
                <div class="relative rounded-3xl overflow-hidden shadow-2xl aspect-[16/9] group">
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition duration-500 z-10 pointer-events-none"></div>
                    <iframe 
                        class="absolute inset-0 w-full h-full object-cover scale-105"
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

</div>

@include('components.product-card')

@endsection
