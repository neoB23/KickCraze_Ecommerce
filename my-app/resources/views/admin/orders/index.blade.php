@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Order Management</h2>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="text-xs text-slate-500 font-bold border-b border-gray-50 uppercase bg-gray-50/50">
                <tr>
                    <th class="py-4 px-6 font-semibold">Product</th>
                    <th class="py-4 px-6 font-semibold">Customer</th>
                    <th class="py-4 px-6 font-semibold text-center">Quantity</th>
                    <th class="py-4 px-6 font-semibold text-center">Status</th>
                    <th class="py-4 px-6 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-slate-600 font-medium divide-y divide-gray-50">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 px-6 font-bold text-slate-800">
                        {{ $order->product->title ?? 'N/A (Product Removed)' }}
                    </td>
                    <td class="py-4 px-6 text-slate-500 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">
                            {{ substr($order->user->name ?? '?', 0, 1) }}
                        </div>
                        {{ $order->user->name ?? 'N/A (User Removed)' }}
                    </td>
                    <td class="py-4 px-6 text-center text-slate-800 font-bold">
                        {{ $order->quantity ?? 1 }}
                    </td>
                    <td class="py-4 px-6 text-center">
                        @php
                            $badgeStyle = match($order->status) {
                                'Delivered' => 'bg-zinc-100/60 text-zinc-600',
                                'Pending' => 'bg-yellow-100/60 text-yellow-600',
                                'Cancelled' => 'bg-rose-100/60 text-rose-600',
                                default => 'bg-gray-100/60 text-gray-600',
                            };
                            $iconString = match($order->status) {
                                'Delivered' => 'check-circle',
                                'Pending' => 'clock',
                                'Cancelled' => 'x-circle',
                                default => 'help-circle',
                            };
                        @endphp
                        <span class="{{ $badgeStyle }} px-3 py-1.5 rounded-md font-bold text-[11px] inline-flex items-center gap-1.5">
                            <i data-lucide="{{ $iconString }}" class="w-3 h-3"></i> {{ $order->status }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="flex items-center justify-center gap-2">
                            @csrf
                            @method('PATCH')
                            <div class="relative">
                                <select name="status" class="appearance-none bg-gray-50 border border-gray-200 text-slate-700 py-1.5 pl-3 pr-8 rounded-lg text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                                    <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-3 h-3 absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
                            </div>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-1.5 rounded-lg transition-colors shadow-sm" title="Update Status">
                                <i data-lucide="save" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 px-6 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="inbox" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <p class="font-medium">No orders found.</p>
                            <p class="text-sm mt-1">Waiting for users to place their first order.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
