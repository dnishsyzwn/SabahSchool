<!-- hero.blade.php -->
<div class="relative bg-[#1a1c23] pt-20 pb-20 md:pt-24 md:pb-32 overflow-hidden">
    <!-- Background Banner (Darkened) -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute inset-0 bg-black/60"></div>
        <img src="{{ Vite::asset('resources/images/stu-logo.png') }}" alt="Background Pattern" class="w-full h-full object-cover scale-150 blur-[2px]">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <!-- Logo -->
        <div class="mb-6 animate-fade-in-up">
            <img src="{{ Vite::asset('resources/images/stu-logo.png') }}" alt="STU Logo" class="h-32 md:h-40 w-auto drop-shadow-[0_0_25px_rgba(255,255,255,0.2)]">
        </div>

        <!-- Title Content -->
        <div class="space-y-2 animate-fade-in-up delay-100">
            <h1 class="text-3xl md:text-3xl font-black text-white tracking-wider uppercase leading-tight">
                KESATUAN GURU-GURU SABAH
            </h1>
            <p class="text-lg md:text-xl font-bold text-secondary tracking-widest uppercase">
                Sabah Teachers' Union ( STU )
            </p>
        </div>
    </div>

    <!-- Inverted Triangular Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-10 translate-y-[1px]">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-12 md:h-20 fill-white">
            <path d="M0,120 L615,60 L1200,120 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</div>
