@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze | Cart & Checkout')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="w-full max-w-none min-h-screen py-8 px-4 sm:px-6 lg:px-10 xl:px-12">
    <h1 class="text-3xl font-black text-zinc-900 mb-8">Shopping Cart</h1>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-3/5">
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-zinc-200">
                <div class="p-4 bg-zinc-50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <input id="selectAll" type="checkbox" class="h-4 w-4 text-zinc-900 border-zinc-300 rounded focus:ring-0">
                        <label for="selectAll" class="text-sm font-medium text-zinc-700">Select All ({{ $items->count() }} Items)</label>
                    </div>
                    @if($items->count() > 0)
                        <form id="bulkRemoveForm" action="{{ route('cart.removeSelected') }}" method="POST">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:border-zinc-900 hover:text-zinc-950 hover:shadow-sm">
                                <i class="fas fa-trash-can text-xs"></i>
                                Remove Selected
                            </button>
                        </form>
                    @endif
                </div>

                @forelse($items as $item)
                    <div class="p-4 sm:p-6 flex items-start gap-4 hover:bg-zinc-50 transition">
                        <div class="pt-1 flex-shrink-0">
                            <input type="checkbox" form="bulkRemoveForm" name="selected[]" value="{{ $item->id }}" class="selectItem h-4 w-4 text-zinc-900 border-zinc-300 rounded focus:ring-0">
                        </div>

                        <div class="flex flex-col sm:flex-row sm:gap-6 w-full">
                            <div class="flex-shrink-0 flex gap-4 w-full sm:w-auto">
                                <img src="data:image/jpeg;base64,{{ base64_encode($item->product->image) }}" alt="{{ $item->product->title }}" class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-md border border-zinc-200">
                                <div class="flex flex-col justify-center">
                                    <span class="text-base font-semibold text-zinc-900">{{ $item->product->title }}</span>
                                    <span class="text-xs text-zinc-500">SKU: {{ $item->product->id }}</span>
                                    <p class="text-sm font-bold text-zinc-900 mt-2">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>

                            <div class="flex-1 grid grid-cols-3 gap-4 items-center mt-4 sm:mt-0">
                                <div class="hidden sm:block">
                                    <p class="text-sm text-zinc-600">Unit: ${{ number_format($item->product->price, 2) }}</p>
                                </div>
                                <div class="flex items-center justify-center col-span-1 sm:col-span-1">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                        @csrf @method('PATCH')
                                        <button type="submit" formaction="{{ route('cart.decrement', $item->id) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-zinc-200 bg-white text-zinc-700 transition hover:border-zinc-900 hover:text-zinc-950 hover:shadow-sm">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="h-10 w-16 text-center border border-zinc-200 rounded-full p-1 text-sm font-semibold text-zinc-900 focus:border-zinc-900 focus:ring-0">
                                        <button type="submit" formaction="{{ route('cart.increment', $item->id) }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-zinc-200 bg-white text-zinc-700 transition hover:border-zinc-900 hover:text-zinc-950 hover:shadow-sm">+</button>
                                    </form>
                                </div>

                                <div class="flex flex-col items-end">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="inline-flex items-center gap-2 rounded-full border border-transparent bg-zinc-100 px-4 py-2 text-sm font-semibold text-zinc-700 transition hover:bg-rose-50 hover:text-rose-600">
                                            <i class="fas fa-xmark text-xs"></i>
                                            Remove
                                        </button>
                                    </form>
                                    <p class="text-sm text-zinc-800 font-semibold mt-2">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-zinc-500 bg-white">
                        <p class="text-lg">No items in your cart.</p>
                        <a href="{{ route('customer.home') }}" class="inline-block mt-3 text-zinc-900 font-medium">Continue Shopping</a>
                    </div>
                @endforelse
            </div>
        </div>

        @if($items->count() > 0)
        <div class="lg:w-2/5">
            <div class="lg:sticky lg:top-20 space-y-6">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf

                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm">
                        <h2 class="text-lg font-bold text-zinc-900 mb-3">Delivery & Contact</h2>
                        <div class="space-y-3">
                            <input type="text" name="full_name" placeholder="Full name" class="w-full p-2 border border-zinc-200 rounded text-sm">
                            <input type="text" name="street_address" placeholder="Street, Unit, Bldg" class="w-full p-2 border border-zinc-200 rounded text-sm">
                            <div class="grid grid-cols-2 gap-3">
                                <input type="text" name="city" placeholder="City" class="w-full p-2 border border-zinc-200 rounded text-sm">
                                <input type="text" name="postal_code" placeholder="Postal code" class="w-full p-2 border border-zinc-200 rounded text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm">
                        <h2 class="text-lg font-bold text-zinc-900 mb-3">Payment Method</h2>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 border border-zinc-200 rounded cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" checked class="mr-3">
                                <div>
                                    <div class="font-semibold text-zinc-900">Cash on Delivery</div>
                                    <div class="text-xs text-zinc-500">Pay when you receive the item</div>
                                </div>
                            </label>
                            <label class="flex items-center p-3 border border-zinc-200 rounded bg-zinc-50 opacity-80">
                                <input type="radio" name="payment_method" value="card" disabled class="mr-3">
                                <div>
                                    <div class="font-semibold text-zinc-700">Card (Coming soon)</div>
                                    <div class="text-xs text-zinc-500">Visa / MasterCard</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm">
                        <h2 class="text-lg font-bold text-zinc-900 mb-3">Voucher</h2>
                        <div class="flex gap-2">
                            <input type="text" id="voucher_code" name="voucher" placeholder="Enter voucher code" class="flex-1 p-3 border border-zinc-200 rounded-full text-sm focus:border-zinc-900 focus:ring-0">
                            <button type="button" id="applyVoucher" class="inline-flex items-center gap-2 rounded-full bg-zinc-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-700">
                                <i class="fas fa-ticket text-xs"></i>
                                Apply
                            </button>
                        </div>
                        <p id="voucherMsg" class="text-xs text-zinc-500 mt-2"></p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-zinc-200 shadow-sm">
                        @php
                            $subtotal = $items->sum(fn($i) => $i->product->price * $i->quantity);
                            $shipping = 10.00;
                            $taxRate = 0.05;
                            $tax = $subtotal * $taxRate;
                            $grandTotal = $subtotal + $shipping + $tax;
                        @endphp
                        <div class="flex justify-between text-sm text-zinc-600"><span>Subtotal</span><span>${{ number_format($subtotal,2) }}</span></div>
                        <div class="flex justify-between text-sm text-zinc-600 mt-1"><span>Shipping</span><span>${{ number_format($shipping,2) }}</span></div>
                        <div class="flex justify-between text-sm text-zinc-600 mt-1"><span>Tax</span><span>${{ number_format($tax,2) }}</span></div>
                        <div class="mt-4 pt-4 border-t border-zinc-100 flex items-center justify-between">
                            <div>
                                <div class="text-sm text-zinc-600">Order Total</div>
                                <div class="text-2xl font-black text-zinc-900">${{ number_format($grandTotal,2) }}</div>
                            </div>
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-zinc-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-zinc-700 hover:shadow-md">
                                <i class="fas fa-lock text-xs"></i>
                                Place Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const selectAll = document.getElementById('selectAll');
        const items = document.querySelectorAll('.selectItem');
        if(selectAll){
            selectAll.addEventListener('change', ()=> items.forEach(i=> i.checked = selectAll.checked));
        }

        // Voucher apply (client-side demo)
        document.getElementById('applyVoucher')?.addEventListener('click', function(){
            const code = document.getElementById('voucher_code').value.trim();
            const msg = document.getElementById('voucherMsg');
            if(!code){ msg.textContent = 'Enter a voucher code.'; return; }
            if(code.toUpperCase() === 'KICK10'){
                msg.textContent = 'Voucher applied: 10% off at checkout.';
            } else {
                msg.textContent = 'Voucher not valid.';
            }
        });
    });
</script>

@endsection