<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KickCraze</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Space+Grotesk:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --kc-red: #ef4444;
            --kc-ember: #f97316;
            --kc-ink: #0a0a0b;
            --kc-line: #232329;
        }

        body {
            font-family: "Manrope", sans-serif;
        }

        .kc-title {
            font-family: "Space Grotesk", sans-serif;
            letter-spacing: -0.02em;
        }

        .kc-fade {
            animation: rise 0.6s ease-out both;
        }

        .kc-fade-2 {
            animation-delay: 0.12s;
        }

        .kc-fade-3 {
            animation-delay: 0.2s;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(14px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-zinc-950 text-zinc-100">
    <div class="relative min-h-screen overflow-hidden">
        <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-red-500/20 blur-3xl"></div>
        <div class="absolute -bottom-32 right-0 h-80 w-80 rounded-full bg-orange-500/10 blur-3xl"></div>

        <div class="grid min-h-screen md:grid-cols-2">
            <section class="relative flex items-center justify-center p-8 md:p-12" style="background-image: radial-gradient(circle at top, rgba(239, 68, 68, 0.14), transparent 55%);">
                <div class="relative w-full max-w-xl rounded-3xl border border-zinc-800/70 bg-zinc-900/40 p-8 md:p-12 shadow-2xl backdrop-blur">
                    <a href="{{ route('customer.home') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition">
                        <span class="text-base">&larr;</span>
                        Back to store
                    </a>

                    <div class="mt-10 kc-fade">
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-400">KickCraze Vault</p>
                        <h1 class="kc-title mt-4 text-4xl md:text-5xl font-bold">Welcome back.</h1>
                        <p class="mt-4 text-zinc-300">Log in to track orders, manage your wishlist, and unlock member-only drops.</p>
                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-3 text-[11px] uppercase tracking-[0.2em] text-zinc-400">
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Drop alerts</div>
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Fast checkout</div>
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Secure vault</div>
                    </div>
                </div>
            </section>

            <section class="relative flex items-center justify-center p-8 md:p-12">
                <div class="absolute right-10 top-10 h-24 w-24 rounded-full border border-zinc-800/50"></div>
                <div class="absolute bottom-12 left-12 h-16 w-16 rounded-full border border-zinc-800/40"></div>

                <div class="w-full max-w-md rounded-3xl border border-zinc-800/80 bg-zinc-900/60 p-8 md:p-10 shadow-2xl backdrop-blur">
                    <div class="flex items-center gap-3 mb-8 kc-fade kc-fade-2">
                        <img src="Images/logo.png" alt="KickCraze Logo" class="h-10 w-auto invert opacity-90">
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.3em] text-zinc-400">KickCraze</p>
                            <h2 class="kc-title text-2xl font-bold">Secure sign in</h2>
                        </div>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5 kc-fade kc-fade-3">
                        @csrf

                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Email</label>
                            <input id="email" class="mt-2 w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Password</label>
                            <div class="relative mt-2">
                                <input id="password" class="w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 pr-12 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="password" name="password" placeholder="********" required autocomplete="current-password" />
                                <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center px-4 text-zinc-500 hover:text-white transition-colors" aria-label="Toggle password">
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
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <button type="submit" class="w-full rounded-2xl bg-white px-6 py-3 text-xs font-bold uppercase tracking-[0.3em] text-black shadow-xl transition hover:bg-zinc-200">Sign in</button>

                        <div class="border-t border-zinc-800/80 pt-6 text-center">
                            <span class="text-[11px] uppercase tracking-[0.25em] text-zinc-500">New here?</span>
                            <a href="{{ route('register') }}" class="mt-2 block text-xs font-semibold uppercase tracking-[0.2em] text-white hover:text-red-400 transition">Create an account</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeOpenIcon = document.getElementById('eyeOpenIcon');
            const eyeClosedIcon = document.getElementById('eyeClosedIcon');

            if (!togglePassword || !passwordInput) {
                return;
            }

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
