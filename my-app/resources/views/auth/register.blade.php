<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - KickCraze</title>
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
        <div class="absolute -top-20 right-0 h-72 w-72 rounded-full bg-red-500/20 blur-3xl"></div>
        <div class="absolute -bottom-24 left-0 h-80 w-80 rounded-full bg-orange-500/10 blur-3xl"></div>

        <div class="grid min-h-screen md:grid-cols-2">
            <section class="relative flex items-center justify-center p-8 md:p-12 bg-cover bg-center" style="background-image: url('Images/bggg.jpg');">
                <div class="absolute inset-0 bg-zinc-950/80"></div>
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at top, rgba(239, 68, 68, 0.2), transparent 55%);"></div>

                <div class="relative w-full max-w-xl rounded-3xl border border-zinc-800/70 bg-zinc-900/50 p-8 md:p-12 shadow-2xl backdrop-blur">
                    <a href="{{ route('customer.home') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition">
                        <span class="text-base">&larr;</span>
                        Back to store
                    </a>

                    <div class="mt-10 kc-fade">
                        <p class="text-xs uppercase tracking-[0.3em] text-zinc-400">KickCraze Drop List</p>
                        <h1 class="kc-title mt-4 text-4xl md:text-5xl font-bold">Create your account.</h1>
                        <p class="mt-4 text-zinc-300">Join the vault to save favorites, get early access, and catch exclusive drops.</p>
                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-3 text-[11px] uppercase tracking-[0.2em] text-zinc-400">
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Early access</div>
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Member drops</div>
                        <div class="rounded-2xl border border-zinc-800/80 bg-black/40 px-3 py-4 text-center">Order tracking</div>
                    </div>
                </div>
            </section>

            <section class="relative flex items-center justify-center p-8 md:p-12">
                <div class="absolute right-12 top-12 h-24 w-24 rounded-full border border-zinc-800/50"></div>
                <div class="absolute bottom-16 left-10 h-16 w-16 rounded-full border border-zinc-800/40"></div>

                <div class="w-full max-w-md rounded-3xl border border-zinc-800/80 bg-zinc-900/60 p-8 md:p-10 shadow-2xl backdrop-blur">
                    <div class="flex items-center gap-3 mb-8 kc-fade kc-fade-2">
                        <img src="Images/logo.png" alt="KickCraze Logo" class="h-10 w-auto invert opacity-90">
                        <div>
                            <p class="text-[11px] uppercase tracking-[0.3em] text-zinc-400">KickCraze</p>
                            <h2 class="kc-title text-2xl font-bold">Create account</h2>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5 kc-fade kc-fade-3">
                        @csrf

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Full name</label>
                            <input class="mt-2 w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="text" name="fullname" value="{{ old('fullname') }}" placeholder="John Doe" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Email</label>
                            <input class="mt-2 w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Password</label>
                            <input class="mt-2 w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="password" name="password" placeholder="********" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-[0.2em] text-zinc-400">Confirm password</label>
                            <input class="mt-2 w-full rounded-2xl border border-zinc-800/70 bg-zinc-950/70 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-red-500 focus:ring-1 focus:ring-red-500/30 transition" type="password" name="password_confirmation" placeholder="********" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <button type="submit" class="w-full rounded-2xl bg-white px-6 py-3 text-xs font-bold uppercase tracking-[0.3em] text-black shadow-xl transition hover:bg-zinc-200">Create account</button>

                        <div class="border-t border-zinc-800/80 pt-6 text-center">
                            <span class="text-[11px] uppercase tracking-[0.25em] text-zinc-500">Already have an account?</span>
                            <a href="{{ route('login') }}" class="mt-2 block text-xs font-semibold uppercase tracking-[0.2em] text-white hover:text-red-400 transition">Sign in instead</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
