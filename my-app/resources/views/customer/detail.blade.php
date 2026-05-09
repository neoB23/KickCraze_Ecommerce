@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} | KickCraze</title>
    {{-- Vite directive for assets --}}
    @vite('resources/css/app.css')
    {{-- Font Awesome for Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom styling to visually highlight the selected size button */
        .size-button.selected {
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    
    {{-- SUCCESS NOTIFICATION COMPONENT (Floating, Top Right) --}}
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
        {{-- Custom script to handle delayed redirection after showing notification --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const notification = document.getElementById('successNotification');
                if (notification) {
                    // Show notification (it's initially visible via Blade, but we can animate it)
                    setTimeout(() => {
                        notification.classList.add('translate-x-full');
                    }, 2000); // Wait 2 seconds
                    
                    setTimeout(() => {
                        // Redirect to cart section
                        window.location.href = "{{ route('customer.cart') }}"; 
                    }, 2500); // Redirect after 2.5 seconds total
                }
            });
        </script>
    @endif
    {{-- END SUCCESS NOTIFICATION --}}

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

            {{-- PRODUCT DETAILS SECTION --}}
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

                {{-- 1. Product Image Area (Sticky on Desktop) --}}
                <div class="w-full lg:w-3/5">
                    <div class="sticky top-24 bg-[#F6F6F6] rounded-[2.5rem] p-10 md:p-16 flex justify-center items-center overflow-hidden group">
                        {{-- Subtle background text/element --}}
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-[15rem] font-black text-gray-200/50 uppercase tracking-tighter mix-blend-multiply pointer-events-none select-none z-0">
                            {{ mb_substr($product->category, 0, 3) }}
                        </div>
                        <img class="relative z-10 w-full max-h-[600px] object-contain drop-shadow-2xl transition duration-700 ease-out group-hover:scale-110 group-hover:-rotate-2"
                             src="data:image/jpeg;base64,{{ base64_encode($product->image) }}"
                             alt="{{ $product->title }} Shoe">
                    </div>
                </div>

                {{-- 2. Product Details and Action Area --}}
                <div class="w-full lg:w-2/5 flex flex-col justify-center py-4 lg:py-10">

                    <p class="text-xs font-bold uppercase tracking-[0.2em] text-gray-400 mb-3">{{ $product->category }} Collection</p>

                    {{-- Title --}}
                    <h1 class="text-5xl md:text-6xl font-black text-gray-900 mb-6 tracking-tighter uppercase leading-[1.1]">
                        {{ $product->title }}
                    </h1>

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
                            
                            {{-- START: Combined Size Selector --}}
                            <div>
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-gray-900">Select Size</h3>
                                    <button type="button" class="text-xs font-bold text-gray-400 hover:text-gray-900 underline underline-offset-4 transition">Size Guide</button>
                                </div>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                    @php
                                        $sizes = [7, 7.5, 8, 8.5, 9, 9.5, 10, 10.5, 11, 12, 13, 14];
                                    @endphp
                                    @foreach($sizes as $size)
                                        <button type="button" 
                                                data-size="{{ $size }}"
                                                class="size-button h-14 border border-gray-200 rounded-xl text-base font-medium text-gray-900
                                                        hover:border-black transition-all duration-200 bg-white">
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
                                {{-- Quantity Selector --}}
                                <div class="w-1/3">
                                    <select name="quantity" id="quantity" class="w-full h-16 px-4 border border-gray-200 rounded-xl text-lg font-medium text-gray-900 focus:ring-black focus:border-black bg-white appearance-none cursor-pointer">
                                        @for($i = 1; $i <= min(10, $product->stock); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                @auth
                                    {{-- Add to Cart Button --}}
                                    <button type="submit" id="addToCartButton" disabled
                                            class="w-2/3 h-16 rounded-xl bg-black text-white font-bold text-lg uppercase tracking-wider
                                                    hover:bg-gray-800 transition duration-300 ease-out shadow-xl shadow-black/20
                                                    disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-black disabled:shadow-none">
                                        Add to Bag
                                    </button>
                                @else
                                    {{-- Login Button --}}
                                    <a href="{{ route('login') }}" 
                                    class="w-2/3 h-16 flex items-center justify-center rounded-xl bg-black text-white font-bold text-lg uppercase tracking-wider hover:bg-gray-800 transition duration-300 ease-out shadow-xl shadow-black/20">
                                        Login to Order
                                    </a>
                                @endauth
                            </div>
                        </form>
                    @else
                        {{-- Out of Stock Button --}}
                        <div class="h-16 w-full flex items-center justify-center rounded-xl bg-gray-100 text-gray-500 font-bold text-lg uppercase tracking-wider cursor-not-allowed">
                            Sold Out
                        </div>
                    @endif
                    
                    {{-- Care & Shipping Info Accordion style placeholders --}}
                    <div class="mt-12 border-t border-gray-200 pt-6 space-y-4">
                        <div class="flex justify-between items-center cursor-pointer group">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900">Shipping & Returns</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-black transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                        <div class="flex justify-between items-center cursor-pointer group">
                            <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900">Product Reviews (4.8/5)</h4>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-black transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- REVIEW SECTION (Placeholder for full section) --}}
            <div id="reviews" class="mt-20 pt-16 border-t border-gray-200 hidden">
                {{-- Future content for full reviews goes here, linked by the minimalist snippet above --}}
            </div>
            
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sizeButtons = document.querySelectorAll('.size-button');
            const addToCartButton = document.getElementById('addToCartButton');
            const selectedSizeInput = document.getElementById('selectedSize');
            const sizeError = document.getElementById('sizeError');
            // Function to update the selected size and button state
            function updateSizeSelection(selectedButton) {
                let selectedSize = '';         
                // Remove 'selected' class from all buttons
                sizeButtons.forEach(btn => {
                    btn.classList.remove('selected');
                });
                if (selectedButton) {
                    // Add 'selected' class to the clicked button
                    selectedButton.classList.add('selected');
                    selectedSize = selectedButton.dataset.size;
                }
                
                selectedSizeInput.value = selectedSize;
                if (selectedSize) {
                    // Enable button if a size is selected and button exists
                    if (addToCartButton) { 
                        addToCartButton.disabled = false;
                        sizeError.classList.add('opacity-0'); // Hide error
                    }
                } else {
                    // Disable button if no size is selected
                    if (addToCartButton) {
                        addToCartButton.disabled = true;
                    }
                }
            }
            // Attach click listeners to size buttons
            sizeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    updateSizeSelection(button);
                });
            });
            // Handle form submission validation
            const form = document.getElementById('addToCartForm');
            if (form) {
                form.addEventListener('submit', (event) => {
                    if (!selectedSizeInput.value) {
                        event.preventDefault();
                        sizeError.classList.remove('opacity-0'); // Show error
                    }
                });
            }
            // Initial check: ensure the button is disabled on load if no size is pre-selected
            if (!selectedSizeInput.value && addToCartButton) {
                addToCartButton.disabled = true;
            }
        });
    </script>
</body>
</html>
@endsection