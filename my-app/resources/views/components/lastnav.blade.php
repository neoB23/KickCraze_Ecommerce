<div class="hidden md:block bg-zinc-950 text-zinc-400 border-b border-zinc-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-10 flex items-center justify-between text-[11px] uppercase tracking-[0.28em]">
        <div class="flex items-center gap-6">
            <a href="#" class="hover:text-white transition-colors">Seller Centre</a>
            <a href="#" class="hover:text-white transition-colors">Store Locator</a>
            <a href="#" class="hover:text-white transition-colors">Download App</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="#" class="hover:text-white transition-colors">Support</a>
            @auth
                <a href="{{ route('customer.orders') }}" class="hover:text-white transition-colors">My Vault</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a>
                <span class="text-zinc-700">/</span>
                <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
            @endguest
        </div>
    </div>
</div>