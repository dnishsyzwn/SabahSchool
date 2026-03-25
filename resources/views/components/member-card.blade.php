@props(['name', 'role', 'image', 'highlight' => false, 'posX' => 'center', 'posY' => 'center'])

<div class="flex flex-col items-center text-center group">
    <!-- Image Circle -->
    <div class="relative mb-3 md:mb-6">
        <div class="{{ $highlight ? 'w-24 h-24 md:w-48 md:h-48' : 'w-20 h-20 md:w-40 md:h-40' }} rounded-full border-4 md:border-8 {{ $highlight ? 'border-secondary' : 'border-primary' }} p-1 bg-white shadow-xl transition-transform duration-500 group-hover:scale-105 overflow-hidden flex-shrink-0">
            <div class="w-full h-full rounded-full bg-secondary/20 overflow-hidden">
                <img src="{{ asset($image) }}" 
                     alt="{{ $name }}" 
                     class="w-full h-full object-cover"
                     style="object-position: {{ $posX }} {{ $posY }};">
            </div>
        </div>
        @if($highlight)
            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-secondary text-primary px-4 py-1 rounded-full text-[10px] font-black tracking-widest uppercase shadow-lg">
                TERTINGGI
            </div>
        @endif
    </div>

    <!-- Text Content -->
    <div class="space-y-0 md:space-y-1">
        <h4 class="text-primary font-black text-[10px] md:text-base tracking-wider uppercase leading-tight">
            {{ $role }}
        </h4>
        <p class="text-gray-900 font-bold text-xs md:text-lg">
            {{ $name }}
        </p>
    </div>
</div>
