@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze | Wishlist')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="w-full max-w-none min-h-screen py-8 px-4 sm:px-6 lg:px-10 xl:px-12 bg-zinc-50">

    <div class="max-w-[1400px] mx-auto">
        <div class="flex items-end justify-between mb-8 pb-6 border-b border-zinc-200">
            <div>
                <span class="inline-block text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-3">— Saved for later</span>
                <h1 class="text-4xl md:text-5xl font-black text-zinc-950 tracking-tighter uppercase leading-[0.9]">My Wishlist</h1>
            </div>
            <div class="hidden sm:block text-right">
                <p class="text-sm text-zinc-500">{{ $items->count() }} {{ \Illuminate\Support\Str::plural('item', $items->count()) }} saved</p>
            </div>
        </div>

        @if($items->count() === 0)
            <div class="bg-white border border-zinc-200 rounded-2xl py-20 text-center">
                <div class="w-16 h-16 mx-auto mb-5 rounded-full bg-zinc-100 flex items-center justify-center">
                    <i class="fas fa-heart text-2xl text-zinc-400"></i>
                </div>
                <h2 class="text-xl font-black text-zinc-900 mb-2">Your wishlist is empty</h2>
                <p class="text-sm text-zinc-500 mb-6">Tap the heart on any product to save it here.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 rounded-full bg-zinc-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-zinc-700">
                    <i class="fas fa-shoe-prints text-xs"></i>
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($items as $item)
                    @php $product = $item->product; @endphp
                    @if($product)
                    <div class="group bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 flex flex-col">
                        <a href="{{ route('product.show', $product->id) }}" class="relative block bg-[#F6F6F6] aspect-square overflow-hidden">
                            @if($product->image)
                                <img src="{{ route('product.image', $product->id) }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-contain p-6 transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-2">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-zinc-400 text-sm">No image</div>
                            @endif

                            <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="absolute top-3 right-3">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        title="Remove from wishlist"
                                        class="w-10 h-10 rounded-full bg-white/95 backdrop-blur flex items-center justify-center text-rose-500 shadow-sm hover:bg-rose-50 hover:text-rose-600 transition">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </form>
                        </a>

                        <div class="p-4 flex flex-col flex-1">
                            @if($product->brand)
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 mb-1">{{ $product->brand }}</p>
                            @endif
                            <a href="{{ route('product.show', $product->id) }}" class="block">
                                <h3 class="text-sm font-bold text-zinc-900 leading-tight line-clamp-2 hover:underline">{{ $product->title }}</h3>
                            </a>

                            <div class="mt-3 mb-4 flex items-center justify-between">
                                <span class="text-lg font-black text-zinc-900">₱{{ number_format($product->price, 2) }}</span>
                                @if($product->stock > 0)
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-green-600">In stock</span>
                                @else
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-rose-500">Sold out</span>
                                @endif
                            </div>

                            <div class="mt-auto flex gap-2">
                                @if($product->stock > 0)
                                    <form action="{{ route('wishlist.moveToCart', $item->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-zinc-900 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-white transition hover:bg-zinc-700">
                                            <i class="fas fa-bag-shopping text-xs"></i>
                                            Move to Cart
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                            class="flex-1 inline-flex items-center justify-center gap-2 rounded-full bg-zinc-100 px-4 py-2.5 text-xs font-bold uppercase tracking-wider text-zinc-400 cursor-not-allowed">
                                        Sold Out
                                    </button>
                                @endif
                                <a href="{{ route('product.show', $product->id) }}"
                                   title="View details"
                                   class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-zinc-200 text-zinc-700 hover:border-zinc-900 hover:text-zinc-950 transition">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
