@props([
    'count' => 0,
    'totalCount' => 0,
])

@php
    $params = request()->query();

    $chips = [];

    if ($s = request('search')) {
        $chips[] = ['label' => 'Search: "' . $s . '"', 'remove' => 'search'];
    }
    foreach ((array) request('brand', []) as $b) {
        $chips[] = ['label' => $b, 'remove' => 'brand', 'value' => $b];
    }
    foreach ((array) request('subcategory', []) as $s) {
        $chips[] = ['label' => $s, 'remove' => 'subcategory', 'value' => $s];
    }
    foreach ((array) request('size', []) as $sz) {
        $chips[] = ['label' => 'Size US ' . $sz, 'remove' => 'size', 'value' => $sz];
    }
    if ($min = request('min_price')) {
        $chips[] = ['label' => 'Min ₱' . number_format((int) $min), 'remove' => 'min_price'];
    }
    if ($max = request('max_price')) {
        $chips[] = ['label' => 'Max ₱' . number_format((int) $max), 'remove' => 'max_price'];
    }

    $buildRemoveUrl = function ($key, $value = null) use ($params) {
        $q = $params;
        if ($value !== null && isset($q[$key]) && is_array($q[$key])) {
            $q[$key] = array_values(array_filter($q[$key], fn($v) => $v != $value));
            if (empty($q[$key])) {
                unset($q[$key]);
            }
        } else {
            unset($q[$key]);
        }
        return url()->current() . (!empty($q) ? '?' . http_build_query($q) : '');
    };
@endphp

<div class="flex flex-wrap items-center gap-3 mb-6">

    {{-- Result count pill --}}
    <div class="inline-flex items-baseline gap-2 px-4 py-2.5 bg-white border border-zinc-200 rounded-full shadow-sm">
        <span class="text-lg font-black text-zinc-950 leading-none">{{ $count }}</span>
        <span class="text-xs text-zinc-500 font-medium">of {{ $totalCount }} pairs</span>
    </div>

    {{-- Active chips (flow inline with count) --}}
    @foreach($chips as $chip)
        <a href="{{ $buildRemoveUrl($chip['remove'], $chip['value'] ?? null) }}"
           class="inline-flex items-center gap-1.5 pl-3 pr-2 py-2 bg-zinc-950 text-white rounded-full text-[11px] font-bold hover:bg-zinc-800 transition group">
            {{ $chip['label'] }}
            <span class="w-4 h-4 inline-flex items-center justify-center rounded-full bg-white/15 group-hover:bg-white/30 transition">
                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </span>
        </a>
    @endforeach

    @if(count($chips))
        <a href="{{ url()->current() }}" class="text-[10px] font-black uppercase tracking-[0.25em] text-zinc-500 hover:text-zinc-950 transition">
            Clear all
        </a>
    @endif

    {{-- Spacer pushes the right group to the edge --}}
    <div class="ml-auto flex items-center gap-2">
        {{-- Sort --}}
        <form method="GET" class="relative">
            @foreach($params as $k => $v)
                @if($k === 'sort') @continue @endif
                @if(is_array($v))
                    @foreach($v as $vv)
                        <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endif
            @endforeach
            <select name="sort" onchange="this.form.submit()"
                    class="appearance-none pl-9 pr-8 py-2.5 text-xs font-bold text-zinc-900 bg-white border border-zinc-200 rounded-full focus:outline-none focus:ring-2 focus:ring-zinc-950 hover:border-zinc-400 transition cursor-pointer shadow-sm">
                <option value="latest"     @selected(request('sort','latest')==='latest')>Newest</option>
                <option value="price_asc"  @selected(request('sort')==='price_asc')>Price: Low to High</option>
                <option value="price_desc" @selected(request('sort')==='price_desc')>Price: High to Low</option>
                <option value="rating"     @selected(request('sort')==='rating')>Top Rated</option>
            </select>
            <svg class="w-3.5 h-3.5 absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-500 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
            </svg>
            <svg class="w-3 h-3 absolute right-3 top-1/2 -translate-y-1/2 text-zinc-500 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </form>

        {{-- Grid density toggle --}}
        <div class="hidden md:flex items-center gap-1 bg-white border border-zinc-200 rounded-full p-1 shadow-sm" id="gridToggle">
            <button type="button" data-cols="3" class="grid-btn w-9 h-9 rounded-full inline-flex items-center justify-center text-zinc-500 hover:text-zinc-900 transition" title="3 columns">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="6" height="6" rx="1.5"/><rect x="15" y="3" width="6" height="6" rx="1.5"/>
                    <rect x="3" y="15" width="6" height="6" rx="1.5"/><rect x="15" y="15" width="6" height="6" rx="1.5"/>
                </svg>
            </button>
            <button type="button" data-cols="4" class="grid-btn w-9 h-9 rounded-full inline-flex items-center justify-center text-zinc-500 hover:text-zinc-900 transition" title="4 columns">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="4" height="4" rx="1"/><rect x="9" y="3" width="4" height="4" rx="1"/><rect x="15" y="3" width="4" height="4" rx="1"/>
                    <rect x="3" y="9" width="4" height="4" rx="1"/><rect x="9" y="9" width="4" height="4" rx="1"/><rect x="15" y="9" width="4" height="4" rx="1"/>
                    <rect x="3" y="15" width="4" height="4" rx="1"/><rect x="9" y="15" width="4" height="4" rx="1"/><rect x="15" y="15" width="4" height="4" rx="1"/>
                </svg>
            </button>
        </div>
    </div>
</div>
