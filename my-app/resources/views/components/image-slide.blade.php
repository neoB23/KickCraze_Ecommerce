@vite('resources/css/app.css')
@php
    $images = [
        '/Images/banner1.jpg',
        '/Images/banner2.jpg',
        '/Images/banner3.jpg',
    ];
@endphp

<div class="relative w-full h-[70vh] lg:h-[85vh] overflow-hidden bg-black flex justify-center items-center group">
    {{-- Banner Overlays for Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/80 z-10 pointer-events-none"></div>

    {{-- Banner Images with Alpine or Vanilla JS Fading Transition --}}
    <div id="slider-container" class="absolute inset-0 w-full h-full">
        @foreach($images as $index => $img)
        <img 
            src="{{ $img }}" 
            alt="Hero Banner {{ $index + 1 }}" 
            class="absolute inset-0 w-full h-full object-cover object-center transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-105' : 'opacity-0 scale-100' }}"
            data-index="{{ $index }}"
        >
        @endforeach
    </div>

    {{-- Hero Text Overlay within Slider --}}
    <div class="relative z-20 text-center px-4 max-w-5xl mx-auto transform transition duration-1000 translate-y-0 text-white">
        <span class="block text-sm font-bold tracking-[0.3em] uppercase mb-4 text-gray-300">New Arrivals</span>
        <h1 class="font-black text-6xl sm:text-7xl lg:text-9xl tracking-tighter uppercase mb-4 leading-none inline-block pb-2">
            KICKCRAZE
        </h1>
        <p class="font-medium text-lg sm:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto">
            Step into the future. Discover unparalleled comfort and bold aesthetics.
        </p>
        <a href="{{ route('mens') }}" class="inline-flex items-center justify-center bg-white text-black px-10 py-4 text-base font-bold rounded-full hover:bg-gray-200 transition duration-300 shadow-[0_0_40px_rgba(255,255,255,0.3)] uppercase tracking-widest group-hover:scale-105 overflow-hidden relative">
            <span class="relative z-10">Shop Collection</span>
        </a>
    </div>

    {{-- Slider Indicators --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
        @foreach($images as $index => $img)
        <button class="w-12 h-1 rounded-full transition-all duration-500 {{ $index === 0 ? 'bg-white' : 'bg-white/30' }}" data-indicator="{{ $index }}"></button>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('#slider-container img');
        const indicators = document.querySelectorAll('button[data-indicator]');
        let currentIndex = 0;
        const totalSlides = slides.length;
        
        function updateSlider(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'scale-100');
                    slide.classList.add('opacity-100', 'scale-105');
                } else {
                    slide.classList.remove('opacity-100', 'scale-105');
                    slide.classList.add('opacity-0', 'scale-100');
                }
            });
            
            indicators.forEach((ind, i) => {
                if (i === index) {
                    ind.classList.remove('bg-white/30');
                    ind.classList.add('bg-white');
                } else {
                    ind.classList.remove('bg-white');
                    ind.classList.add('bg-white/30');
                }
            });
        }
        
        setInterval(() => {
            if(totalSlides === 0) return;
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlider(currentIndex);
        }, 4000); 

        indicators.forEach(btn => {
            btn.addEventListener('click', (e) => {
                currentIndex = parseInt(e.target.getAttribute('data-indicator'));
                updateSlider(currentIndex);
            });
        });
    });
</script>