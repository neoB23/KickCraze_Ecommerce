@extends('admin.layout')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.brands.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-slate-600">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h2 class="text-2xl font-bold text-slate-800">{{ $brand }}</h2>
        <p class="text-sm text-slate-500">{{ $products->total() }} product(s) under this brand.</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="text-xs text-slate-500 font-bold border-b border-gray-50 uppercase bg-gray-50/50">
                <tr>
                    <th class="py-4 px-6">Image</th>
                    <th class="py-4 px-6">Title</th>
                    <th class="py-4 px-6">Category</th>
                    <th class="py-4 px-6">Price</th>
                    <th class="py-4 px-6 text-center">Stock</th>
                    <th class="py-4 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-slate-600 font-medium divide-y divide-gray-50">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-4 px-6">
                            @if($product->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" class="w-14 h-14 object-cover rounded-xl border border-gray-100">
                            @endif
                        </td>
                        <td class="py-4 px-6 font-bold text-slate-800">{{ $product->title }}</td>
                        <td class="py-4 px-6">{{ $product->category }}</td>
                        <td class="py-4 px-6">₱{{ number_format($product->price, 2) }}</td>
                        <td class="py-4 px-6 text-center">{{ $product->stock }}</td>
                        <td class="py-4 px-6 text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 inline-block">
                                <i data-lucide="edit-2" class="w-4 h-4"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-50">{{ $products->links() }}</div>
    @endif
</div>
@endsection
