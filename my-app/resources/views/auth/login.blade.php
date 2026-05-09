<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KickCraze</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased text-zinc-100 bg-zinc-950 flex flex-col md:flex-row min-h-screen selection:bg-zinc-800 selection:text-white">
    <!-- LEFT PANE: Visual Identity and Branding -->
    <div class="w-full md:w-1/2 bg-cover bg-center relative p-10 md:p-20 flex items-center justify-center min-h-[300px] md:min-h-screen" style="background-image: url('Images/bggg.jpg');">
        <div class="absolute inset-0 bg-zinc-950/80 backdrop-blur-[2px]"></div>

        <a href="{{ route('customer.home') }}" class="absolute top-8 left-8 text-white px-5 py-2 border border-zinc-800 bg-zinc-900/50 text-xs font-bold uppercase tracking-widest rounded-full hover:bg-white hover:text-black transition duration-300 shadow-xl z-20">
            &larr; Back
        </a>

        <div class="relative text-center text-white z-10">
            <h2 class="text-5xl md:text-6xl font-black tracking-tighter mb-4 uppercase drop-shadow-lg">
                KickCraze<span class="text-red-500">.</span>
            </h2>
            <p class="text-sm font-semibold tracking-[0.2em] uppercase max-w-sm mx-auto text-zinc-400">
                Enter The Vault
            </p>
        </div>
    </div>

    <!-- RIGHT PANE: Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-12 bg-zinc-950 relative">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-900/20 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="w-full max-w-md p-8 md:p-10 rounded-2xl border border-zinc-900 bg-zinc-900/40 backdrop-blur-xl relative z-10 shadow-2xl">

            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <img src="Images/logo.png" alt="KickCraze Logo" class="h-12 w-auto invert opacity-90">
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h1 class="font-black text-3xl tracking-tight text-white mb-2 text-center uppercase">
                Welcome Back
            </h1>
            <p class="text-zinc-400 mb-8 text-center text-sm font-medium">
                Sign in to your KickCraze account.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <div class="mb-5">
                    <label for="email" class="block text-xs font-bold text-zinc-300 mb-2 uppercase tracking-wider">Email Address</label>
                    <input id="email"
                           class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500/50 transition-all py-3 px-4 outline-none placeholder-zinc-600"
                           type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <label for="password" class="block text-xs font-bold text-zinc-300 mb-2 uppercase tracking-wider">Password</label>
                    <div class="relative">
                        <input id="password"
                               class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500/50 transition-all py-3 px-4 pr-10 outline-none placeholder-zinc-600"
                               type="password"
                               name="password"
                               placeholder="????????"
                               required />
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-3 text-zinc-500 hover:text-white transition-colors focus:outline-none">
                            <svg id="eyeOpenIcon" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeClosedIcon" class="h-4 w-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.879 13.879a3 3 0 10-4.243-4.243m4.243 4.243L21 21m-4.243-4.243L3 3M10 14a4 4 0 00-4 4v2" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.88 9.88c-.06.27-.11.55-.11.85a3 3 0 0 0 3 3c.3 0 .58-.05.85-.11M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.7 9.7 0 0 0 5.39-1.61M12 5a13.52 13.52 0 0 1 7.39 5.39M19.39 17.39c.07-.27.11-.56.11-.88a10 10 0 0 0-3-6.61M2 2l20 20" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-xs font-bold text-zinc-300 mb-2 uppercase tracking-wider">Login As</label>
                    <select name="role" id="role" class="block w-full bg-zinc-950 border border-zinc-800 text-white rounded-lg shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500/50 transition-all py-3 px-4 outline-none appearance-none" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-white text-black rounded-lg font-black text-xs uppercase tracking-[0.15em] hover:bg-zinc-200 transition-colors shadow-xl">
                        Secure Sign In
                    </button>
                    
                    <div class="text-center mt-2 border-t border-zinc-800 pt-6">
                        <span class="text-xs text-zinc-500 font-semibold tracking-wider uppercase">
                            New to KickCraze?
                        </span>
                        <a href="{{ route('register') }}" class="block mt-2 text-xs font-bold text-white hover:text-red-400 transition-colors uppercase tracking-[0.1em]">
                            Create an Account
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpenIcon = document.getElementById('eyeOpenIcon');
        const eyeClosedIcon = document.getElementById('eyeClosedIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            if (isPassword) {
                eyeOpenIcon.classList.add('hidden');
                eyeClosedIcon.classList.remove('hidden');
            } else {
                eyeOpenIcon.classList.remove('hidden');
                eyeClosedIcon.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
