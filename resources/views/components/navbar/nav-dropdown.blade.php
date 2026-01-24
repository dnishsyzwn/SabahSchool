@props(['title'])

<div class="relative group h-full flex items-center">
    <button {{ $attributes->merge(['class' => 'text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150 flex items-center gap-1 focus:outline-none cursor-default']) }}>
        {{ $title }}
        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div class="absolute top-full mt-5 left-1/2 -translate-x-1/2 w-72 bg-primary border-t-2 border-secondary shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-[60]">
        <div>
            {{ $slot }}
        </div>
    </div>
</div>
