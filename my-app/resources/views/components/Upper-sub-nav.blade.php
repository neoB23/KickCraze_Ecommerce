@vite('resources/css/app.css')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-12 bg-white">
    
    {{-- TODAY'S HIGHLIGHTS : HIGH-END BENTO GRID --}}
    <div class="mb-16">
        <div class="flex items-end justify-between mb-8 pb-4 border-b border-zinc-200">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-zinc-900 tracking-tighter uppercase">Curated</h2>
                <h2 class="text-3xl md:text-4xl font-black text-zinc-400 tracking-tighter uppercase leading-none">Highlights</h2>
            </div>
            <a href="{{ route('customer.home') }}" class="text-sm font-bold uppercase tracking-widest text-zinc-900 hover:text-red-500 transition-colors">
                View All &rarr;
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- LARGE BANNER (Main Focus) --}}
            <a href="{{ route('mens') }}" class="group md:col-span-2 overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 relative min-h-[300px] md:min-h-[450px] bg-zinc-950 flex">
                <img src="Images/men-s-shoes-clothing-accessories (1).png" 
                     alt="Men's Collection Banner" 
                     class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 group-hover:scale-105 transition-all duration-700 ease-in-out" />
                
                {{-- Graphic Vignette Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                
                {{-- Content Info --}}
                <div class="relative z-10 self-end p-8 w-full flex justify-between items-end transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                    <div>
                        <span class="inline-block px-3 py-1 mb-3 text-[10px] font-bold tracking-widest text-black bg-white rounded-full uppercase">Exclusive</span>
                        <h3 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tighter leading-tight drop-shadow-lg">Nike Holiday<br/>Collection</h3>
                    </div>
                    <div class="bg-white/20 backdrop-blur-md rounded-full p-4 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-6 h-6 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </a>

            {{-- SMALL BANNERS (Stacked on the right) --}}
            <div class="grid grid-cols-1 gap-6">
                
                {{-- Top Small Banner --}}
                <a href="{{ route('sale') }}" class="group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 relative min-h-[215px] bg-zinc-950 flex">
                    <img src="Images/image.png" 
                         alt="New Arrivals Banner" 
                         class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700 ease-in-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-black/10"></div>
                    
                    <div class="relative z-10 self-end p-6 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <span class="inline-block px-3 py-1 mb-2 text-[9px] font-bold tracking-widest text-white bg-red-600 rounded-full uppercase">Drop</span>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter leading-tight drop-shadow-md">Lebron<br/>Legacy</h3>
                    </div>
                </a>
                
                {{-- Bottom Small Banner --}}
                <a href="{{ route('womens') }}" class="group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 relative min-h-[215px] bg-zinc-950 flex border border-zinc-800">
                    <img src="Images/banner2.jfif" 
                         alt="Limited Stock Banner" 
                         class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-90 group-hover:scale-105 transition-all duration-700 ease-in-out" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>
                    
                    <div class="relative z-10 self-end p-6 w-full transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <span class="inline-block px-3 py-1 mb-2 text-[9px] font-bold tracking-widest text-black bg-zinc-100 rounded-full uppercase">Trending</span>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter leading-tight drop-shadow-md">Jordan Max<br/>Definition</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>


    <div class="mb-4 pt-10 border-t border-zinc-200">
        <h2 class="text-2xl font-black text-zinc-900 mb-8 tracking-tighter uppercase text-center">The KickCraze Standard</h2>
        
        {{-- Services Section Redesign --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 px-4">
            
            {{-- Item 1: 50% Off Fashion --}}
            <a href="{{ route('sale') }}" class="group flex flex-col items-center justify-center p-6 bg-zinc-50 rounded-2xl border border-zinc-100 hover:border-zinc-300 hover:bg-white transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-xl">
               <div class="w-16 h-16 rounded-full bg-red-50 text-red-500 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-red-500 group-hover:text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M9.405 2.897a4 4 0 0 1 5.02-.136l.17.136l.376.32a2 2 0 0 0 .96.45l.178.022l.493.04a4 4 0 0 1 3.648 3.468l.021.2l.04.494a2 2 0 0 0 .36.996l.11.142l.322.376a4 4 0 0 1 .136 5.02l-.136.17l-.321.376a2 2 0 0 0-.45.96l-.022.178l-.039.493a4 4 0 0 1-3.468 3.648l-.201.021l-.493.04a2 2 0 0 0-.996.36l-.142.111l-.377.32a4 4 0 0 1-5.02.137l-.169-.136l-.376-.321a2 2 0 0 0-.96-.45l-.178-.021l-.493-.04a4 4 0 0 1-3.648-3.468l-.021-.2l-.04-.494a2 2 0 0 0-.36-.996l-.111-.142l-.321-.377a4 4 0 0 1-.136-5.02l.136-.169l.32-.376a2 2 0 0 0 .45-.96l.022-.178l.04-.493A4 4 0 0 1 7.197 3.75l.2-.021l.494-.04a2 2 0 0 0 .996-.36l.142-.111zM14.5 13a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3m-.207-4.707l-6 6a1 1 0 1 0 1.414 1.414l6-6a1 1 0 0 0-1.414-1.414M9.5 8a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3"/></g></svg>
               </div>
                <p class="text-xs font-bold tracking-widest uppercase text-zinc-900 text-center">Flash Sales</p>
                <p class="text-[10px] text-zinc-500 mt-2 text-center uppercase tracking-wider">Up to 50% Off</p>
            </a>
            
            {{-- Item 2: Kickcraze Mall --}}
            <a href="#" class="group flex flex-col items-center justify-center p-6 bg-zinc-50 rounded-2xl border border-zinc-100 hover:border-zinc-300 hover:bg-white transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-xl">
               <div class="w-16 h-16 rounded-full bg-zinc-200 text-zinc-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-zinc-900 group-hover:text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 48 48"><path fill="currentColor" d="M6 12.6V41a2 2 0 0 0 2 2h32a2 2 0 0 0 2-2V12.6zm36 0L36.333 5H11.667L6 12.6zm-10.445 6.6c0 4.198-3.382 7.6-7.555 7.6s-7.556-3.402-7.556-7.6"/></svg>
               </div>
                <p class="text-xs font-bold tracking-widest uppercase text-zinc-900 text-center">Official Mall</p>
                <p class="text-[10px] text-zinc-500 mt-2 text-center uppercase tracking-wider">100% Authentic</p>
            </a>
            
            {{-- Item 3: On-time Delivery --}}
            <a href="#" class="group flex flex-col items-center justify-center p-6 bg-zinc-50 rounded-2xl border border-zinc-100 hover:border-zinc-300 hover:bg-white transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-xl">
               <div class="w-16 h-16 rounded-full bg-zinc-200 text-zinc-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-zinc-900 group-hover:text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><g fill="none"><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 4a1 1 0 0 0-1 1v5a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V7a1 1 0 0 0-1-1"/></g></svg>
               </div>
                <p class="text-xs font-bold tracking-widest uppercase text-zinc-900 text-center">Guaranteed</p>
                <p class="text-[10px] text-zinc-500 mt-2 text-center uppercase tracking-wider">On-time Delivery</p>
            </a>

            {{-- Item 4: Free Returns --}}
            <a href="#" class="group flex flex-col items-center justify-center p-6 bg-zinc-50 rounded-2xl border border-zinc-100 hover:border-zinc-300 hover:bg-white transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-xl">
               <div class="w-16 h-16 rounded-full bg-zinc-200 text-zinc-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-zinc-900 group-hover:text-white">
                   <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12V8a4 4 0 0 1 4-4h12m0 0l-4-4m4 4l-4 4m0 8h-4a4 4 0 0 1-4-4v-4m0 0l4-4m-4 4l-4 4"/></svg>
               </div>
                <p class="text-xs font-bold tracking-widest uppercase text-zinc-900 text-center">Free Returns</p>
                <p class="text-[10px] text-zinc-500 mt-2 text-center uppercase tracking-wider">Within 30 Days</p>
            </a>
        </div>
    </div>
</div>
