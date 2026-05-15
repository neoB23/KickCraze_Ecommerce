<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickCraze Modern Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .active-link {
            background-color: #f4f4f5; /* zinc-100 base */
            color: #18181b; /* zinc-900 text */
            font-weight: 600;
            border-left: 4px solid #18181b;
        }
        .bg-unicos-hero {
            background: #09090b; /* zinc-950 */
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 font-sans antialiased overflow-hidden">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col flex-shrink-0">
            <div class="h-24 flex items-center px-8">
                <!-- Sync theme logo -->
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-lg bg-zinc-950 flex items-center justify-center p-1">
                        <img src="{{ asset('Images/logo.png') }}" class="w-8 h-8 object-contain filter invert" alt="KickCraze logo">
                    </span>
                    <span class="font-black text-xl tracking-tight text-zinc-900 uppercase">KickCraze<span class="text-zinc-500">.</span></span>
                </div>
            </div>
            <nav class="flex-1 overflow-y-auto py-4 px-0 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-8 py-3 text-sm transition-colors border-l-4 border-transparent @if(request()->routeIs('admin.dashboard')) active-link @else text-slate-500 hover:bg-slate-50 hover:text-slate-900 @endif">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-8 py-3 text-sm transition-colors border-l-4 border-transparent @if(request()->routeIs('admin.products.*')) active-link @else text-slate-500 hover:bg-slate-50 hover:text-slate-900 @endif">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    Products
                </a>
                <a href="{{ route('admin.brands.index') }}" class="flex items-center gap-3 px-8 py-3 text-sm transition-colors border-l-4 border-transparent @if(request()->routeIs('admin.brands.*')) active-link @else text-slate-500 hover:bg-slate-50 hover:text-slate-900 @endif">
                    <i data-lucide="tags" class="w-5 h-5"></i>
                    Brands
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-8 py-3 text-sm transition-colors border-l-4 border-transparent @if(request()->routeIs('admin.orders.*')) active-link @else text-slate-500 hover:bg-slate-50 hover:text-slate-900 @endif">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    Orders
                </a>
                
                {{-- Weather Widget --}}
                <div class="px-8 py-6 mt-4 border-t border-gray-100">
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Local Weather</h3>
                            <i data-lucide="cloud-sun" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <div id="weather-widget" class="flex flex-col gap-1">
                            <span class="text-xs text-slate-500">Loading...</span>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Logout Footer --}}
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium transition-colors bg-red-50 text-red-600 hover:bg-red-100 rounded-lg">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Log out
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Area --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Header --}}
            <header class="h-24 bg-gray-50 flex items-center justify-between px-10">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Overview</h1>
                    <p class="text-sm text-slate-500 mt-1">Hi, Welcome back to KickCraze Dashboard.</p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                        <input type="text" placeholder="Search here..." class="pl-12 pr-4 py-3 bg-white border border-gray-100 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 w-72 shadow-sm">
                    </div>
                    <div class="flex gap-3">
                        <button class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-500 shadow-sm relative hover:bg-gray-50">
                            <i data-lucide="bookmark" class="w-4 h-4"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 text-[9px] text-white flex items-center justify-center rounded-full font-bold">12</span>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-500 shadow-sm relative hover:bg-gray-50">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-zinc-900 text-[9px] text-white flex items-center justify-center rounded-full font-bold">5</span>
                        </button>
                        <button class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-500 shadow-sm relative hover:bg-gray-50">
                            <i data-lucide="bell" class="w-4 h-4"></i>
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-[9px] text-white flex items-center justify-center rounded-full font-bold">3</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-6 cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center shadow-md font-bold overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=random" alt="Admin" class="w-full h-full object-cover">
                        </div>
                        <div class="hidden md:block text-sm">
                            <p class="font-semibold text-slate-800">{{ Auth::user()->name ?? 'Administrator' }}</p>
                            <p class="text-xs text-slate-500">Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto px-10 pb-10">
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        lucide.createIcons();

        // Simple Weather fetch using Open-Meteo & basic Geolocation fallback (using New York as default just in case)
        async function fetchWeather() {
            const widget = document.getElementById('weather-widget');
            try {
                // Default coordinates (New York)
                let lat = 40.7128;
                let lon = -74.0060;
                let city = "New York";

                // Attempt to get approximate location based on IP
                try {
                    const geoReq = await fetch('https://get.geojs.io/v1/ip/geo.json');
                    const geoData = await geoReq.json();
                    if(geoData.latitude && geoData.longitude) {
                        lat = geoData.latitude;
                        lon = geoData.longitude;
                        city = geoData.city;
                    }
                } catch(e) {
                    console.log('Using default geolocation.');
                }

                const res = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
                const data = await res.json();
                
                if (data.current_weather) {
                    const temp = data.current_weather.temperature;
                    const isMetric = true; // Using celsius default from API
                    widget.innerHTML = `
                        <div class="text-xl font-bold text-slate-800">${temp}&deg;C</div>
                        <div class="text-xs text-slate-500 font-medium">${city}</div>
                    `;
                } else {
                    widget.innerHTML = `<span class="text-xs text-red-400">Unavailable</span>`;
                }
            } catch (error) {
                widget.innerHTML = `<span class="text-xs text-red-400">Unavailable</span>`;
            }
        }
        
        fetchWeather();
    </script>
</body>
</html>