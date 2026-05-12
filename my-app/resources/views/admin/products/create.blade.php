@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-slate-600 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <h2 class="text-2xl font-bold text-slate-800">Add New Product</h2>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Title --}}
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Title</label>
                <input type="text" name="title" placeholder="e.g. Nike Air Max" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Category</label>
                <div class="relative">
                    <select name="category" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white appearance-none transition-colors" required>
                        <option value="" disabled selected>Select Category</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Kids">Kids</option>
                        <option value="Sale">Sale</option>
                    </select>
                    <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Price (₱)</label>
                <input type="number" step="0.01" name="price" placeholder="0.00" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Stock --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Initial Stock</label>
                <input type="number" name="stock" placeholder="0" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required>
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Image</label>
                <input type="file" name="image" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-colors" required>
            </div>

            {{-- Description --}}
            <div class="col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="4" placeholder="Enter product description..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors" required></textarea>
            </div>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-3 px-8 rounded-xl transition-colors shadow-md">
                <i data-lucide="check-circle" class="w-4 h-4"></i> Save Product
            </button>
        </div>
    </form>
</div>
@endsection