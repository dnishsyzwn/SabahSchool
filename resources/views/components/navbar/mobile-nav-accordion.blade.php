@props(['title'])

<div class="border-b border-white/10 pb-2">
    <button {{ $attributes->merge(['class' => 'mobile-accordion-toggle w-full flex items-center justify-between py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:text-secondary transition-colors']) }}>
        <span>{{ $title }}</span>
        <svg class="accordion-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div class="mobile-accordion-content pl-6 pr-4 hidden space-y-2 mt-2">
        {{ $slot }}
    </div>
</div>
