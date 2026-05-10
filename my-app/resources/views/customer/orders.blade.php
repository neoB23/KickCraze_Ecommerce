@include('components.lastnav')
@vite('resources/css/app.css')

@extends('layout.app')
@section('title', 'KickCraze | Order History')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

{{-- Header Section --}}
<div class="bg-zinc-950 pt-16 pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 text-sm text-zinc-400 mb-4 tracking-wider uppercase">
            <a href="{{ route('customer.home') }}" class="hover:text-white transition">Home</a>
            <span>/</span>
            <span class="text-white">My Orders</span>
        </div>
        <h1 class="text-5xl sm:text-6xl font-black text-white tracking-tight">ORDER HISTORY</h1>
        <p class="mt-4 text-zinc-400 max-w-xl text-sm sm:text-base">Track your orders and manage your delivery status in one place.</p>
    </div>
</div>

{{-- Main Content --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 pb-24">
    <div class="space-y-6">
    
    <div class="space-y-6">
        @forelse($orders as $order)
            {{-- Order Card --}}
            <div class="bg-white rounded-2xl shadow-xl shadow-zinc-200/50 border border-zinc-200/60 overflow-hidden hover:shadow-2xl hover:shadow-zinc-200 transition-all duration-300 relative group">
                
                {{-- Accent Bar --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-zinc-800 to-zinc-950 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                {{-- Header Section --}}
                <div class="p-6 sm:p-8 border-b border-zinc-100/60">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="grid grid-cols-3 gap-6 sm:gap-10 flex-1">
                            <div>
                                <span class="block text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2">Order Placed</span>
                                <span class="block text-lg font-black text-zinc-900">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2">Order ID</span>
                                <span class="block text-lg font-black text-zinc-900">#{{ $order->id }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2">Total Paid</span>
                                <span class="block text-xl font-black text-zinc-900">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>

                        {{-- Status Badge --}}
                        <div>
                            @php
                                $status = strtolower($order->status);
                                $statusClasses = [
                                    'delivered' => 'bg-green-50 text-green-700 border-green-200',
                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'shipped' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                                ];
                                $badgeClass = $statusClasses[$status] ?? 'bg-zinc-100 text-zinc-700 border-zinc-200';
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-black tracking-widest border {{ $badgeClass }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Product Preview --}}
                <div class="p-6 sm:p-8">
                    <div class="flex items-start gap-6">
                        
                        {{-- Product Image --}}
                        <div class="relative overflow-hidden rounded-xl border border-zinc-200 shrink-0 w-24 h-24 sm:w-28 sm:h-28 bg-zinc-50">
                            @if(isset($order->product) && $order->product && $order->product->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($order->product->image) }}"
                                    alt="{{ $order->product->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-zinc-100">
                                    <i class="fas fa-shoe-prints text-2xl text-zinc-400"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 ring-1 ring-inset ring-black/5 rounded-xl pointer-events-none"></div>
                        </div>

                        {{-- Product Details --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg sm:text-xl font-black text-zinc-900 truncate group-hover:text-black transition">
                                {{ optional($order->product)->title ?? 'Order Item' }}
                            </h3>
                            <p class="text-sm text-zinc-600 font-medium mt-1">
                                <span class="font-black">Qty:</span> {{ $order->quantity ?? 1 }}
                            </p>
                            
                            <div class="flex items-center gap-2 mt-4">
                                @php
                                    $statusIcon = [
                                        'delivered' => ['icon' => 'fa-check-circle', 'color' => 'text-green-600'],
                                        'pending' => ['icon' => 'fa-clock', 'color' => 'text-amber-600'],
                                        'shipped' => ['icon' => 'fa-truck', 'color' => 'text-blue-600'],
                                        'cancelled' => ['icon' => 'fa-x-circle', 'color' => 'text-red-600'],
                                    ];
                                    $icon = $statusIcon[$status] ?? ['icon' => 'fa-info-circle', 'color' => 'text-zinc-600'];
                                @endphp
                                <i class="fas {{ $icon['icon'] }} {{ $icon['color'] }} text-sm"></i>
                                <span class="text-xs font-bold text-zinc-600 uppercase tracking-wider">
                                    @if($status === 'delivered')
                                        Delivered on {{ optional($order->delivered_at)->format('M d, Y') ?? 'Date pending' }}
                                    @elseif($status === 'pending')
                                        Awaiting confirmation
                                    @elseif($status === 'shipped')
                                        On the way
                                    @else
                                        Order cancelled
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- Action Button --}}
                        <div class="shrink-0">
                            <a href="#" class="inline-flex items-center justify-center w-12 h-12 rounded-full border border-zinc-200 hover:border-zinc-900 hover:bg-zinc-900 text-zinc-600 hover:text-white transition-all duration-200 group/btn">
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-zinc-200/50 border border-zinc-200/60 p-12 sm:p-20 text-center">
                <div class="w-24 h-24 bg-zinc-100 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-bag-shopping text-5xl text-zinc-400"></i>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-zinc-900 tracking-tight mb-3">NO ORDERS YET</h2>
                <p class="text-zinc-600 text-lg mb-10 max-w-md mx-auto font-medium">You haven't placed any orders yet. Start shopping and your orders will appear here!</p>
                <a href="{{ route('customer.home') }}" class="inline-flex items-center justify-center px-10 py-4 text-sm font-black text-white bg-zinc-950 rounded-xl hover:bg-zinc-800 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 active:translate-y-0 uppercase tracking-widest">
                    <i class="fas fa-shoe-prints mr-2"></i> Start Shopping
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection