@props(['href', 'active' => false])

<a href="{{ $href }}" 
    {{ $attributes->merge([
        'class' => 'block py-4 px-4 text-white uppercase font-bold text-[14px] tracking-widest hover:bg-secondary hover:text-primary transition-colors rounded-lg ' . ($active ? 'bg-secondary text-primary' : '')
    ]) }}>
    {{ $slot }}
</a>
