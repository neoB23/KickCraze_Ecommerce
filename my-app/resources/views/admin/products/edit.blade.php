@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-slate-600 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Edit Product</h2>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        @csrf
        @method('PUT')
        
        <div class="flex items-center gap-6 mb-8 pb-6 border-b border-gray-100">
            @if($product->image)
                <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" class="w-24 h-24 object-cover rounded-xl border border-gray-200 shadow-sm" alt="Current Image">
            @else
                <div class="w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200">
                    <i data-lucide="image" class="w-8 h-8 text-gray-400"></i>
                </div>
            @endif
            <div>
                <h3 class="font-bold text-slate-800">{{ $product->title }}</h3>
                <p class="text-sm text-slate-500">Current Product Image</p>
                <div class="mt-2">
                    <label class="text-xs font-semibold bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded-lg cursor-pointer hover:bg-indigo-100 transition-colors">
                        Upload New Image
                        <input type="file" name="image" class="hidden">
                    </label>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Title --}}
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Title</label>
                <input type="text" name="title" value="{{ $product->title }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                <div class="relative">
                    <select name="category" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white appearance-none transition-colors" required>
                        <option value="Men" {{ $product->category == 'Men' ? 'selected' : '' }}>Men</option>
                        <option value="Women" {{ $product->category == 'Women' ? 'selected' : '' }}>Women</option>
                        <option value="Kids" {{ $product->category == 'Kids' ? 'selected' : '' }}>Kids</option>
                        <option value="Sale" {{ $product->category == 'Sale' ? 'selected' : '' }}>Sale</option>
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Price (₱)</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Stock --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Stock Level</label>
                <input type="number" name="stock" value="{{ $product->stock }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Description --}}
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>{{ $product->description }}</textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-slate-700 text-sm font-semibold py-3 px-6 rounded-xl transition-colors">
                Cancel
            </a>
            <button type="submit" class="inline-flex items-center gap-2 bg-zinc-900 hover:bg-zinc-950 text-white text-sm font-semibold py-3 px-8 rounded-xl transition-colors shadow-md">
                <i data-lucide="save" class="w-4 h-4"></i> Update Product
            </button>
        </div>
    </form>
</div>
@endsection
