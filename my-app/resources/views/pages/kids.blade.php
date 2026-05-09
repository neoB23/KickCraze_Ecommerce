@include('components.lastnav')
@extends('layout.app')
@vite('resources/css/app.css')
@section('title', 'KickCraze - Kids Shoes')
@section('content')

{{-- Main Content Container --}}
<div class="max-w-7xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:px-8">
    
    {{-- Header --}}
    <div class="mb-10 flex flex-col items-start">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-zinc-800 to-zinc-500 tracking-tight uppercase">
            Kids Footwear Collection
        </h1>
        <div class="h-1 w-24 bg-gradient-to-r from-zinc-500 to-zinc-800 mt-4 rounded-full"></div>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
        
        {{-- Luxury Minimalist Product Card --}}
        <div class="group relative bg-white border border-zinc-100 rounded-2xl overflow-hidden hover:border-zinc-300 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 flex flex-col">
            
            {{-- Image Container --}}
            <a href="{{ route('product.show', $product->id) }}" class="block relative aspect-square overflow-hidden bg-zinc-50">
                
                {{-- Category Badge --}}
                <div class="absolute top-4 left-4 z-10">
                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider text-zinc-600 bg-white/80 backdrop-blur-md border border-zinc-200/50 rounded-full shadow-sm">
                        Trending
                    </span>
                </div>

                {{-- Stock Badge --}}
                @php
                    $inStock = $product->stock > 0;
                @endphp
                @if(!$inStock)
                <div class="absolute top-4 right-4 z-10">
                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider text-red-600 bg-white/80 backdrop-blur-md border border-red-200/50 rounded-full shadow-sm">
                        Sold Out
                    </span>
                </div>
                @endif
                
                {{-- Product Image with zoom effect --}}
                <img class="w-full h-full object-cover object-center scale-100 group-hover:scale-105 transition-transform duration-700 ease-in-out mix-blend-multiply"
                     src="data:image/jpeg;base64,{{ base64_encode($product->image) }}"
                     alt="{{ $product->title }}" />
                
                {{-- Subtle vignette effect overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/5 to-transparent opacity-80"></div>
            </a>

            {{-- Content Section --}}
            <div class="p-6 flex flex-col flex-grow relative z-20 bg-white">
                
                {{-- Title --}}
                <div class="flex-grow mb-4">
                    <a href="{{ route('product.show', $product->id) }}">
                        <h2 class="text-xl font-bold text-zinc-900 line-clamp-2 group-hover:text-zinc-600 transition-colors duration-300">
                            {{ $product->title }}
                        </h2>
                    </a>
                </div>
                
                {{-- Details Row --}}
                <div class="flex items-end justify-between mt-auto pt-4 border-t border-zinc-100">
                    {{-- Price Section --}}
                    <div>
                        <p class="text-[10px] text-zinc-400 uppercase tracking-widest font-bold mb-1">Price</p>
                        <p class="text-2xl font-black text-zinc-900">
                            ${{ number_format($product->price, 2) }}
                        </p>
                    </div>

                    {{-- Action Button / Rating --}}
                    <div class="flex flex-col items-end">
                        {{-- Minimalist Rating --}}
                        <div class="flex items-center gap-1 mb-2">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm font-bold text-zinc-600">
                                {{ number_format($product->rating, 1) }}
                            </span>
                        </div>

                        {{-- Details Button --}}
                        <a href="{{ route('product.show', $product->id) }}" 
                           class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-zinc-900 text-white hover:bg-blue-600 hover:scale-110 transition-all duration-300 {{ !$inStock ? 'opacity-50 pointer-events-none cursor-not-allowed' : 'shadow-md shadow-zinc-900/20' }}"
                           title="{{ $inStock ? 'View Details' : 'Sold Out' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection