@props([
    'index' => '01',
    'eyebrow' => 'Collection',
    'title' => '',
    'subtitle' => '',
    'description' => '',
    'totalCount' => 0,
    'accent' => 'zinc',
])

@php
    $accentMap = [
        'zinc'  => ['bg' => 'bg-zinc-950',  'muted' => 'text-zinc-400', 'numeral' => 'text-white/[0.08]', 'line' => 'from-white via-zinc-400 to-zinc-700', 'dot' => 'bg-emerald-400'],
        'rose'  => ['bg' => 'bg-zinc-950',  'muted' => 'text-rose-200/70', 'numeral' => 'text-rose-500/15', 'line' => 'from-rose-200 via-rose-400 to-rose-700', 'dot' => 'bg-rose-400'],
        'amber' => ['bg' => 'bg-zinc-950',  'muted' => 'text-amber-200/70','numeral' => 'text-amber-500/15','line' => 'from-amber-200 via-amber-400 to-amber-700', 'dot' => 'bg-amber-400'],
        'blue'  => ['bg' => 'bg-zinc-950',  'muted' => 'text-blue-200/70', 'numeral' => 'text-blue-500/15', 'line' => 'from-blue-200 via-blue-400 to-blue-700', 'dot' => 'bg-blue-400'],
    ];
    $a = $accentMap[$accent] ?? $accentMap['zinc'];
@endphp

<section class="relative {{ $a['bg'] }} text-white overflow-hidden rounded-3xl mb-8 ring-1 ring-white/5">

    {{-- Grid pattern overlay --}}
    <div class="absolute inset-0 opacity-[0.08] pointer-events-none"
         style="background-image: linear-gradient(to right, white 1px, transparent 1px), linear-gradient(to bottom, white 1px, transparent 1px); background-size: 56px 56px;"></div>

    {{-- Glow --}}
    <div class="absolute -top-20 -left-20 w-[420px] h-[420px] bg-white/[0.06] rounded-full blur-[120px] pointer-events-none"></div>

    {{-- Giant numeral on the right --}}
    <div aria-hidden="true"
         class="absolute right-0 top-0 bottom-0 hidden md:flex items-center pr-6 lg:pr-12 pointer-events-none select-none">
        <span class="{{ $a['numeral'] }} font-black leading-none tracking-tighter"
              style="font-size: clamp(14rem, 28vw, 26rem); -webkit-text-stroke: 1px rgba(255,255,255,0.12);">
            {{ $index }}
        </span>
    </div>

    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-[1.4fr_1fr] gap-10 items-center px-6 sm:px-10 lg:px-12 py-10 lg:py-14">

        {{-- Left: content --}}
        <div>
            <nav class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] {{ $a['muted'] }} mb-5">
                <a href="{{ route('customer.home') }}" class="hover:text-white transition">KickCraze</a>
                <svg class="w-2.5 h-2.5 opacity-60" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">{{ $eyebrow }}</span>
            </nav>

            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur ring-1 ring-white/10 text-[10px] font-black uppercase tracking-[0.3em] text-white">
                    <span class="relative flex w-1.5 h-1.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $a['dot'] }} opacity-60"></span>
                        <span class="relative inline-flex rounded-full h-1.5 w-1.5 {{ $a['dot'] }}"></span>
                    </span>
                    {{ $totalCount }} {{ \Illuminate\Support\Str::plural('pair', $totalCount) }} in stock
                </span>
            </div>

            <h1 class="font-black uppercase tracking-tighter leading-[0.85]">
                <span class="block text-5xl md:text-6xl lg:text-7xl">{{ $title }}</span>
                @if($subtitle)
                    <span class="block mt-1 text-4xl md:text-5xl lg:text-6xl text-transparent bg-clip-text bg-gradient-to-r {{ $a['line'] }}">
                        {{ $subtitle }}
                    </span>
                @endif
            </h1>

            @if($description)
                <p class="mt-6 max-w-xl text-sm md:text-base {{ $a['muted'] }} font-medium leading-relaxed">
                    {{ $description }}
                </p>
            @endif
        </div>

        {{-- Right: stat / promise strip --}}
        <div class="relative z-10 lg:justify-self-end w-full lg:max-w-xs">
            <div class="grid grid-cols-2 lg:grid-cols-1 gap-px bg-white/10 ring-1 ring-white/10 rounded-2xl overflow-hidden backdrop-blur">
                <div class="bg-zinc-950/80 px-5 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] {{ $a['muted'] }}">100%</div>
                        <div class="text-xs font-bold text-white">Authenticated</div>
                    </div>
                </div>
                <div class="bg-zinc-950/80 px-5 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] {{ $a['muted'] }}">Free over ₱2.5k</div>
                        <div class="text-xs font-bold text-white">Standard shipping</div>
                    </div>
                </div>
                <div class="bg-zinc-950/80 px-5 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] {{ $a['muted'] }}">30 days</div>
                        <div class="text-xs font-bold text-white">Easy returns</div>
                    </div>
                </div>
                <div class="bg-zinc-950/80 px-5 py-4 flex items-center gap-3">
                    <svg class="w-5 h-5 text-white/70 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <div>
                        <div class="text-[10px] font-black uppercase tracking-[0.2em] {{ $a['muted'] }}">2–5 days</div>
                        <div class="text-xs font-bold text-white">Express dispatch</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
