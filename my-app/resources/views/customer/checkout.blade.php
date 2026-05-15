@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze | Checkout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

{{-- Hero --}}
<div class="bg-zinc-950 pt-16 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 text-sm text-zinc-400 mb-4 tracking-wider uppercase">
            <a href="{{ route('customer.home') }}" class="hover:text-white transition">Home</a>
            <span>/</span>
            <a href="{{ route('customer.cart') }}" class="hover:text-white transition">Cart</a>
            <span>/</span>
            <span class="text-white">Checkout</span>
        </div>
        <h1 class="text-5xl sm:text-6xl font-black text-white tracking-tight">CHECKOUT</h1>
        <p class="mt-4 text-zinc-400 max-w-xl text-sm sm:text-base">Final step. Confirm your shipping details and lock in your kicks.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 pb-24">

    {{-- Error notice --}}
    @if (session('error'))
        <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl p-4 flex items-center gap-3">
            <i class="fas fa-circle-exclamation"></i>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
    @endif

    @php
        $subtotal = $items->sum(fn($i) => optional($i->product)->price * $i->quantity);
        $itemCount = $items->sum('quantity');
        $shipping = $subtotal > 0 ? ($subtotal >= 2500 ? 0 : 150) : 0;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shipping + $tax;
    @endphp

    <form action="{{ route('checkout.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Shipping --}}
            <div class="bg-white rounded-2xl border border-zinc-200/60 shadow-xl shadow-zinc-200/40 p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-zinc-950 text-white flex items-center justify-center font-black">1</div>
                    <h2 class="text-2xl font-black text-zinc-900 tracking-tight uppercase">Shipping Address</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-1">
                        <label class="block text-[11px] font-black text-zinc-500 uppercase tracking-widest mb-2">Full Name</label>
                        <input type="text" name="full_name" required value="{{ old('full_name', auth()->user()->fullname ?? '') }}" placeholder="Juan dela Cruz" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-zinc-500 uppercase tracking-widest mb-2">Phone Number</label>
                        <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="+63 9XX XXX XXXX" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[11px] font-black text-zinc-500 uppercase tracking-widest mb-2">Street Address</label>
                        <input type="text" name="street" required value="{{ old('street') }}" placeholder="Unit, Building, Street" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-zinc-500 uppercase tracking-widest mb-2">City</label>
                        <input type="text" name="city" required value="{{ old('city') }}" placeholder="Manila" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-black text-zinc-500 uppercase tracking-widest mb-2">Postal Code</label>
                        <input type="text" name="postal_code" required value="{{ old('postal_code') }}" placeholder="1000" class="w-full px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    </div>
                </div>
            </div>

            {{-- Voucher --}}
            <div class="bg-white rounded-2xl border border-zinc-200/60 shadow-xl shadow-zinc-200/40 p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-zinc-950 text-white flex items-center justify-center font-black">2</div>
                    <h2 class="text-2xl font-black text-zinc-900 tracking-tight uppercase">Voucher</h2>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input type="text" name="voucher" id="checkout_voucher" placeholder="Enter voucher code (try KICK10)" class="flex-1 px-4 py-3 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white">
                    <button type="button" id="checkoutApplyVoucher" class="px-6 py-3 bg-zinc-950 hover:bg-zinc-800 text-white text-sm font-black uppercase tracking-widest rounded-xl transition">Apply</button>
                </div>
                <p id="voucher_msg" class="text-xs font-medium mt-3 hidden"></p>
            </div>

            {{-- Payment --}}
            <div class="bg-white rounded-2xl border border-zinc-200/60 shadow-xl shadow-zinc-200/40 p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-zinc-950 text-white flex items-center justify-center font-black">3</div>
                    <h2 class="text-2xl font-black text-zinc-900 tracking-tight uppercase">Payment Method</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label class="relative flex items-center gap-3 p-4 border-2 border-zinc-200 rounded-xl cursor-pointer hover:border-zinc-900 has-[:checked]:border-zinc-900 has-[:checked]:bg-zinc-50 transition">
                        <input type="radio" name="payment_method" value="cod" checked class="accent-zinc-900">
                        <i class="fas fa-money-bill-wave text-xl text-zinc-700"></i>
                        <div>
                            <p class="text-sm font-black text-zinc-900">Cash on Delivery</p>
                            <p class="text-xs text-zinc-500">Pay when it arrives</p>
                        </div>
                    </label>
                    <label class="relative flex items-center gap-3 p-4 border-2 border-zinc-100 rounded-xl bg-zinc-50 cursor-not-allowed opacity-60">
                        <input type="radio" name="payment_method" value="card" disabled class="accent-zinc-900">
                        <i class="fas fa-credit-card text-xl text-zinc-500"></i>
                        <div>
                            <p class="text-sm font-black text-zinc-700">Card Payment</p>
                            <p class="text-xs text-zinc-500">Coming soon</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        {{-- RIGHT: Order Summary --}}
        <aside class="lg:col-span-1">
            <div class="sticky top-24 bg-white rounded-2xl border border-zinc-200/60 shadow-xl shadow-zinc-200/40 overflow-hidden">

                <div class="p-6 sm:p-7 border-b border-zinc-100">
                    <h3 class="text-xs font-black text-zinc-500 uppercase tracking-widest mb-1">Your Order</h3>
                    <p class="text-2xl font-black text-zinc-900">{{ $itemCount }} {{ \Illuminate\Support\Str::plural('Item', $itemCount) }}</p>
                </div>

                {{-- Items --}}
                <div class="px-6 sm:px-7 py-4 max-h-72 overflow-y-auto divide-y divide-zinc-100">
                    @forelse($items as $item)
                        @php $product = $item->product; @endphp
                        <div class="flex items-center gap-3 py-3">
                            <div class="relative w-14 h-14 rounded-lg overflow-hidden bg-zinc-50 border border-zinc-200 shrink-0">
                                @if($product && $product->image)
                                    <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-300"><i class="fas fa-shoe-prints"></i></div>
                                @endif
                                <span class="absolute -top-1 -right-1 bg-zinc-950 text-white text-[10px] font-black rounded-full w-5 h-5 flex items-center justify-center">{{ $item->quantity }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-zinc-900 truncate">{{ optional($product)->title ?? 'Item' }}</p>
                                <p class="text-xs text-zinc-500">{{ optional($product)->brand }}</p>
                            </div>
                            <p class="text-sm font-black text-zinc-900 shrink-0">₱{{ number_format(optional($product)->price * $item->quantity, 2) }}</p>
                        </div>
                    @empty
                        <p class="py-6 text-center text-sm text-zinc-500">Your cart is empty.</p>
                    @endforelse
                </div>

                {{-- Totals --}}
                <div class="p-6 sm:p-7 bg-zinc-50/50 border-t border-zinc-100">
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-zinc-600">
                            <span>Subtotal</span>
                            <span class="font-bold text-zinc-900">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-600">
                            <span>Shipping</span>
                            @if($shipping == 0)
                                <span class="font-bold text-green-600 uppercase text-xs tracking-widest">Free</span>
                            @else
                                <span class="font-bold text-zinc-900">₱{{ number_format($shipping, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-zinc-600">
                            <span>Tax (5%)</span>
                            <span class="font-bold text-zinc-900">₱{{ number_format($tax, 2) }}</span>
                        </div>
                    </div>

                    <div class="my-5 border-t border-dashed border-zinc-300"></div>

                    <div class="flex items-baseline justify-between">
                        <span class="text-xs font-black uppercase tracking-widest text-zinc-500">Total</span>
                        <span class="text-3xl font-black text-zinc-900">₱{{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit"
                            @if($items->isEmpty()) disabled @endif
                            class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-zinc-950 hover:bg-zinc-800 text-white text-sm font-black uppercase tracking-widest rounded-xl transition shadow-lg shadow-zinc-900/20 disabled:opacity-40 disabled:cursor-not-allowed">
                        <i class="fas fa-lock"></i>
                        Confirm &amp; Pay
                    </button>
                    <a href="{{ route('customer.cart') }}" class="mt-3 w-full inline-flex items-center justify-center gap-2 px-6 py-3 border border-zinc-200 hover:border-zinc-900 text-zinc-700 hover:text-zinc-900 text-sm font-bold rounded-xl transition">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Back to Cart
                    </a>

                    <div class="mt-5 flex items-center gap-2 text-[11px] text-zinc-500 uppercase tracking-wider">
                        <i class="fas fa-shield-halved text-green-600"></i>
                        Authenticity &amp; secure checkout guaranteed
                    </div>
                </div>
            </div>
        </aside>
    </form>
</div>

<script>
    document.getElementById('checkoutApplyVoucher')?.addEventListener('click', function () {
        const code = document.getElementById('checkout_voucher').value.trim();
        const msg  = document.getElementById('voucher_msg');
        msg.classList.remove('hidden', 'text-green-600', 'text-rose-600');
        if (!code) {
            msg.classList.add('text-rose-600');
            msg.textContent = 'Please enter a voucher code.';
            return;
        }
        if (code.toUpperCase() === 'KICK10') {
            msg.classList.add('text-green-600');
            msg.textContent = '✓ Voucher applied: 10% discount';
        } else {
            msg.classList.add('text-rose-600');
            msg.textContent = 'Invalid voucher code.';
        }
    });
</script>

@endsection
