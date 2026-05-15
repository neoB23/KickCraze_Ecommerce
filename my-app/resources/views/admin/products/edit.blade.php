@extends('admin.layout')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.products.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 text-slate-600 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Edit Product</h2>
            <p class="text-sm text-slate-500">{{ $product->title }}</p>
        </div>
    </div>

    @if($errors->any())
        <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl p-4">
            <p class="font-semibold mb-1 flex items-center gap-2"><i data-lucide="alert-triangle" class="w-4 h-4"></i> Please fix the errors below:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php $selectedSizes = old('sizes', $product->sizes ?? []); @endphp

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf @method('PUT')

        <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Product Title</label>
                <input type="text" name="title" value="{{ old('title', $product->title) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" list="brand-list" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>
                    <datalist id="brand-list">
                        <option value="Nike"><option value="Adidas"><option value="Puma"><option value="New Balance"><option value="Reebok"><option value="Vans"><option value="Converse"><option value="Asics"><option value="Jordan"><option value="Under Armour">
                    </datalist>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Gender / Category</label>
                    <div class="relative">
                        <select name="category" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white appearance-none" required>
                            @foreach(['Men','Women','Kids','Sale'] as $opt)
                                <option value="{{ $opt }}" @selected(old('category', $product->category) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Subcategory</label>
                    <div class="relative">
                        <select name="subcategory" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white appearance-none">
                            <option value="">— None —</option>
                            @foreach($subcategories as $sub)
                                <option value="{{ $sub }}" @selected(old('subcategory', $product->subcategory) === $sub)>{{ $sub }}</option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Price (₱)</label>
                    <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Stock</label>
                    <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Available Sizes</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($sizes as $size)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}" class="peer sr-only" @checked(is_array($selectedSizes) && in_array($size, $selectedSizes))>
                            <span class="inline-flex items-center justify-center min-w-[3rem] px-3 py-2 text-sm font-semibold rounded-lg border border-gray-200 bg-gray-50 text-slate-700 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 hover:bg-gray-100 transition-colors">
                                US {{ $size }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white" required>{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Main Product Image</label>
                <div class="aspect-square bg-gray-50 border border-gray-200 rounded-xl flex items-center justify-center mb-3 overflow-hidden">
                    @if($product->image)
                        <img id="image-preview" src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" class="w-full h-full object-cover" />
                    @else
                        <img id="image-preview" class="hidden w-full h-full object-cover" />
                        <div id="image-placeholder" class="text-center text-gray-400 px-4">
                            <i data-lucide="image" class="w-10 h-10 mx-auto mb-2"></i>
                            <p class="text-xs font-medium">No image</p>
                        </div>
                    @endif
                </div>
                <input type="file" name="image" accept="image/*" id="image-input" class="w-full text-xs file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                <p class="text-xs text-slate-400 mt-2">Leave empty to keep the current image.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Gallery Images <span class="text-xs text-slate-400 font-normal">(side / hover thumbnails)</span></label>

                @if($product->images->isNotEmpty())
                    <div class="grid grid-cols-3 gap-2 mb-3">
                        @foreach($product->images as $img)
                            <label class="relative aspect-square bg-gray-50 rounded-lg overflow-hidden border border-gray-200 cursor-pointer block group">
                                <img src="{{ route('product.gallery.image', $img->id) }}" class="w-full h-full object-cover" />
                                <input type="checkbox" name="remove_gallery[]" value="{{ $img->id }}" class="peer absolute top-1 right-1 w-4 h-4 accent-rose-600">
                                <span class="absolute inset-0 bg-rose-600/70 opacity-0 peer-checked:opacity-100 flex items-center justify-center text-white text-xs font-bold uppercase tracking-wider pointer-events-none">Remove</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="text-xs text-slate-400 mb-2">Tick the box to remove an existing image on save.</p>
                @endif

                <div id="gallery-preview" class="grid grid-cols-3 gap-2 mb-3"></div>
                <input type="file" name="gallery_images[]" accept="image/*" id="gallery-input" multiple class="w-full text-xs file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                <p class="text-xs text-slate-400 mt-2">Add more angles — they appear beside the main image.</p>
            </div>

            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-zinc-900 hover:bg-zinc-950 text-white text-sm font-semibold py-3 px-8 rounded-xl shadow-md">
                <i data-lucide="save" class="w-4 h-4"></i> Update Product
            </button>
            <a href="{{ route('admin.products.index') }}" class="w-full inline-flex items-center justify-center gap-2 bg-white border border-gray-200 hover:bg-gray-50 text-slate-700 text-sm font-semibold py-3 px-8 rounded-xl">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
document.getElementById('image-input')?.addEventListener('change', function (e) {
    const file = e.target.files?.[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    const img = document.getElementById('image-preview');
    img.src = url;
    img.classList.remove('hidden');
    document.getElementById('image-placeholder')?.classList.add('hidden');
});

document.getElementById('gallery-input')?.addEventListener('change', function (e) {
    const wrap = document.getElementById('gallery-preview');
    wrap.innerHTML = '';
    const files = Array.from(e.target.files || []).slice(0, 6);
    files.forEach(file => {
        const div = document.createElement('div');
        div.className = 'aspect-square bg-gray-50 rounded-lg overflow-hidden border border-indigo-200';
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = 'w-full h-full object-cover';
        div.appendChild(img);
        wrap.appendChild(div);
    });
});
</script>
@endsection
