@props([
    'clearRoute' => 'mens',
])

<div class="bg-white border border-dashed border-zinc-300 rounded-3xl py-20 text-center">
    <div class="max-w-md mx-auto px-6">
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-zinc-100 flex items-center justify-center">
            <svg class="w-8 h-8 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
        </div>
        <h3 class="text-2xl font-black uppercase tracking-tight text-zinc-950 mb-2">No matches</h3>
        <p class="text-sm text-zinc-500 mb-6">
            Nothing fits your current filters. Try removing a few, or browse the full collection.
        </p>
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route($clearRoute) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-zinc-950 text-white text-[11px] font-black uppercase tracking-[0.25em] hover:bg-zinc-800 transition">
                Clear Filters
            </a>
            <a href="{{ route('customer.home') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-zinc-200 text-zinc-700 text-[11px] font-black uppercase tracking-[0.25em] hover:border-zinc-950 hover:text-zinc-950 transition">
                Back Home
            </a>
        </div>
    </div>
</div>
