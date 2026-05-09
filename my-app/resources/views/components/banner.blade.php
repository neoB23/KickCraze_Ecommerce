@vite('resources/css/app.css')
@php
    $messages = [
        "🎉 50% Off on Selected Shoes!",
        "🚚 Free Shipping on Orders Over $50!",
        "🔥 Limited Time Offer: Buy 1 Get 1 Free!",
        "⭐ New Arrivals Just Dropped!",
    ];
@endphp

<div class="relative w-full bg-zinc-950 border-b border-zinc-800 overflow-hidden z-50">
    <div class="min-h-[40px] flex items-center justify-center relative max-w-7xl mx-auto px-4">
        {{-- Animated Text Container --}}
        <div class="relative h-[20px] w-full max-w-2xl overflow-hidden flex items-center justify-center">
            <div id="topMessage" class="absolute w-full text-center text-xs md:text-sm font-semibold tracking-widest uppercase text-zinc-300 transition-all duration-500 ease-in-out transform translate-y-0 opacity-100">
                {{ $messages[0] }}
            </div>
            <div id="nextMessage" class="absolute w-full text-center text-xs md:text-sm font-semibold tracking-widest uppercase text-zinc-300 transition-all duration-500 ease-in-out transform translate-y-full opacity-0">
                {{ $messages[1] ?? $messages[0] }}
            </div>
        </div>
    </div>
</div>

<script>
    const messages = @json($messages);
    let messageIndex = 0;
    
    const currentMsgEl = document.getElementById('topMessage');
    const nextMsgEl = document.getElementById('nextMessage');

    setInterval(() => {
        const nextIndex = (messageIndex + 1) % messages.length;
        
        // Prepare next message text
        nextMsgEl.textContent = messages[nextIndex];
        
        // Transition Next Message In
        nextMsgEl.classList.remove('translate-y-full', 'opacity-0');
        nextMsgEl.classList.add('translate-y-0', 'opacity-100');
        
        // Transition Current Message Out (Upwards)
        currentMsgEl.classList.remove('translate-y-0', 'opacity-100');
        currentMsgEl.classList.add('-translate-y-full', 'opacity-0');
        
        // Reset classes after animation completes
        setTimeout(() => {
            currentMsgEl.textContent = messages[nextIndex];
            
            // Instantly reset positions
            currentMsgEl.classList.add('transition-none');
            nextMsgEl.classList.add('transition-none');
            
            currentMsgEl.classList.remove('-translate-y-full', 'opacity-0');
            currentMsgEl.classList.add('translate-y-0', 'opacity-100');
            
            nextMsgEl.classList.remove('translate-y-0', 'opacity-100');
            nextMsgEl.classList.add('translate-y-full', 'opacity-0');
            
            // Re-enable transitions
            setTimeout(() => {
                currentMsgEl.classList.remove('transition-none');
                nextMsgEl.classList.remove('transition-none');
            }, 50);
            
            messageIndex = nextIndex;
        }, 500);

    }, 4000);
</script>