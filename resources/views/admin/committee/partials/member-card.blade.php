{{-- Partial: admin member card --}}
<div class="relative mb-4 md:mb-6 group">
    {{-- Card ring — emas jika is_highlight, biru jika tidak --}}
    <div class="{{ $member->is_highlight
            ? 'w-20 h-20 md:w-36 md:h-36 border-secondary border-[3px] md:border-[6px]'
            : 'w-20 h-20 md:w-36 md:h-36 border-primary border-[3px] md:border-[5px]' }}
         rounded-full p-0.5 md:p-1 bg-white shadow-xl overflow-hidden transition-transform duration-500 hover:scale-105">
        <div class="w-full h-full rounded-full bg-secondary/20 overflow-hidden">
            <img src="{{ $imgSrc }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
        </div>
    </div>

    {{-- Drag Handle (⠿) --}}
    <div class="drag-handle absolute -top-1 -left-1 md:-top-2 md:-left-2 w-8 h-8 md:w-10 md:h-10 bg-indigo-600 text-white rounded-lg md:rounded-xl shadow-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-grab active:cursor-grabbing z-20 hover:scale-110">
        <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7 8h2V6H7v2zm0 5h2v-2H7v2zm0 5h2v-2H7v2zm6-10h2V6h-2v2zm0 5h2v-2h-2v2zm0 5h2v-2h-2v2z"/>
        </svg>
    </div>

    {{-- TERTINGGI badge --}}
    @if($member->is_highlight)
        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-secondary text-primary px-2.5 py-0.5 rounded-full text-[7px] md:text-[8px] font-black tracking-widest uppercase shadow-lg whitespace-nowrap z-10">
            TERTINGGI
        </div>
    @endif

    {{-- Status badge --}}
    @if(!$member->is_active)
        <div class="absolute top-1 right-0 bg-red-500 text-white text-[6px] md:text-[7px] font-black px-1 md:px-1.5 py-0.5 rounded-full uppercase tracking-wide">Tidak Aktif</div>
    @endif

    {{-- Hover admin overlay --}}
    <div class="card-overlay absolute inset-0 flex items-center justify-center gap-1.5 md:gap-2 rounded-full bg-black/25">
        <button type="button" onclick="openDrawer({{ $member->id }}, '{{ $member->type }}', {{ $member->row_index }})"
                class="w-8 h-8 md:w-10 md:h-10 bg-white text-indigo-600 rounded-full shadow-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition active:scale-90 border-2 border-indigo-100">
            <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </button>
        <button type="button" onclick="deleteMember({{ $member->id }}, '{{ addslashes($member->name) }}')"
                class="w-8 h-8 md:w-10 md:h-10 bg-white text-red-500 rounded-full shadow-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition active:scale-90 border-2 border-red-100">
            <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </div>
</div>

{{-- Name + position --}}
<div class="pointer-events-none select-none space-y-0.5 md:space-y-1">
    <h4 class="{{ $member->is_highlight ? 'text-yellow-600' : 'text-primary' }} font-black text-[8px] md:text-sm tracking-wider uppercase leading-tight">{{ $member->position }}</h4>
    <p class="text-gray-900 font-bold text-[10px] md:text-base leading-snug">{{ $member->name }}</p>
    @if($member->division)<p class="text-[9px] md:text-[10px] text-gray-400 italic">{{ $member->division }}</p>@endif
</div>
