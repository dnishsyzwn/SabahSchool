@props(['href', 'active' => false])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => ($active ? 'text-secondary' : 'text-white') . ' uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150'
   ]) }}>
    {{ $slot }}
</a>
