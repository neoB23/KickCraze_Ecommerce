@extends('admin.layout')

@section('content')
<div class="flex flex-col md:flex-row justify-between md:items-center gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Product Inventory</h2>
        <p class="text-sm text-slate-500 mt-1">{{ $products->total() }} total products in catalog.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.brands.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-slate-700 text-sm font-semibold py-2.5 px-5 rounded-xl">
            <i data-lucide="tags" class="w-4 h-4"></i> Brands
        </a>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-6 rounded-xl shadow-sm">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Product
        </a>
    </div>
</div>

@if(session('success'))
    <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
        <i data-lucide="check-circle" class="w-4 h-4"></i>{{ session('success') }}
    </div>
@endif

{{-- Filter bar --}}
<form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-6 grid grid-cols-1 md:grid-cols-4 gap-3">
    <div class="relative md:col-span-2">
        <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or brand..." class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white">
    </div>
    <select name="category" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">All Categories</option>
        @foreach(['Men','Women','Kids','Sale'] as $c)
            <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
        @endforeach
    </select>
    <select name="brand" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <option value="">All Brands</option>
        @foreach($brands as $b)
            <option value="{{ $b }}" @selected(request('brand') === $b)>{{ $b }}</option>
        @endforeach
    </select>
    <div class="md:col-span-4 flex justify-end gap-2">
        @if(request()->hasAny(['search','category','brand']))
            <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-800 px-4 py-2">Clear</a>
        @endif
        <button type="submit" class="inline-flex items-center gap-2 bg-zinc-900 hover:bg-zinc-950 text-white text-sm font-semibold py-2 px-5 rounded-xl">
            <i data-lucide="filter" class="w-4 h-4"></i> Apply Filters
        </button>
    </div>
</form>

{{-- Stat cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @php
        $totalStock = \App\Models\Product::sum('stock');
        $lowStock = \App\Models\Product::where('stock', '<', 10)->count();
        $brandCount = \App\Models\Product::whereNotNull('brand')->distinct('brand')->count('brand');
    @endphp
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <p class="text-xs uppercase font-bold text-slate-400 tracking-wider">Products</p>
        <p class="text-2xl font-black text-slate-800 mt-1">{{ $products->total() }}</p>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <p class="text-xs uppercase font-bold text-slate-400 tracking-wider">Total Stock</p>
        <p class="text-2xl font-black text-slate-800 mt-1">{{ number_format($totalStock) }}</p>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <p class="text-xs uppercase font-bold text-slate-400 tracking-wider">Low Stock</p>
        <p class="text-2xl font-black text-rose-600 mt-1">{{ $lowStock }}</p>
    </div>
    <div class="bg-white border border-gray-100 rounded-2xl p-5">
        <p class="text-xs uppercase font-bold text-slate-400 tracking-wider">Brands</p>
        <p class="text-2xl font-black text-slate-800 mt-1">{{ $brandCount }}</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="text-xs text-slate-500 font-bold border-b border-gray-50 uppercase bg-gray-50/50">
                <tr>
                    <th class="py-4 px-6 font-semibold">Image</th>
                    <th class="py-4 px-6 font-semibold">Product</th>
                    <th class="py-4 px-6 font-semibold">Brand</th>
                    <th class="py-4 px-6 font-semibold">Category</th>
                    <th class="py-4 px-6 font-semibold">Sizes</th>
                    <th class="py-4 px-6 font-semibold">Price</th>
                    <th class="py-4 px-6 font-semibold text-center">Stock</th>
                    <th class="py-4 px-6 font-semibold text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-slate-600 font-medium divide-y divide-gray-50">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="py-4 px-6">
                        @if($product->image)
                            <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" alt="{{ $product->title }}" class="w-14 h-14 object-cover rounded-xl border border-gray-100 shadow-sm">
                        @else
                            <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200">
                                <i data-lucide="box" class="w-6 h-6 text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-bold text-slate-800">{{ $product->title }}</div>
                        @if($product->subcategory)
                            <div class="text-xs text-slate-400 mt-0.5">{{ $product->subcategory }}</div>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-slate-700">{{ $product->brand ?? '—' }}</td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold bg-slate-100 text-slate-700">{{ $product->category }}</span>
                    </td>
                    <td class="py-4 px-6 text-xs text-slate-500">
                        @php $ps = $product->sizes ?? []; @endphp
                        @if(count($ps))
                            {{ implode(', ', array_slice($ps, 0, 4)) }}@if(count($ps) > 4) +{{ count($ps) - 4 }}@endif
                        @else
                            —
                        @endif
                    </td>
                    <td class="py-4 px-6 font-bold text-slate-800">₱{{ number_format($product->price, 2) }}</td>
                    <td class="py-4 px-6 text-center">
                        @if($product->stock < 10)
                            <span class="bg-rose-100/60 text-rose-600 px-3 py-1 rounded-md font-bold text-[11px] inline-flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $product->stock }} Left
                            </span>
                        @else
                            <span class="bg-zinc-100/60 text-zinc-600 px-3 py-1 rounded-md font-bold text-[11px] inline-flex items-center gap-1">
                                <i data-lucide="check-circle" class="w-3 h-3"></i> {{ $product->stock }}
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100" title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100" title="Delete">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-12 px-6 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="package-x" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <p class="font-medium">No products found.</p>
                            <p class="text-sm mt-1">Try adjusting filters or add a new product.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-50">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
