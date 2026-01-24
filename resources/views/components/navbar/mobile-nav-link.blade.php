@props(['href', 'active' => false])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'block py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg ' . ($active ? 'bg-secondary text-primary' : '')
   ]) }}>
    {{ $slot }}
</a>
