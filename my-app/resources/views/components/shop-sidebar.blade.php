@props([
    'filterOptions' => [],
    'category'      => '',
])

@php
    $brands        = $filterOptions['brands'] ?? collect();
    $subcategories = $filterOptions['subcategories'] ?? collect();
    $sizes         = $filterOptions['sizes'] ?? collect();
    $totalCount    = $filterOptions['totalCount'] ?? 0;

    $selectedBrands = (array) request('brand', []);
    $selectedSubs   = (array) request('subcategory', []);
    $selectedSizes  = (array) request('size', []);

    $activeFilterCount = count($selectedBrands) + count($selectedSubs) + count($selectedSizes)
        + (request('search') ? 1 : 0)
        + (request('min_price') ? 1 : 0)
        + (request('max_price') ? 1 : 0);
@endphp

<aside class="w-full lg:w-72 lg:flex-shrink-0">
    <form method="GET" action="" id="shop-filter-form" class="bg-white border border-zinc-200 rounded-2xl overflow-hidden shadow-xl shadow-zinc-200/40 lg:sticky lg:top-24">

        {{-- Dark header --}}
        <div class="bg-zinc-950 text-white p-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500">— Filter</span>
                @if($activeFilterCount > 0)
                    <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-2 bg-white text-zinc-950 text-[10px] font-black rounded-full">{{ $activeFilterCount }}</span>
                @endif
            </div>
            <h2 class="text-2xl font-black uppercase tracking-tighter leading-[0.95]">
                {{ $category }}
            </h2>
            <p class="text-[11px] text-zinc-400 mt-2 font-medium">
                <span class="font-black text-white">{{ $totalCount }}</span> pairs available
            </p>
        </div>

        <div class="p-6 space-y-6">

            {{-- Search --}}
            <div>
                <label class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-700 mb-2 block">Search</label>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Brand, model..." class="w-full pl-10 pr-3 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:bg-white transition">
                </div>
            </div>

            {{-- Subcategories --}}
            @if($subcategories->count())
            <details open class="group border-t border-zinc-100 pt-5">
                <summary class="flex items-center justify-between cursor-pointer list-none mb-3">
                    <span class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-900">Category</span>
                    <svg class="w-4 h-4 text-zinc-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="space-y-2">
                    @foreach($subcategories as $sub)
                        <label class="flex items-center gap-2.5 cursor-pointer text-sm text-zinc-700 hover:text-zinc-950 transition-colors">
                            <input type="checkbox" name="subcategory[]" value="{{ $sub }}" @checked(in_array($sub, $selectedSubs)) class="w-4 h-4 rounded border-zinc-300 text-zinc-950 focus:ring-zinc-950 focus:ring-offset-0">
                            {{ $sub }}
                        </label>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- Brand --}}
            @if($brands->count())
            <details open class="group border-t border-zinc-100 pt-5">
                <summary class="flex items-center justify-between cursor-pointer list-none mb-3">
                    <span class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-900">Brand</span>
                    <svg class="w-4 h-4 text-zinc-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="space-y-2 max-h-48 overflow-y-auto pr-1">
                    @foreach($brands as $brand)
                        <label class="flex items-center gap-2.5 cursor-pointer text-sm text-zinc-700 hover:text-zinc-950 transition-colors">
                            <input type="checkbox" name="brand[]" value="{{ $brand }}" @checked(in_array($brand, $selectedBrands)) class="w-4 h-4 rounded border-zinc-300 text-zinc-950 focus:ring-zinc-950 focus:ring-offset-0">
                            {{ $brand }}
                        </label>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- Size --}}
            @if($sizes->count())
            <details open class="group border-t border-zinc-100 pt-5">
                <summary class="flex items-center justify-between cursor-pointer list-none mb-3">
                    <span class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-900">Size (US)</span>
                    <svg class="w-4 h-4 text-zinc-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($sizes as $size)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="size[]" value="{{ $size }}" @checked(in_array($size, $selectedSizes)) class="peer sr-only">
                            <span class="block text-center text-xs font-bold py-2.5 rounded-lg border border-zinc-200 bg-white text-zinc-700 peer-checked:bg-zinc-950 peer-checked:text-white peer-checked:border-zinc-950 hover:border-zinc-900 transition-all">
                                {{ $size }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </details>
            @endif

            {{-- Price --}}
            <details open class="group border-t border-zinc-100 pt-5">
                <summary class="flex items-center justify-between cursor-pointer list-none mb-3">
                    <span class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-900">Price (₱)</span>
                    <svg class="w-4 h-4 text-zinc-400 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="flex items-center gap-2">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" min="0" class="w-full px-3 py-2 bg-zinc-50 border border-zinc-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:bg-white transition">
                    <span class="text-zinc-300 text-xs">—</span>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" min="0" class="w-full px-3 py-2 bg-zinc-50 border border-zinc-200 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:bg-white transition">
                </div>
            </details>

            {{-- Sort --}}
            <div class="border-t border-zinc-100 pt-5">
                <label class="text-[10px] uppercase font-black tracking-[0.25em] text-zinc-900 mb-2 block">Sort By</label>
                <select name="sort" class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:bg-white transition">
                    <option value="latest"     @selected(request('sort','latest')==='latest')>Newest</option>
                    <option value="price_asc"  @selected(request('sort')==='price_asc')>Price: Low to High</option>
                    <option value="price_desc" @selected(request('sort')==='price_desc')>Price: High to Low</option>
                    <option value="rating"     @selected(request('sort')==='rating')>Top Rated</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="border-t border-zinc-100 pt-5 space-y-2">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-zinc-950 hover:bg-zinc-800 text-white text-xs font-black py-3.5 rounded-xl uppercase tracking-[0.25em] transition-colors shadow-lg shadow-zinc-900/20">
                    Apply Filters
                </button>
                @if($activeFilterCount > 0)
                    <a href="{{ url()->current() }}" class="w-full block text-center text-[10px] font-bold text-zinc-500 hover:text-zinc-950 uppercase tracking-widest py-2 transition-colors">
                        Clear All Filters
                    </a>
                @endif
            </div>
        </div>
    </form>
</aside>
