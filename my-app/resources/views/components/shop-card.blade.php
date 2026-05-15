@props([
    'product',
    'wishlistedIds' => [],
])

@php
    $inStock      = $product->stock > 0;
    $lowStock     = $inStock && $product->stock <= 3;
    $isNew        = $product->created_at && $product->created_at->gt(now()->subDays(14));
    $isWishlisted = in_array($product->id, (array) $wishlistedIds);
    $sizes        = is_array($product->sizes) ? array_slice($product->sizes, 0, 6) : [];
    $rating       = (float) ($product->rating ?? 0);
@endphp

<div class="shop-card group relative bg-white border border-zinc-200/70 rounded-3xl overflow-hidden hover:border-zinc-900 hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.25)] transition-all duration-500 flex flex-col">

    {{-- Image area --}}
    <a href="{{ route('product.show', $product->id) }}" class="block relative aspect-square overflow-hidden bg-[#F6F6F6]">

        {{-- Watermark category text --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none">
            <span class="text-[8rem] font-black text-zinc-200/60 uppercase tracking-tighter mix-blend-multiply leading-none">
                {{ mb_substr($product->category, 0, 3) }}
            </span>
        </div>

        {{-- Badges row (top-left) --}}
        <div class="absolute top-3 left-3 z-20 flex flex-col gap-1.5">
            @if($product->brand)
                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-zinc-900 bg-white border border-zinc-200 rounded-full shadow-sm">
                    {{ $product->brand }}
                </span>
            @endif
            @if($isNew && $inStock)
                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-white bg-zinc-950 rounded-full shadow-sm">
                    Just In
                </span>
            @endif
            @if($lowStock)
                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-amber-700 bg-amber-50 border border-amber-200 rounded-full shadow-sm">
                    Only {{ $product->stock }} left
                </span>
            @endif
            @if(!$inStock)
                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-[0.2em] text-rose-700 bg-rose-50 border border-rose-200 rounded-full shadow-sm">
                    Sold Out
                </span>
            @endif
        </div>

        {{-- Wishlist heart (top-right) --}}
        <div class="absolute top-3 right-3 z-20">
            @auth
                <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" onclick="event.stopPropagation()">
                    @csrf
                    <button type="submit"
                            onclick="event.stopPropagation()"
                            title="{{ $isWishlisted ? 'Remove from wishlist' : 'Add to wishlist' }}"
                            class="w-10 h-10 rounded-full bg-white/95 backdrop-blur flex items-center justify-center shadow-sm border border-zinc-200 hover:scale-110 transition-all duration-300 {{ $isWishlisted ? 'text-rose-500' : 'text-zinc-400 hover:text-rose-500' }}">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="{{ $isWishlisted ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   onclick="event.stopPropagation()"
                   title="Login to save"
                   class="w-10 h-10 rounded-full bg-white/95 backdrop-blur flex items-center justify-center shadow-sm border border-zinc-200 text-zinc-400 hover:text-rose-500 hover:scale-110 transition-all duration-300">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                    </svg>
                </a>
            @endauth
        </div>

        {{-- Product image --}}
        @if($product->image)
            <img class="relative z-10 w-full h-full object-contain p-8 transition-all duration-700 ease-out group-hover:scale-110 group-hover:-rotate-3 drop-shadow-2xl"
                 loading="lazy"
                 src="{{ route('product.image', $product->id) }}"
                 alt="{{ $product->title }}" />
        @else
            <div class="relative z-10 w-full h-full flex items-center justify-center text-zinc-300 text-sm">No image</div>
        @endif

        {{-- Size hover overlay --}}
        @if(!empty($sizes) && $inStock)
        <div class="absolute inset-x-0 bottom-0 z-20 px-4 pb-4 pt-8 bg-gradient-to-t from-white via-white/95 to-transparent opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
            <p class="text-[9px] font-black uppercase tracking-[0.25em] text-zinc-500 mb-2">Available Sizes</p>
            <div class="flex flex-wrap gap-1.5">
                @foreach($sizes as $size)
                    <span class="px-2 py-1 text-[10px] font-bold text-zinc-900 bg-white border border-zinc-200 rounded-md">
                        {{ $size }}
                    </span>
                @endforeach
                @if(is_array($product->sizes) && count($product->sizes) > 6)
                    <span class="px-2 py-1 text-[10px] font-bold text-zinc-500">+{{ count($product->sizes) - 6 }}</span>
                @endif
            </div>
        </div>
        @endif
    </a>

    {{-- Footer --}}
    <div class="p-5 flex flex-col flex-grow bg-white">
        <div class="flex items-center justify-between mb-2">
            @if($product->subcategory)
                <span class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 font-black">{{ $product->subcategory }}</span>
            @else
                <span></span>
            @endif
            <div class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-xs font-bold text-zinc-700">{{ number_format($rating, 1) }}</span>
            </div>
        </div>

        <a href="{{ route('product.show', $product->id) }}">
            <h2 class="text-base font-black text-zinc-950 leading-snug line-clamp-2 group-hover:text-zinc-700 transition-colors tracking-tight">
                {{ $product->title }}
            </h2>
        </a>

        <div class="mt-auto pt-4 flex items-end justify-between gap-3">
            <div>
                <p class="text-[10px] text-zinc-400 uppercase tracking-[0.2em] font-black mb-0.5">Price</p>
                <p class="text-2xl font-black text-zinc-950 tracking-tight">
                    ₱{{ number_format($product->price, 2) }}
                </p>
            </div>

            @auth
                @if($inStock)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                                title="Quick add to cart"
                                class="inline-flex items-center gap-2 h-11 px-4 rounded-full bg-zinc-950 text-white text-[11px] font-black uppercase tracking-[0.2em] hover:bg-zinc-800 hover:gap-3 transition-all duration-300 shadow-md shadow-zinc-900/20">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add
                        </button>
                    </form>
                @else
                    <a href="{{ route('product.show', $product->id) }}"
                       class="inline-flex items-center gap-2 h-11 px-4 rounded-full bg-zinc-100 text-zinc-500 text-[11px] font-black uppercase tracking-[0.2em]">
                        View
                    </a>
                @endif
            @else
                <a href="{{ route('product.show', $product->id) }}"
                   class="inline-flex items-center justify-center w-11 h-11 rounded-full bg-zinc-950 text-white hover:bg-zinc-800 hover:scale-110 transition-all duration-300 shadow-md shadow-zinc-900/20"
                   title="View details">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @endauth
        </div>
    </div>
</div>
