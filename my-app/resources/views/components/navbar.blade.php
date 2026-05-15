<header class="sticky top-0 z-50 bg-zinc-950/95 backdrop-blur-md border-b border-zinc-900" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 lg:h-20 flex items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <span class="w-9 h-9 lg:w-10 lg:h-10 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center">
                <img src="{{ asset('Images/logo.png') }}" class="w-6 h-6 lg:w-7 lg:h-7 object-contain" alt="KickCraze logo">
            </span>
            <span class="font-black text-xl lg:text-2xl tracking-tight text-white uppercase">KickCraze<span class="text-zinc-500">.</span></span>
        </a>

        <div class="hidden md:flex flex-1 justify-center px-4">
            <form action="" method="GET" class="group flex items-center w-full max-w-xl bg-zinc-900/70 border border-zinc-800 rounded-full px-4 py-2.5 focus-within:bg-zinc-900 focus-within:border-white/20 focus-within:ring-2 focus-within:ring-white/5 transition">
                <button type="submit" class="text-zinc-400 group-focus-within:text-white hover:text-white transition-colors mr-2" aria-label="Search">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search limited releases"
                    class="w-full bg-transparent text-sm font-medium text-white placeholder-zinc-500 outline-none border-none ring-0 focus:ring-0 px-0"
                />
            </form>
        </div>

        <div class="flex items-center gap-2 lg:gap-4">
            @guest
                <a href="{{ route('login') }}" class="p-2 text-zinc-300 hover:text-white transition-colors" aria-label="Cart">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </a>
            @endguest
            @auth
                <a href="{{ route('customer.cart') }}" class="p-2 text-zinc-300 hover:text-white transition-colors" aria-label="Cart">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </a>
            @endauth

            <div class="relative hidden md:block" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open" type="button"
                        :class="open ? 'bg-white/10 text-white ring-1 ring-white/20' : 'text-zinc-300 hover:text-white hover:bg-white/5'"
                        class="flex items-center gap-2 p-2 rounded-full transition-all" aria-label="Account">
                    @auth
                        <span class="w-7 h-7 rounded-full bg-gradient-to-br from-white to-zinc-300 text-zinc-950 flex items-center justify-center font-black text-xs">
                            {{ strtoupper(substr(auth()->user()->fullname ?? 'U', 0, 1)) }}
                        </span>
                    @else
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endauth
                    <svg class="w-3 h-3 transition-transform" :class="open && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-cloak style="display:none;"
                     x-transition:enter="duration-200 ease-out"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="duration-150 ease-in"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     class="absolute right-0 mt-3 w-64 bg-zinc-950 border border-zinc-800/80 rounded-2xl shadow-2xl shadow-black/60 overflow-hidden">

                    @auth
                        {{-- User greeting header --}}
                        <div class="px-5 py-4 bg-gradient-to-br from-zinc-900 to-zinc-950 border-b border-zinc-800">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-white to-zinc-300 text-zinc-950 flex items-center justify-center font-black text-base shrink-0">
                                    {{ strtoupper(substr(auth()->user()->fullname ?? 'U', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Welcome back</p>
                                    <p class="text-sm font-bold text-white truncate">{{ auth()->user()->fullname }}</p>
                                    <p class="text-xs text-zinc-400 truncate">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <nav class="py-2">
                            <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-zinc-200 hover:bg-zinc-900 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                My Orders
                            </a>
                            <a href="{{ route('customer.cart') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-zinc-200 hover:bg-zinc-900 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                My Cart
                            </a>
                            <a href="{{ route('customer.heart') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-zinc-200 hover:bg-zinc-900 hover:text-white transition-colors">
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                                </svg>
                                Wishlist
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-5 py-2.5 text-sm text-zinc-200 hover:bg-zinc-900 hover:text-white transition-colors">
                                    <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif
                        </nav>

                        {{-- Sign Out --}}
                        <div class="border-t border-zinc-800/80 p-2 bg-zinc-900/40">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 text-sm font-bold text-red-400 hover:text-white bg-transparent hover:bg-red-600 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="p-3">
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-bold text-zinc-950 bg-white hover:bg-zinc-200 rounded-lg transition-colors mb-2">
                                Sign In
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-bold text-zinc-300 border border-zinc-700 hover:border-white hover:text-white rounded-lg transition-colors">
                                Create Account
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <button type="button" @click="open = !open" class="md:hidden p-2 text-zinc-300 hover:text-white transition-colors" aria-label="Toggle menu">
                <svg x-show="!open" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" style="display:none;" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" style="display:none;" @click.outside="open = false" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="duration-150 ease-in" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden">
        <div class="mx-4 mb-4 rounded-2xl bg-zinc-950 border border-zinc-900 shadow-2xl p-5">
            <form action="" method="GET" class="mb-4">
                <div class="flex items-center bg-zinc-900/80 border border-zinc-800 rounded-xl px-4 py-3 focus-within:border-white/20 transition">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search shoes" class="w-full bg-transparent text-base text-white placeholder-zinc-500 border-none ring-0 outline-none focus:ring-0 p-0" />
                    <button type="submit" class="text-zinc-400 hover:text-white transition-colors p-1" aria-label="Search">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>

            <nav class="grid gap-3">
                <a href="{{ route('mens') }}" @click="open = false" class="text-lg font-bold tracking-tight text-white hover:text-zinc-300 transition-colors">MEN'S</a>
                <a href="{{ route('womens') }}" @click="open = false" class="text-lg font-bold tracking-tight text-white hover:text-zinc-300 transition-colors">WOMEN'S</a>
                <a href="{{ route('kids') }}" @click="open = false" class="text-lg font-bold tracking-tight text-white hover:text-zinc-300 transition-colors">KIDS</a>
                <a href="{{ route('sale') }}" @click="open = false" class="text-lg font-bold tracking-tight text-red-400 hover:text-red-300 transition-colors">SALE</a>
            </nav>

            <div class="pt-4 mt-4 border-t border-zinc-900">
                @auth
                    <a href="{{ route('customer.orders') }}" @click="open = false" class="block py-2 text-sm font-semibold text-white">My Vault</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left py-2 text-sm font-semibold text-red-400 hover:text-red-300 transition-colors">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" @click="open = false" class="block py-2 text-sm font-semibold text-white">Sign In</a>
                    <a href="{{ route('register') }}" @click="open = false" class="block py-2 text-sm font-semibold text-zinc-400 hover:text-zinc-200 transition-colors">Register</a>
                @endauth
            </div>
        </div>
    </div>
</header>