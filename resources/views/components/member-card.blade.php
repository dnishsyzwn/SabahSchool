@props(['name', 'role', 'image', 'highlight' => false, 'posX' => 'center', 'posY' => 'center'])

<div class="flex flex-col items-center text-center group">
    <!-- Image Circle -->
    <div class="relative mb-6">
        <div class="w-40 h-40 md:w-48 md:h-48 rounded-full border-8 {{ $highlight ? 'border-secondary' : 'border-primary' }} p-1 bg-white shadow-xl transition-transform duration-500 group-hover:scale-105 overflow-hidden">
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
    <div class="space-y-1">
        <h4 class="text-primary font-black text-sm md:text-base tracking-wider uppercase leading-tight">
            {{ $role }}
        </h4>
        <p class="text-gray-900 font-bold text-base md:text-lg">
            {{ $name }}
        </p>
    </div>
</div>
