{{-- Critical inline CSS so splash shows even before external stylesheets load --}}
<style>
    html.kc-loading { overflow: hidden; }
    #kcSplash {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #09090b;
        color: #fff;
        opacity: 1;
        transition: opacity 480ms ease;
    }
    #kcSplash.kc-splash-hide {
        opacity: 0;
        pointer-events: none;
    }
    #kcSplash .kc-splash-inner {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
        padding: 2rem;
    }
    #kcSplash .kc-splash-glow {
        position: absolute;
        inset: -80px;
        background: radial-gradient(circle at center, rgba(255,255,255,0.08), transparent 60%);
        filter: blur(40px);
        pointer-events: none;
    }
    #kcSplash .kc-splash-logo-wrap {
        position: relative;
        width: 96px;
        height: 96px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #kcSplash .kc-splash-ring {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 2px solid rgba(255,255,255,0.08);
    }
    #kcSplash .kc-splash-ring-spin {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 2px solid transparent;
        border-top-color: #fff;
        border-right-color: rgba(255,255,255,0.4);
        animation: kc-splash-spin 1.1s linear infinite;
    }
    @keyframes kc-splash-spin { to { transform: rotate(360deg); } }
    #kcSplash .kc-splash-logo {
        width: 56px;
        height: 56px;
        object-fit: contain;
        animation: kc-splash-pulse 1.6s ease-in-out infinite;
    }
    @keyframes kc-splash-pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(0.92); opacity: 0.8; }
    }
    #kcSplash .kc-splash-brand {
        font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        font-weight: 900;
        font-size: 1.5rem;
        letter-spacing: -0.02em;
        text-transform: uppercase;
        line-height: 1;
    }
    #kcSplash .kc-splash-tagline {
        font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        font-weight: 700;
        font-size: 10px;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
    }
    #kcSplash .kc-splash-dots {
        display: flex;
        gap: 6px;
        margin-top: 4px;
    }
    #kcSplash .kc-splash-dots span {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        background: rgba(255,255,255,0.4);
        animation: kc-splash-bounce 1s ease-in-out infinite;
    }
    #kcSplash .kc-splash-dots span:nth-child(2) { animation-delay: 0.15s; }
    #kcSplash .kc-splash-dots span:nth-child(3) { animation-delay: 0.3s; }
    @keyframes kc-splash-bounce {
        0%, 80%, 100% { transform: translateY(0); background: rgba(255,255,255,0.3); }
        40% { transform: translateY(-6px); background: #fff; }
    }
</style>

{{-- Mark html as loading immediately so we can lock scroll --}}
<script>document.documentElement.classList.add('kc-loading');</script>

{{-- Splash overlay (first thing rendered in body) --}}
<div id="kcSplash" role="status" aria-label="Loading">
    <div class="kc-splash-glow"></div>
    <div class="kc-splash-inner">
        <div class="kc-splash-logo-wrap">
            <span class="kc-splash-ring"></span>
            <span class="kc-splash-ring-spin"></span>
            <img class="kc-splash-logo" src="{{ asset('Images/logo.png') }}" alt="KickCraze" onerror="this.style.display='none'">
        </div>
        <div style="display:flex;flex-direction:column;align-items:center;gap:8px;">
            <div class="kc-splash-brand">KickCraze</div>
            <div class="kc-splash-tagline">Loading the drop</div>
        </div>
        <div class="kc-splash-dots"><span></span><span></span><span></span></div>
    </div>
</div>

{{-- Top progress bar (used for in-app nav AFTER splash is gone) --}}
<div id="kcProgress" class="fixed top-0 left-0 right-0 z-[110] h-[3px] pointer-events-none">
    <div id="kcProgressBar" class="h-full w-0 bg-gradient-to-r from-zinc-900 via-zinc-500 to-zinc-900 opacity-0 transition-opacity duration-200 shadow-[0_0_12px_rgba(0,0,0,0.4)]"></div>
</div>

{{-- Full-screen overlay shown for explicit "loading" actions (forms with data-loader-overlay) --}}
<div id="kcOverlay" class="fixed inset-0 z-[105] bg-zinc-950/40 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-200">
    <div class="bg-white rounded-2xl px-8 py-6 shadow-2xl flex items-center gap-4">
        <span class="relative flex h-6 w-6">
            <span class="absolute inset-0 rounded-full border-2 border-zinc-200"></span>
            <span class="absolute inset-0 rounded-full border-2 border-zinc-950 border-t-transparent animate-spin"></span>
        </span>
        <div>
            <div class="text-[10px] font-black uppercase tracking-[0.25em] text-zinc-500" id="kcOverlayLabel">Loading</div>
            <div class="text-sm font-bold text-zinc-900" id="kcOverlayMsg">Just a moment…</div>
        </div>
    </div>
</div>

<style>
    /* Spinner for buttons in loading state */
    [data-kc-loading="1"] {
        pointer-events: none;
        opacity: 0.75;
        position: relative;
    }
    [data-kc-loading="1"] .kc-btn-label { visibility: hidden; }
    [data-kc-loading="1"]::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 1.1em;
        height: 1.1em;
        margin: -0.55em 0 0 -0.55em;
        border-radius: 9999px;
        border: 2px solid currentColor;
        border-top-color: transparent;
        animation: kc-spin 0.7s linear infinite;
    }
    @keyframes kc-spin { to { transform: rotate(360deg); } }

    /* Toast animations */
    .kc-toast {
        pointer-events: auto;
        transform: translateX(120%);
        opacity: 0;
        transition: transform 320ms cubic-bezier(0.16, 1, 0.3, 1), opacity 200ms ease;
    }
    .kc-toast.kc-show { transform: translateX(0); opacity: 1; }
    .kc-toast.kc-hide { transform: translateX(120%); opacity: 0; }
</style>

<script>
(function () {
    // ---------- Splash screen ----------
    const splash = document.getElementById('kcSplash');
    let splashHidden = false;

    function hideSplash() {
        if (splashHidden || !splash) return;
        splashHidden = true;
        splash.classList.add('kc-splash-hide');
        document.documentElement.classList.remove('kc-loading');
        setTimeout(() => splash.remove(), 520);
    }

    // Minimum visible time so splash doesn't flicker on instant loads
    const MIN_SHOW_MS = 450;
    const showStart = performance.now();
    function maybeHideSplash() {
        const elapsed = performance.now() - showStart;
        const wait = Math.max(0, MIN_SHOW_MS - elapsed);
        setTimeout(hideSplash, wait);
    }

    if (document.readyState === 'complete') {
        maybeHideSplash();
    } else {
        window.addEventListener('load', maybeHideSplash);
        // Safety fallback in case `load` never fires (slow image, etc.)
        setTimeout(hideSplash, 5000);
    }

    // ---------- Top progress bar ----------
    const bar = document.getElementById('kcProgressBar');
    let progressTimer = null;
    let progress = 0;

    function startProgress() {
        if (!bar) return;
        clearInterval(progressTimer);
        progress = 0;
        bar.style.opacity = '1';
        bar.style.width = '0%';
        progressTimer = setInterval(() => {
            const remaining = 90 - progress;
            progress += Math.max(0.5, remaining * 0.08);
            bar.style.width = Math.min(progress, 90) + '%';
        }, 180);
    }

    function finishProgress() {
        if (!bar) return;
        clearInterval(progressTimer);
        bar.style.width = '100%';
        setTimeout(() => {
            bar.style.opacity = '0';
            setTimeout(() => { bar.style.width = '0%'; }, 220);
        }, 180);
    }

    document.addEventListener('click', function (e) {
        const a = e.target.closest('a');
        if (!a) return;
        if (a.target === '_blank' || a.hasAttribute('download') || a.dataset.kcSkipLoader === '1') return;
        const href = a.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
        if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        try {
            const url = new URL(a.href, location.origin);
            if (url.origin !== location.origin) return;
        } catch (_) { return; }
        startProgress();
    });

    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.dataset.kcSkipLoader === '1') return;

        startProgress();

        const btn = form.querySelector('button[type="submit"], input[type="submit"], button:not([type])');
        if (btn && !btn.dataset.kcLoading) {
            if (!btn.querySelector('.kc-btn-label')) {
                const span = document.createElement('span');
                span.className = 'kc-btn-label';
                while (btn.firstChild) span.appendChild(btn.firstChild);
                btn.appendChild(span);
            }
            btn.dataset.kcLoading = '1';
            btn.setAttribute('data-kc-loading', '1');
        }

        if (form.dataset.loaderOverlay !== undefined) {
            const label = form.dataset.loaderLabel || 'Processing';
            const msg = form.dataset.loaderMessage || 'Just a moment…';
            showOverlay(label, msg);
        }
    }, true);

    window.addEventListener('pageshow', function (e) {
        if (e.persisted) {
            hideSplash();
            finishProgress();
            hideOverlay();
            document.querySelectorAll('[data-kc-loading="1"]').forEach(el => {
                el.removeAttribute('data-kc-loading');
                delete el.dataset.kcLoading;
            });
        }
    });

    window.addEventListener('load', finishProgress);

    // ---------- Overlay ----------
    const overlay = document.getElementById('kcOverlay');
    const overlayLabel = document.getElementById('kcOverlayLabel');
    const overlayMsg = document.getElementById('kcOverlayMsg');

    function showOverlay(label, msg) {
        if (!overlay) return;
        if (label) overlayLabel.textContent = label;
        if (msg) overlayMsg.textContent = msg;
        overlay.style.opacity = '1';
        overlay.style.pointerEvents = 'auto';
    }
    function hideOverlay() {
        if (!overlay) return;
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
    }
    window.kcShowLoader = showOverlay;
    window.kcHideLoader = hideOverlay;

    // ---------- Toasts ----------
    const root = document.getElementById('toastRoot');

    const TOAST_STYLES = {
        success: { ring: 'ring-emerald-500/20', icon: 'text-emerald-500', bg: 'bg-white',  title: 'Success',  iconPath: 'M5 13l4 4L19 7' },
        error:   { ring: 'ring-rose-500/20',    icon: 'text-rose-500',    bg: 'bg-white',  title: 'Heads up', iconPath: 'M6 18L18 6M6 6l12 12' },
        info:    { ring: 'ring-zinc-900/20',    icon: 'text-zinc-900',    bg: 'bg-white',  title: 'Notice',   iconPath: 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
        cart:    { ring: 'ring-zinc-900/20',    icon: 'text-zinc-900',    bg: 'bg-zinc-950 text-white', title: 'Added',  iconPath: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z' },
    };

    function makeToast({ type = 'info', message = '', title = null, duration = 3500 } = {}) {
        if (!root) return;
        const style = TOAST_STYLES[type] || TOAST_STYLES.info;
        const isDark = (style.bg || '').includes('zinc-950');

        const el = document.createElement('div');
        el.className = `kc-toast ${style.bg} ${isDark ? 'text-white' : 'text-zinc-900'} rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.35)] ring-1 ${style.ring} border ${isDark ? 'border-zinc-800' : 'border-zinc-200'} px-4 py-3 flex items-start gap-3`;

        el.innerHTML = `
            <div class="shrink-0 w-9 h-9 rounded-full ${isDark ? 'bg-white/10' : 'bg-zinc-50'} flex items-center justify-center ${isDark ? 'text-white' : style.icon}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="${style.iconPath}"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0 pt-0.5">
                <div class="text-[10px] font-black uppercase tracking-[0.25em] ${isDark ? 'text-zinc-400' : 'text-zinc-500'} mb-0.5">${title || style.title}</div>
                <div class="text-sm font-bold leading-snug break-words">${message}</div>
            </div>
            <button type="button" class="kc-toast-close shrink-0 w-7 h-7 rounded-full inline-flex items-center justify-center ${isDark ? 'text-zinc-400 hover:bg-white/10 hover:text-white' : 'text-zinc-400 hover:bg-zinc-100 hover:text-zinc-900'} transition" aria-label="Dismiss">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;

        root.appendChild(el);
        requestAnimationFrame(() => el.classList.add('kc-show'));

        let dismissTimer = setTimeout(dismiss, duration);
        function dismiss() {
            clearTimeout(dismissTimer);
            el.classList.add('kc-hide');
            el.classList.remove('kc-show');
            setTimeout(() => el.remove(), 360);
        }

        el.querySelector('.kc-toast-close').addEventListener('click', dismiss);
        el.addEventListener('mouseenter', () => clearTimeout(dismissTimer));
        el.addEventListener('mouseleave', () => { dismissTimer = setTimeout(dismiss, 1500); });

        return { dismiss };
    }

    window.kcToast = makeToast;
})();
</script>
