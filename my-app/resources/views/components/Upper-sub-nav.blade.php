@vite('resources/css/app.css')

{{-- CURATED HIGHLIGHTS — Premium dark bento --}}
<section class="relative bg-zinc-950 text-white overflow-hidden">
    {{-- Ambient glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-white/5 rounded-full blur-[140px]"></div>
        <div class="absolute -bottom-20 right-1/4 w-[500px] h-[500px] bg-red-500/10 rounded-full blur-[140px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24">

        {{-- Header --}}
        <div class="flex items-end justify-between mb-12 pb-6 border-b border-zinc-800">
            <div>
                <span class="inline-block text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-3">— This Week</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black tracking-tighter uppercase leading-[0.9]">
                    Curated
                </h2>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-zinc-600 tracking-tighter uppercase leading-[0.9]">
                    Highlights
                </h2>
            </div>
            <a href="{{ route('mens') }}" class="hidden sm:inline-flex items-center gap-2 text-xs font-black uppercase tracking-[0.25em] text-zinc-300 hover:text-white transition group">
                View All
                <span class="w-8 h-px bg-zinc-700 group-hover:bg-white group-hover:w-12 transition-all"></span>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        {{-- Bento grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- LARGE BANNER --}}
            <a href="{{ route('mens') }}" class="group md:col-span-2 overflow-hidden rounded-3xl relative min-h-[340px] md:min-h-[460px] bg-zinc-900 ring-1 ring-zinc-800 hover:ring-white/30 transition-all duration-500">
                <img src="Images/men-s-shoes-clothing-accessories (1).png"
                     alt="Nike Holiday Collection"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.2s] ease-out" />
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-zinc-950/60 via-transparent to-transparent"></div>

                {{-- Top label --}}
                <div class="absolute top-6 left-6 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[10px] font-black tracking-[0.25em] text-zinc-950 bg-white rounded-full uppercase">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                        Exclusive
                    </span>
                </div>

                {{-- Content --}}
                <div class="absolute bottom-0 left-0 right-0 p-8 md:p-10">
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-2">Nike · Holiday Drop</p>
                    <h3 class="text-3xl sm:text-4xl md:text-5xl font-black text-white uppercase tracking-tighter leading-[0.95] drop-shadow-2xl">
                        Nike Holiday<br/>Collection
                    </h3>
                    <div class="mt-5 flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-white">
                        <span>Shop the Drop</span>
                        <span class="w-10 h-px bg-white group-hover:w-16 transition-all duration-500"></span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </a>

            {{-- RIGHT STACK --}}
            <div class="grid grid-cols-1 gap-5">

                {{-- Top --}}
                <a href="{{ route('sale') }}" class="group overflow-hidden rounded-3xl relative min-h-[220px] bg-zinc-900 ring-1 ring-zinc-800 hover:ring-white/30 transition-all duration-500">
                    <img src="Images/image.png"
                         alt="Lebron Legacy"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.2s] ease-out opacity-90" />
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/30 to-zinc-950/10"></div>

                    <div class="absolute top-5 left-5">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[9px] font-black tracking-[0.25em] text-white bg-red-600 rounded-full uppercase">
                            Drop
                        </span>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <p class="text-[9px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-1">Nike Basketball</p>
                        <h3 class="text-xl md:text-2xl font-black text-white uppercase tracking-tighter leading-[0.95] drop-shadow-md">
                            Lebron<br/>Legacy
                        </h3>
                    </div>
                </a>

                {{-- Bottom --}}
                <a href="{{ route('womens') }}" class="group overflow-hidden rounded-3xl relative min-h-[220px] bg-zinc-900 ring-1 ring-zinc-800 hover:ring-white/30 transition-all duration-500">
                    <img src="Images/banner2.jfif"
                         alt="Jordan Max Definition"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-[1.2s] ease-out opacity-90" />
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/30 to-zinc-950/10"></div>

                    <div class="absolute top-5 left-5">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[9px] font-black tracking-[0.25em] text-zinc-950 bg-amber-300 rounded-full uppercase">
                            Trending
                        </span>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-5">
                        <p class="text-[9px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-1">Air Jordan · Max</p>
                        <h3 class="text-xl md:text-2xl font-black text-white uppercase tracking-tighter leading-[0.95] drop-shadow-md">
                            Jordan Max<br/>Definition
                        </h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- THE KICKCRAZE STANDARD --}}
    <div class="relative z-10 border-t border-zinc-900 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-10">
                <span class="inline-block text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-3">— Why KickCraze</span>
                <h2 class="text-3xl md:text-4xl font-black text-white tracking-tighter uppercase">The KickCraze Standard</h2>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- 1 Flash Sales --}}
                <a href="{{ route('sale') }}" class="group relative flex items-start gap-4 p-6 bg-zinc-900/60 border border-zinc-800 rounded-2xl hover:bg-zinc-900 hover:border-zinc-700 transition-all duration-300">
                    <div class="shrink-0 w-12 h-12 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center border border-red-500/20 group-hover:bg-red-500 group-hover:text-white group-hover:border-red-500 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9.405 2.897a4 4 0 0 1 5.02-.136l.17.136l.376.32a2 2 0 0 0 .96.45l.178.022l.493.04a4 4 0 0 1 3.648 3.468l.021.2l.04.494a2 2 0 0 0 .36.996l.11.142l.322.376a4 4 0 0 1 .136 5.02l-.136.17l-.321.376a2 2 0 0 0-.45.96l-.022.178l-.039.493a4 4 0 0 1-3.468 3.648l-.201.021l-.493.04a2 2 0 0 0-.996.36l-.142.111l-.377.32a4 4 0 0 1-5.02.137l-.169-.136l-.376-.321a2 2 0 0 0-.96-.45l-.178-.021l-.493-.04a4 4 0 0 1-3.648-3.468l-.021-.2l-.04-.494a2 2 0 0 0-.36-.996l-.111-.142l-.321-.377a4 4 0 0 1-.136-5.02l.136-.169l.32-.376a2 2 0 0 0 .45-.96l.022-.178l.04-.493A4 4 0 0 1 7.197 3.75l.2-.021l.494-.04a2 2 0 0 0 .996-.36l.142-.111zM14.5 13a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3m-.207-4.707l-6 6a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0-1.414-1.414M9.5 8a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-white">Flash Sales</p>
                        <p class="text-[11px] text-zinc-400 mt-1">Up to 50% off select drops</p>
                    </div>
                </a>

                {{-- 2 Official Mall --}}
                <a href="#" class="group relative flex items-start gap-4 p-6 bg-zinc-900/60 border border-zinc-800 rounded-2xl hover:bg-zinc-900 hover:border-zinc-700 transition-all duration-300">
                    <div class="shrink-0 w-12 h-12 rounded-xl bg-white/5 text-zinc-300 flex items-center justify-center border border-zinc-700 group-hover:bg-white group-hover:text-zinc-950 group-hover:border-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 48 48"><path d="M6 12.6V41a2 2 0 0 0 2 2h32a2 2 0 0 0 2-2V12.6zm36 0L36.333 5H11.667L6 12.6zm-10.445 6.6c0 4.198-3.382 7.6-7.555 7.6s-7.556-3.402-7.556-7.6"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-white">Official Mall</p>
                        <p class="text-[11px] text-zinc-400 mt-1">100% authenticated pairs</p>
                    </div>
                </a>

                {{-- 3 On-time Delivery --}}
                <a href="#" class="group relative flex items-start gap-4 p-6 bg-zinc-900/60 border border-zinc-800 rounded-2xl hover:bg-zinc-900 hover:border-zinc-700 transition-all duration-300">
                    <div class="shrink-0 w-12 h-12 rounded-xl bg-white/5 text-zinc-300 flex items-center justify-center border border-zinc-700 group-hover:bg-white group-hover:text-zinc-950 group-hover:border-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 4a1 1 0 0 0-1 1v5a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V7a1 1 0 0 0-1-1"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-white">Guaranteed</p>
                        <p class="text-[11px] text-zinc-400 mt-1">On-time delivery promise</p>
                    </div>
                </a>

                {{-- 4 Free Returns --}}
                <a href="#" class="group relative flex items-start gap-4 p-6 bg-zinc-900/60 border border-zinc-800 rounded-2xl hover:bg-zinc-900 hover:border-zinc-700 transition-all duration-300">
                    <div class="shrink-0 w-12 h-12 rounded-xl bg-white/5 text-zinc-300 flex items-center justify-center border border-zinc-700 group-hover:bg-white group-hover:text-zinc-950 group-hover:border-white transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"><path d="M4 12V8a4 4 0 0 1 4-4h12m0 0l-4-4m4 4l-4 4m0 8h-4a4 4 0 0 1-4-4v-4m0 0l4-4m-4 4l-4 4"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-white">Free Returns</p>
                        <p class="text-[11px] text-zinc-400 mt-1">Within 30 days, no fuss</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
