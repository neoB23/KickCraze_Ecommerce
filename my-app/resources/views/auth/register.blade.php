<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KickCraze</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased text-zinc-100 bg-zinc-950 flex flex-col md:flex-row min-h-screen selection:bg-zinc-800 selection:text-white">
    <!-- LEFT PANE -->
    <div class="w-full md:w-1/2 bg-cover bg-center relative p-10 md:p-20 flex items-center justify-center min-h-[300px] md:min-h-screen" style="background-image: url('Images/bggg.jpg');">
        <div class="absolute inset-0 bg-zinc-950/80 backdrop-blur-[2px]"></div>

        <a href="{{ route('customer.home') }}" class="absolute top-8 left-8 text-white px-5 py-2 border border-zinc-800 bg-zinc-900/50 text-xs font-bold uppercase tracking-widest rounded-full hover:bg-white hover:text-black transition duration-300 shadow-xl z-20">
            &larr; Back
        </a>

        <div class="relative text-center text-white z-10">
            <h2 class="text-5xl md:text-6xl font-black tracking-tighter mb-4 uppercase drop-shadow-lg">
                Join <br/>KickCraze<span class="text-red-500">.</span>
            </h2>
            <p class="text-sm font-semibold tracking-[0.2em] uppercase max-w-sm mx-auto text-zinc-400">
                Unlock exclusive drops.
            </p>
        </div>
    </div>

    <!-- RIGHT PANE -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12 bg-zinc-950 relative overflow-hidden">
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-white/5 blur-[150px] rounded-full pointer-events-none"></div>
        <div class="w-full max-w-md p-8 md:p-10 rounded-2xl border border-zinc-900 bg-zinc-900/40 backdrop-blur-xl relative z-10 shadow-2xl">

            <div class="flex justify-center mb-8">
                <img src="Images/logo.png" alt="KickCraze Logo" class="h-12 w-auto invert opacity-90">
            </div>

            <h1 class="font-black text-3xl tracking-tight text-white mb-2 text-center uppercase">
                Create Account
            </h1>
            <p class="text-zinc-400 mb-8 text-center text-sm font-medium">
                Set up your profile to manage orders and saves.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div class="mb-4">
                    <label class="block text-[10px] font-bold text-zinc-400 mb-2 uppercase tracking-widest">Full Name</label>
                    <input class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg focus:border-white focus:ring-0 transition-all py-3 px-4 outline-none placeholder-zinc-700" type="text" name="fullname" value="{{ old('fullname') }}" placeholder="John Doe" required autofocus />
                    <x-input-error :messages="$errors->get('fullname') class="mt-1 text-red-500 text-[10px]" />
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label class="block text-[10px] font-bold text-zinc-400 mb-2 uppercase tracking-widest">Email Address</label>
                    <input class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg focus:border-white focus:ring-0 transition-all py-3 px-4 outline-none placeholder-zinc-700" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required />
                    <x-input-error :messages="$errors->get('email') class="mt-1 text-red-500 text-[10px]" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-[10px] font-bold text-zinc-400 mb-2 uppercase tracking-widest">Password</label>
                    <input class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg focus:border-white focus:ring-0 transition-all py-3 px-4 outline-none placeholder-zinc-700" type="password" name="password" placeholder="????????" required />
                    <x-input-error :messages="$errors->get('password') class="mt-1 text-red-500 text-[10px]" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-zinc-400 mb-2 uppercase tracking-widest">Confirm Password</label>
                    <input class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg focus:border-white focus:ring-0 transition-all py-3 px-4 outline-none placeholder-zinc-700" type="password" name="password_confirmation" placeholder="????????" required />
                    <x-input-error :messages="$errors->get('password_confirmation') class="mt-1 text-red-500 text-[10px]" />
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-white text-black rounded-lg font-black text-xs uppercase tracking-[0.15em] hover:bg-zinc-200 transition-colors shadow-xl">
                        Create Account
                    </button>
                    
                    <div class="text-center mt-2 border-t border-zinc-800 pt-6">
                        <span class="text-[11px] text-zinc-500 font-semibold tracking-wider uppercase">
                            Already have an account?
                        </span>
                        <a href="{{ route('login') }}" class="block mt-2 text-xs font-bold text-white hover:text-red-400 transition-colors uppercase tracking-[0.1em]">
                            Sign In Instead
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
