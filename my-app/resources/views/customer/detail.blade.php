@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', $product->title . ' | KickCraze')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@php
    $mainImageUrl = $product->image ? route('product.image', $product->id) : null;
    $galleryUrls  = $product->images->map(fn($img) => route('product.gallery.image', $img->id))->all();
    $allImages    = $mainImageUrl ? array_merge([$mainImageUrl], $galleryUrls) : $galleryUrls;
@endphp

<style>
    .size-button.selected { background-color:#000; color:#fff; border-color:#000; }
    .thumb.active { border-color:#000; box-shadow: 0 8px 20px -8px rgba(0,0,0,0.4); }
    .star-input input { display:none; }
    .star-input label { cursor:pointer; transition:transform .15s; }
    .star-input label:hover { transform:scale(1.15); }
</style>

<div class="bg-gray-50 font-sans antialiased">

    {{-- SUCCESS NOTIFICATION --}}
    @if (session('success'))
        <div id="successNotification"
             class="fixed top-6 right-6 z-50 p-4 rounded-xl shadow-2xl transition-transform transform duration-500 ease-in-out
                    bg-black border border-zinc-200 text-white flex items-center space-x-3"
             role="alert">
            <i class="fas fa-check-circle text-xl"></i>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const n = document.getElementById('successNotification');
                if (!n) return;
                setTimeout(() => n.classList.add('translate-x-full'), 2500);
            });
        </script>
    @endif

    <main class="min-h-screen pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Button --}}
            <div class="mb-10">
                <a href="{{ url()->previous() ?? route('products.index') }}"
                   class="inline-flex items-center text-lg font-bold text-gray-700 hover:text-gray-900 transition duration-150 p-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                    <i class="fas fa-arrow-left mr-3"></i>
                    Back to All Shoes
                </a>
            </div>

            {{-- PRODUCT DETAILS --}}
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

                {{-- LEFT: Gallery --}}
                <div class="w-full lg:w-3/5">
                    <div class="flex gap-4 lg:gap-6">

                        {{-- Thumbnails (vertical on desktop) --}}
                        <div class="flex flex-col gap-3 w-20 lg:w-24 shrink-0">
                            @forelse($allImages as $i => $url)
                                <button type="button"
                                        data-img="{{ $url }}"
                                        class="thumb {{ $i === 0 ? 'active' : '' }} aspect-square rounded-2xl overflow-hidden bg-[#F6F6F6] border-2 border-transparent hover:border-gray-400 transition-all duration-200">
                                    <img src="{{ $url }}" alt="Angle {{ $i + 1 }}" class="w-full h-full object-contain p-2">
                                </button>
                            @empty
                                <div class="aspect-square rounded-2xl bg-gray-100"></div>
                            @endforelse
                        </div>

                        {{-- Main image --}}
                        <div class="flex-1">
                            <div class="sticky top-24 bg-[#F6F6F6] rounded-[2.5rem] p-10 md:p-16 flex justify-center items-center overflow-hidden group min-h-[480px] lg:min-h-[600px]">
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-[15rem] font-black text-gray-200/50 uppercase tracking-tighter mix-blend-multiply pointer-events-none select-none z-0">
                                    {{ mb_substr($product->category, 0, 3) }}
                                </div>
                                @if(!empty($allImages))
                                    <img id="mainImage"
                                         class="relative z-10 w-full max-h-[600px] object-contain drop-shadow-2xl transition duration-500 ease-out group-hover:scale-110 group-hover:-rotate-2"
                                         src="{{ $allImages[0] }}"
                                         alt="{{ $product->title }}">
                                @else
                                    <div class="text-gray-400 text-sm">No image available</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Details --}}
                <div class="w-full lg:w-2/5 flex flex-col py-4 lg:py-10">

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-3">
                        @if($product->brand) {{ $product->brand }} · @endif {{ $product->category }} Collection
                    </p>

                    <h1 class="text-5xl md:text-6xl font-black text-gray-900 mb-4 tracking-tighter uppercase leading-[1.1]">
                        {{ $product->title }}
                    </h1>

                    {{-- Rating snippet --}}
                    <a href="#reviews" class="flex items-center gap-2 mb-6 group">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm font-bold text-gray-900">{{ number_format($averageRating, 1) }}</span>
                        <span class="text-sm text-gray-500 group-hover:text-gray-900 underline underline-offset-4">
                            ({{ $reviewCount }} {{ \Illuminate\Support\Str::plural('review', $reviewCount) }})
                        </span>
                    </a>

                    {{-- Price & Stock --}}
                    <div class="mb-10 flex items-end justify-between border-b border-gray-200 pb-8">
                        <p class="text-4xl md:text-5xl font-medium text-gray-900 tracking-tight">
                            ₱{{ number_format($product->price, 2) }}
                        </p>
                        <div class="bg-gray-100 rounded-full px-4 py-2 flex items-center">
                            @if($product->stock > 0)
                                <div class="w-2.5 h-2.5 rounded-full bg-green-500 mr-2 animate-pulse"></div>
                                <span class="text-sm font-bold text-gray-900 uppercase tracking-wider">{{ $product->stock }} Available</span>
                            @else
                                <div class="w-2.5 h-2.5 rounded-full bg-red-500 mr-2"></div>
                                <span class="text-sm font-bold text-gray-900 uppercase tracking-wider">Sold Out</span>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-10">
                        <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900 mb-4">The Story</h3>
                        <p class="text-lg text-gray-600 leading-relaxed font-light">
                            {{ $product->description }}
                        </p>
                    </div>

                    {{-- Add to Cart Form --}}
                    @if($product->stock > 0)
                        <form id="addToCartForm" action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-10">
                            @csrf
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900">Select Size</h3>
                                    <button type="button" class="text-xs font-bold text-gray-400 hover:text-gray-900 underline underline-offset-4 transition">Size Guide</button>
                                </div>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                    @php
                                        $sizes = !empty($product->sizes) ? $product->sizes : [7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 12, 13, 14];
                                    @endphp
                                    @foreach($sizes as $size)
                                        <button type="button"
                                                data-size="{{ $size }}"
                                                class="size-button h-14 border border-gray-200 rounded-xl text-base font-medium text-gray-900 hover:border-black transition-all duration-200 bg-white">
                                            US {{ $size }}
                                        </button>
                                    @endforeach
                                </div>
                                <span id="sizeError" class="text-xs font-bold text-red-500 mt-2 block opacity-0 transition-opacity duration-300">
                                    Please select a size to continue.
                                </span>
                                <input type="hidden" name="size" id="selectedSize" value="">
                            </div>

                            <div class="flex space-x-4">
                                <div class="w-1/3">
                                    <select name="quantity" id="quantity" class="w-full h-16 px-4 border border-gray-200 rounded-xl text-lg font-medium text-gray-900 focus:ring-black focus:border-black bg-white appearance-none cursor-pointer">
                                        @for($i = 1; $i <= min(10, $product->stock); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                @auth
                                    <button type="submit" id="addToCartButton" disabled
                                            class="w-2/3 h-16 rounded-xl bg-black text-white font-bold text-lg uppercase tracking-wider hover:bg-gray-800 transition duration-300 ease-out shadow-xl shadow-black/20 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-black disabled:shadow-none">
                                        Add to Bag
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="w-2/3 h-16 flex items-center justify-center rounded-xl bg-black text-white font-bold text-lg uppercase tracking-wider hover:bg-gray-800 transition duration-300 ease-out shadow-xl shadow-black/20">
                                        Login to Order
                                    </a>
                                @endauth
                            </div>
                        </form>
                    @else
                        <div class="h-16 w-full flex items-center justify-center rounded-xl bg-gray-100 text-gray-500 font-bold text-lg uppercase tracking-wider cursor-not-allowed">
                            Sold Out
                        </div>
                    @endif

                    {{-- Accordions: Shipping & Reviews jump --}}
                    <div class="mt-12 border-t border-gray-200 pt-6 space-y-2">

                        {{-- Shipping & Returns accordion --}}
                        <details class="group border-b border-gray-200 py-4">
                            <summary class="flex justify-between items-center cursor-pointer list-none">
                                <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900">Shipping &amp; Returns</h4>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-open:rotate-180 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </summary>
                            <div class="mt-5 space-y-4 text-sm text-gray-600 leading-relaxed">
                                <div class="flex gap-3">
                                    <i class="fas fa-truck text-gray-900 mt-1"></i>
                                    <div>
                                        <p class="font-bold text-gray-900">Free Standard Shipping</p>
                                        <p>On all orders over ₱2,500 within Metro Manila &amp; major cities. Delivery in 2–5 business days.</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <i class="fas fa-bolt text-gray-900 mt-1"></i>
                                    <div>
                                        <p class="font-bold text-gray-900">Express Delivery</p>
                                        <p>Next-day dispatch available at checkout for an additional fee.</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <i class="fas fa-undo text-gray-900 mt-1"></i>
                                    <div>
                                        <p class="font-bold text-gray-900">30-Day Returns</p>
                                        <p>Unworn pairs in the original box can be returned within 30 days for a full refund. Sale items are final sale.</p>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <i class="fas fa-shield-halved text-gray-900 mt-1"></i>
                                    <div>
                                        <p class="font-bold text-gray-900">Authenticity Guaranteed</p>
                                        <p>Every pair is sourced directly and inspected by our KickCraze authentication team.</p>
                                    </div>
                                </div>
                            </div>
                        </details>

                        {{-- Reviews jump --}}
                        <a href="#reviews" class="flex justify-between items-center cursor-pointer group py-4 border-b border-gray-200">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900">Product Reviews ({{ number_format($averageRating, 1) }}/5)</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-black transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M13 6l6 6-6 6"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- REVIEWS SECTION --}}
            <section id="reviews" class="mt-24 pt-16 border-t border-gray-200">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                    {{-- Left: Summary --}}
                    <div class="lg:col-span-4">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-3">Customer Feedback</p>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tighter uppercase leading-[1.1]">
                            Reviews
                        </h2>

                        <div class="flex items-end gap-3 mb-4">
                            <span class="text-6xl font-black text-gray-900 leading-none">{{ number_format($averageRating, 1) }}</span>
                            <div class="pb-2">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="text-xs text-gray-500 mt-1">{{ $reviewCount }} {{ \Illuminate\Support\Str::plural('review', $reviewCount) }}</p>
                            </div>
                        </div>

                        {{-- Rating distribution bars --}}
                        <div class="space-y-2 mb-8">
                            @foreach([5,4,3,2,1] as $bucket)
                                @php
                                    $count = $ratingCounts[$bucket] ?? 0;
                                    $pct   = $reviewCount > 0 ? round($count / $reviewCount * 100) : 0;
                                @endphp
                                <div class="flex items-center gap-3 text-xs text-gray-600">
                                    <span class="w-6 font-bold">{{ $bucket }}★</span>
                                    <div class="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="w-8 text-right">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Review form --}}
                        @auth
                            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                                <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900 mb-4">Write a Review</h3>
                                <form action="{{ route('product.review.store', $product->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">Your rating</label>
                                        <div class="star-input flex flex-row-reverse justify-end gap-1 text-3xl text-gray-300">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" name="rating" id="star-{{ $i }}" value="{{ $i }}" required>
                                                <label for="star-{{ $i }}" data-val="{{ $i }}" class="hover:text-yellow-400 peer-checked:text-yellow-400">★</label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">Title <span class="text-gray-400 normal-case">(optional)</span></label>
                                        <input type="text" name="title" maxlength="120" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-black" placeholder="Great fit and comfortable">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">Your review</label>
                                        <textarea name="comment" rows="4" required maxlength="2000" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-black focus:border-black" placeholder="Tell others what you think..."></textarea>
                                    </div>
                                    @error('rating') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                                    @error('comment') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                                    <button type="submit" class="w-full h-12 rounded-xl bg-black text-white font-bold text-sm uppercase tracking-wider hover:bg-gray-800 transition">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center">
                                <p class="text-sm text-gray-600 mb-4">Sign in to write a review.</p>
                                <a href="{{ route('login') }}" class="inline-block h-12 px-8 leading-[3rem] rounded-xl bg-black text-white font-bold text-sm uppercase tracking-wider hover:bg-gray-800 transition">
                                    Log In
                                </a>
                            </div>
                        @endauth
                    </div>

                    {{-- Right: Review list --}}
                    <div class="lg:col-span-8">
                        @forelse($reviews as $review)
                            <article class="border-b border-gray-200 py-6 first:pt-0">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-sm">
                                                {{ strtoupper(substr($review->user->fullname ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">{{ $review->user->fullname ?? 'Anonymous' }}</p>
                                                <p class="text-xs text-gray-400">{{ $review->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->title)
                                    <h4 class="font-bold text-gray-900 mb-2">{{ $review->title }}</h4>
                                @endif
                                <p class="text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                            </article>
                        @empty
                            <div class="bg-white border border-dashed border-gray-300 rounded-2xl py-16 text-center">
                                <i class="fas fa-comment-slash text-4xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">No reviews yet. Be the first to share your thoughts.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- SIMILAR PRODUCTS --}}
            @if($similar->isNotEmpty())
                <section class="mt-24 pt-16 border-t border-gray-200">
                    <div class="flex items-end justify-between mb-10">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-3">You May Also Like</p>
                            <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tighter uppercase leading-[1.1]">
                                Similar Kicks
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        @foreach($similar as $rec)
                            <x-shop-card :product="$rec" />
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // -- Image gallery: click + hover swap
        const mainImage = document.getElementById('mainImage');
        const thumbs    = document.querySelectorAll('.thumb');
        let originalSrc = mainImage ? mainImage.src : null;

        thumbs.forEach(thumb => {
            const url = thumb.dataset.img;
            thumb.addEventListener('mouseenter', () => {
                if (mainImage) mainImage.src = url;
            });
            thumb.addEventListener('mouseleave', () => {
                if (mainImage) mainImage.src = originalSrc;
            });
            thumb.addEventListener('click', () => {
                if (!mainImage) return;
                thumbs.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
                originalSrc = url;
                mainImage.src = url;
            });
        });

        // -- Size selection
        const sizeButtons        = document.querySelectorAll('.size-button');
        const addToCartButton    = document.getElementById('addToCartButton');
        const selectedSizeInput  = document.getElementById('selectedSize');
        const sizeError          = document.getElementById('sizeError');

        function updateSizeSelection(selectedButton) {
            let selectedSize = '';
            sizeButtons.forEach(btn => btn.classList.remove('selected'));
            if (selectedButton) {
                selectedButton.classList.add('selected');
                selectedSize = selectedButton.dataset.size;
            }
            if (selectedSizeInput) selectedSizeInput.value = selectedSize;
            if (addToCartButton) {
                addToCartButton.disabled = !selectedSize;
                if (selectedSize && sizeError) sizeError.classList.add('opacity-0');
            }
        }

        sizeButtons.forEach(button => {
            button.addEventListener('click', () => updateSizeSelection(button));
        });

        const form = document.getElementById('addToCartForm');
        if (form) {
            form.addEventListener('submit', (event) => {
                if (selectedSizeInput && !selectedSizeInput.value) {
                    event.preventDefault();
                    if (sizeError) sizeError.classList.remove('opacity-0');
                }
            });
        }
        if (selectedSizeInput && !selectedSizeInput.value && addToCartButton) {
            addToCartButton.disabled = true;
        }

        // -- Star rating: highlight on hover
        document.querySelectorAll('.star-input').forEach(group => {
            const labels = Array.from(group.querySelectorAll('label')).sort(
                (a, b) => parseInt(a.dataset.val) - parseInt(b.dataset.val)
            );
            function paint(uptoVal) {
                labels.forEach(l => {
                    l.classList.toggle('text-yellow-400', parseInt(l.dataset.val) <= uptoVal);
                    l.classList.toggle('text-gray-300', parseInt(l.dataset.val) > uptoVal);
                });
            }
            labels.forEach(label => {
                label.addEventListener('mouseenter', () => paint(parseInt(label.dataset.val)));
                label.addEventListener('click', () => paint(parseInt(label.dataset.val)));
            });
            group.addEventListener('mouseleave', () => {
                const checked = group.querySelector('input[type=radio]:checked');
                paint(checked ? parseInt(checked.value) : 0);
            });
        });
    });
</script>

@endsection
