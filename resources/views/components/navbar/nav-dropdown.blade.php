@props(['title'])

<div class="relative group h-full flex items-center nav-dropdown-wrapper">
    <button {{ $attributes->merge(['class' => 'nav-dropdown-toggle text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150 flex items-center gap-1 focus:outline-none cursor-pointer']) }}>
        {{ $title }}
        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180 group-[.is-open]:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Dropdown Menu -->
    <div class="absolute top-full left-1/2 -translate-x-1/2 w-72 pt-[20px] opacity-0 invisible pointer-events-none group-hover:opacity-100 group-hover:visible group-hover:pointer-events-auto group-[.is-open]:opacity-100 group-[.is-open]:visible group-[.is-open]:pointer-events-auto transition-all duration-200 transform translate-y-2 group-hover:translate-y-0 group-[.is-open]:translate-y-0 z-[100]">
        <div class="bg-primary border-t-2 border-secondary shadow-2xl relative">
            {{ $slot }}
        </div>
    </div>
</div>
