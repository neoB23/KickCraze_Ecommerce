@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Brands</h2>
        <p class="text-sm text-slate-500 mt-1">{{ $brands->count() }} brand(s) across your catalog.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-6 rounded-xl shadow-sm">
        <i data-lucide="plus" class="w-4 h-4"></i> Add Product
    </a>
</div>

@if(session('success'))
    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
        <i data-lucide="check-circle" class="w-4 h-4"></i>{{ session('success') }}
    </div>
@endif

@if($brands->isEmpty())
    <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="tag" class="w-8 h-8 text-gray-400"></i>
        </div>
        <p class="font-medium text-slate-700">No brands yet.</p>
        <p class="text-sm text-slate-500 mt-1">Brands appear here automatically when you add products with a brand name.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($brands as $b)
            <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-zinc-900 text-white flex items-center justify-center font-black text-lg">
                            {{ strtoupper(substr($b->brand, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">{{ $b->brand }}</h3>
                            <p class="text-xs text-slate-500">{{ $b->product_count }} product(s)</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.brands.show', $b->brand) }}" class="text-slate-400 hover:text-indigo-600">
                        <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-2 text-center border-t border-gray-50 pt-4">
                    <div>
                        <p class="text-[10px] uppercase text-slate-400 font-bold">Stock</p>
                        <p class="font-bold text-slate-800">{{ number_format($b->total_stock) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-slate-400 font-bold">Avg ₱</p>
                        <p class="font-bold text-slate-800">{{ number_format($b->avg_price, 0) }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-slate-400 font-bold">Range</p>
                        <p class="font-bold text-slate-800 text-xs">{{ number_format($b->min_price, 0) }}–{{ number_format($b->max_price, 0) }}</p>
                    </div>
                </div>

                <form action="{{ route('admin.brands.rename', $b->brand) }}" method="POST" class="mt-4 flex gap-2" onsubmit="return confirm('Rename brand {{ $b->brand }} for all {{ $b->product_count }} products?');">
                    @csrf @method('PATCH')
                    <input type="text" name="new_name" placeholder="Rename brand" class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>
                    <button type="submit" class="px-3 py-2 bg-zinc-900 hover:bg-zinc-950 text-white text-xs font-semibold rounded-lg">Save</button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
