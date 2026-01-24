@props(['href'])

<a href="{{ $href }}" 
   {{ $attributes->merge([
       'class' => 'block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase'
   ]) }}>
    {{ $slot }}
</a>
