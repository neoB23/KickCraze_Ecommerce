@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-slate-800">Product Inventory</h2>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2.5 px-6 rounded-xl transition-colors shadow-sm">
        <i data-lucide="plus" class="w-4 h-4"></i> Add New Product
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="text-xs text-slate-500 font-bold border-b border-gray-50 uppercase bg-gray-50/50">
                <tr>
                    <th class="py-4 px-6 font-semibold"><i data-lucide="image" class="w-4 h-4 inline mr-2 text-slate-400"></i>Image</th>
                    <th class="py-4 px-6 font-semibold">Title</th>
                    <th class="py-4 px-6 font-semibold">Category</th>
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
                    <td class="py-4 px-6 font-bold text-slate-800">{{ $product->title }}</td>
                    <td class="py-4 px-6 text-slate-500">{{ $product->category }}</td>
                    <td class="py-4 px-6 font-bold text-slate-800">₱{{ number_format($product->price, 2) }}</td>
                    <td class="py-4 px-6 text-center">
                        @if($product->stock < 10)
                            <span class="bg-rose-100/60 text-rose-600 px-3 py-1 rounded-md font-bold text-[11px] inline-flex items-center gap-1">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $product->stock }} Left
                            </span>
                        @else
                            <span class="bg-zinc-100/60 text-zinc-600 px-3 py-1 rounded-md font-bold text-[11px] inline-flex items-center gap-1">
                                <i data-lucide="check-circle" class="w-3 h-3"></i> {{ $product->stock }} In Stock
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors" title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors" title="Delete">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 px-6 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i data-lucide="package-x" class="w-8 h-8 text-gray-400"></i>
                            </div>
                            <p class="font-medium">No products found.</p>
                            <p class="text-sm mt-1">Start by adding a new product to your inventory.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
