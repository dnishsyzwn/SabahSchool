@props(['href', 'bordered' => false])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors uppercase' . ($bordered ? ' border-t border-white/5' : '')
   ]) }}>
    {{ $slot }}
</a>
