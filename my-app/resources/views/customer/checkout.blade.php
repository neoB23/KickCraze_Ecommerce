@vite('resources/css/app.css')
@section('title', 'KickCraze - Checkout')
@section('content')

<div class="w-full max-w-none py-12 px-4 sm:px-6 lg:px-10 xl:px-12">
    <h1 class="text-3xl font-black text-zinc-900 mb-6">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-zinc-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-zinc-900 mb-4">Shipping Address</h2>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="full_name" placeholder="Full name" class="p-2 border border-zinc-200 rounded">
                        <input type="text" name="phone" placeholder="Phone" class="p-2 border border-zinc-200 rounded">
                        <input type="text" name="street" placeholder="Street, Unit, Building" class="p-2 border border-zinc-200 rounded col-span-2">
                        <input type="text" name="city" placeholder="City" class="p-2 border border-zinc-200 rounded">
                        <input type="text" name="postal_code" placeholder="Postal code" class="p-2 border border-zinc-200 rounded">
                    </div>

                    <h3 class="mt-6 text-sm font-semibold text-zinc-700">Add voucher</h3>
                    <div class="flex gap-2 mt-2">
                        <input type="text" name="voucher" id="checkout_voucher" placeholder="Voucher code" class="flex-1 p-2 border border-zinc-200 rounded">
                        <button type="button" id="checkoutApplyVoucher" class="px-4 py-2 bg-zinc-900 text-white rounded">Apply</button>
                    </div>

                    <h3 class="mt-6 text-lg font-semibold text-zinc-900">Payment Method</h3>
                    <div class="mt-2 space-y-2">
                        <label class="flex items-center p-3 border border-zinc-200 rounded">
                            <input type="radio" name="payment_method" value="cod" checked class="mr-3"> <span class="font-medium">Cash on Delivery</span>
                        </label>
                        <label class="flex items-center p-3 border border-zinc-200 rounded bg-zinc-50 opacity-80">
                            <input type="radio" name="payment_method" value="card" disabled class="mr-3"> <span class="font-medium text-zinc-700">Card (Coming soon)</span>
                        </label>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <a href="{{ route('customer.home') }}" class="text-sm text-zinc-600">Continue shopping</a>
                        <button type="submit" class="px-6 py-3 bg-zinc-900 text-white rounded-lg font-semibold">Confirm & Pay</button>
                    </div>

                </form>
            </div>
        </div>

        <aside class="bg-white rounded-2xl border border-zinc-200 p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-zinc-900 mb-4">Order Summary</h3>
            @php
                $subtotal = $cart->sum(fn($c) => $c['price'] * $c['quantity']);
                $shipping = 10.00;
                $tax = $subtotal * 0.05;
                $total = $subtotal + $shipping + $tax;
            @endphp
            <div class="space-y-2 text-sm text-zinc-700">
                <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($subtotal,2) }}</span></div>
                <div class="flex justify-between"><span>Shipping</span><span>${{ number_format($shipping,2) }}</span></div>
                <div class="flex justify-between"><span>Tax</span><span>${{ number_format($tax,2) }}</span></div>
            </div>
            <div class="mt-4 border-t pt-4 text-zinc-900 font-black text-xl flex justify-between">
                <span>Total</span><span>${{ number_format($total,2) }}</span>
            </div>
        </aside>
    </div>

    <script>
        document.getElementById('checkoutApplyVoucher')?.addEventListener('click', function(){
            const code = document.getElementById('checkout_voucher').value.trim();
            if(!code) return alert('Enter voucher');
            if(code.toUpperCase() === 'KICK10') alert('Voucher applied: 10% discount'); else alert('Voucher invalid');
        });
    </script>

@endsection
