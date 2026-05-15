<div class="hidden md:block bg-zinc-950 border-b border-zinc-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-12 flex items-center justify-between">
        @php
            $currentRoute = request()->route() ? request()->route()->getName() : '';
            $primaryLinks = [
                ['label' => "Home",     'route' => 'customer.home'],
                ['label' => "Men's",    'route' => 'mens'],
                ['label' => "Women's",  'route' => 'womens'],
                ['label' => "Kids",     'route' => 'kids'],
            ];
        @endphp

        {{-- Primary nav --}}
        <div class="flex items-center gap-10 text-[11px] font-black tracking-[0.3em] uppercase">
            @foreach($primaryLinks as $link)
                @php $isActive = $currentRoute === $link['route']; @endphp
                <a href="{{ route($link['route']) }}"
                   class="relative group transition-colors {{ $isActive ? 'text-white' : 'text-zinc-400 hover:text-white' }}">
                    {{ $link['label'] }}
                    <span class="absolute -bottom-1 left-0 h-px bg-white transition-all duration-300 {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            @endforeach
            <a href="{{ route('sale') }}"
               class="relative group inline-flex items-center gap-2 text-red-400 hover:text-red-300 transition-colors {{ $currentRoute === 'sale' ? 'text-red-300' : '' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                Sale
                <span class="absolute -bottom-1 left-0 h-px bg-red-400 transition-all duration-300 {{ $currentRoute === 'sale' ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
        </div>

        {{-- Right meta --}}
        <div class="flex items-center gap-6 text-[10px] font-black tracking-[0.3em] uppercase text-zinc-500">
            <span class="hidden lg:inline-flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Authentic Drops
            </span>
            <span class="hidden lg:inline-flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Insider Drops
            </span>
        </div>
    </div>
</div>
