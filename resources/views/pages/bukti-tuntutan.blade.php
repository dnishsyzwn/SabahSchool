@extends('layouts.app')

@section('title', 'Bukti Tuntutan | Sabah Teachers Union')

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')
    {{-- Hero --}}
    <div class="relative bg-gradient-to-br from-[#001a6e] via-[#002080] to-[#001050] overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-32 -left-32 w-[500px] h-[500px] bg-blue-400/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-emerald-400/10 rounded-full blur-[100px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-md text-white/80 rounded-full mb-8 border border-white/10">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase">Rekod Pampasan &amp; Bantuan</span>
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                    Bukti <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-cyan-300">Tuntutan</span>
                </h1>
                <p class="text-lg text-blue-100/70 max-w-2xl mx-auto leading-relaxed">
                    Komitmen kami dalam membela nasib ahli — setiap tuntutan adalah bukti nyata perlindungan yang diberikan oleh Sabah Teachers' Union.
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
    </div>

    {{-- Main Content --}}
    <div class="bg-[#f4f7fa]" x-data>

        {{-- Search & Filter Panel --}}
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 pt-12">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col gap-8">

                {{-- Search & Date Form --}}
                <form action="{{ url()->current() }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    <div class="md:col-span-5 relative">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Carian Kata Kunci</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Nama ahli, sekolah, atau penyakit..."
                                   class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-gray-700 font-medium">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Tarikh Mula (Post)</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                               class="w-full px-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-gray-600 font-medium">
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Tarikh Tamat (Post)</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                               class="w-full px-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all text-gray-600 font-medium">
                    </div>

                    <div class="md:col-span-1">
                        <button type="submit" class="w-full h-[3.6rem] bg-blue-600 text-white rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>

                    <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">
                </form>

                <div class="h-px bg-gray-100"></div>

                {{-- Sort & Stats --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4" x-data="{ sortOpen: false }">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Susun:</span>
                        <div class="relative w-56">
                            <button @click="sortOpen = !sortOpen"
                                    class="w-full flex items-center justify-between px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold text-gray-700 hover:bg-white hover:border-gray-200 transition-all">
                                <span>{{ match(request('sort')) { 'oldest' => 'Terlama (Post)', 'name_asc' => 'Nama (A-Z)', 'name_desc' => 'Nama (Z-A)', default => 'Terbaru (Post)' } }}</span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="sortOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="sortOpen" x-cloak @click.away="sortOpen = false"
                                 class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl border border-gray-100 shadow-xl z-50 py-2 overflow-hidden"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition {{ request('sort', 'latest') === 'latest' ? 'text-blue-600 bg-blue-50/50 font-bold' : '' }}">Terbaru (Post)</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition {{ request('sort') === 'oldest' ? 'text-blue-600 bg-blue-50/50 font-bold' : '' }}">Terlama (Post)</a>
                                <div class="h-px bg-gray-50 mx-3 my-1"></div>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition {{ request('sort') === 'name_asc' ? 'text-blue-600 bg-blue-50/50 font-bold' : '' }}">Nama (A-Z)</a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'name_desc']) }}" class="block px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition {{ request('sort') === 'name_desc' ? 'text-blue-600 bg-blue-50/50 font-bold' : '' }}">Nama (Z-A)</a>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-8 bg-blue-50/60 px-6 py-3 rounded-2xl border border-blue-100/60">
                        <div class="text-center">
                            <span class="block text-2xl font-black text-blue-900 leading-none">{{ $claims->total() }}</span>
                            <span class="text-[9px] font-bold text-blue-400 uppercase tracking-widest mt-1 block">Rekod Ditemui</span>
                        </div>
                        <div class="w-px h-8 bg-blue-200/50"></div>
                        <div class="text-center">
                            <span class="block text-2xl font-black text-blue-600 leading-none">{{ $claims->count() }}</span>
                            <span class="text-[9px] font-bold text-blue-400 uppercase tracking-widest mt-1 block">Halaman Ini</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Claims Grid --}}
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-12 md:py-16">

            @if($claims->isEmpty())
                <div class="text-center py-20">
                    <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">Tiada Rekod Tuntutan</h3>
                    <p class="text-gray-400">Rekod bukti tuntutan akan dipaparkan di sini apabila tersedia.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($claims as $claim)

                    {{-- Each card has its own Alpine instance to scope lightbox images --}}
                    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:border-blue-100 transition-all duration-500"
                         x-data="{
                            lightboxOpen: false,
                            lightboxIndex: 0,
                            lightboxImages: {{ json_encode($claim->images->map(fn($img) => Storage::url($img->image_path))->values()->toArray()) }},
                            openLightbox(idx) { this.lightboxOpen = true; this.lightboxIndex = idx; document.body.style.overflow = 'hidden'; },
                            closeLightbox() { this.lightboxOpen = false; document.body.style.overflow = ''; },
                            prevImage() { this.lightboxIndex = (this.lightboxIndex - 1 + this.lightboxImages.length) % this.lightboxImages.length; },
                            nextImage() { this.lightboxIndex = (this.lightboxIndex + 1) % this.lightboxImages.length; },
                            notesOpen: false,
                            openNotes() { this.notesOpen = true; document.body.style.overflow = 'hidden'; },
                            closeNotes() { this.notesOpen = false; document.body.style.overflow = ''; }
                         }">

                        {{-- Claim Type & Date --}}
                        <div class="px-6 pt-5 pb-0 flex items-start justify-between">
                            <div class="flex flex-col gap-1.5">
                                @if($claim->claim_type)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $claim->claim_type === 'KEMATIAN' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-amber-50 text-amber-600 border border-amber-100' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $claim->claim_type === 'KEMATIAN' ? 'bg-red-400' : 'bg-amber-400' }}"></span>
                                        {{ $claim->claim_type }}
                                    </span>
                                @endif
                                @if($claim->published_at)
                                    <span class="text-[10px] font-semibold text-gray-400 flex items-center gap-1 ml-0.5">
                                        <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $claim->published_at->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                            @if($claim->compensation_amount)
                                <div class="text-right shrink-0 ml-3">
                                    <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-0.5">Pampasan</span>
                                    <span class="font-black text-xl text-blue-900 tracking-tight leading-none">{{ $claim->compensation_amount }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Member Name & School --}}
                        <div class="px-6 pt-4 pb-3">
                            <h3 class="text-lg font-extrabold text-gray-900 leading-snug mb-1 group-hover:text-[#001a6e] transition-colors">
                                {{ $claim->member_name ?? $claim->title }}
                            </h3>
                            @if($claim->school)
                                <p class="text-sm text-gray-400 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    {{ $claim->school }}
                                </p>
                            @endif
                        </div>

                        {{-- Details Grid --}}
                        <div class="px-6 pb-4">
                            <div class="grid grid-cols-2 gap-3">
                                @if($claim->disease_type)
                                <div class="bg-gray-50 rounded-xl p-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Jenis Penyakit</p>
                                    <p class="text-sm font-bold text-gray-800">{{ $claim->disease_type }}</p>
                                </div>
                                @endif

                                @if($claim->contribution_amount)
                                <div class="bg-gray-50 rounded-xl p-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Caruman</p>
                                    <p class="text-sm font-bold text-gray-800">{{ $claim->contribution_amount }}</p>
                                </div>
                                @endif

                                @if($claim->date_joined)
                                <div class="bg-gray-50 rounded-xl p-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Tarikh Sertai</p>
                                    <p class="text-sm font-bold text-gray-800">{{ $claim->date_joined }}</p>
                                </div>
                                @endif

                                @if($claim->date_incident)
                                <div class="bg-gray-50 rounded-xl p-3">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">{{ $claim->claim_type === 'KEMATIAN' ? 'Tarikh Meninggal' : 'Tarikh Diagnosis' }}</p>
                                    <p class="text-sm font-bold text-gray-800">{{ $claim->date_incident }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Heir Info --}}
                        @if($claim->heir_name)
                        <div class="px-6 pb-4">
                            <div class="flex items-center gap-3 bg-blue-50/70 rounded-xl p-3 border border-blue-100/50">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Waris {{ $claim->heir_relation ? '(' . $claim->heir_relation . ')' : '' }}</p>
                                    <p class="text-sm font-bold text-blue-800">{{ $claim->heir_name }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Image Gallery --}}
                        @if($claim->images->count() > 0)
                        <div class="px-6 pb-5">
                            <div class="grid {{ $claim->images->count() === 1 ? 'grid-cols-1' : ($claim->images->count() === 2 ? 'grid-cols-2' : 'grid-cols-3') }} gap-2">
                                @foreach($claim->images as $idx => $img)
                                    <div class="relative aspect-[4/3] rounded-xl overflow-hidden cursor-pointer group/img"
                                         @click="openLightbox({{ $idx }})">
                                        <img src="{{ Storage::url($img->image_path) }}"
                                             alt="{{ $claim->member_name }}"
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-110">
                                        <div class="absolute inset-0 bg-black/0 group-hover/img:bg-black/30 transition-all duration-300 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white opacity-0 group-hover/img:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Bottom Bar --}}
                        <div class="px-6 py-4 bg-gray-50/60 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-[10px] font-mono text-gray-400 uppercase tracking-widest">STU • Bukti Tuntutan</span>
                            @if($claim->description)
                                <button @click="openNotes()"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-500/20">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <span>Lihat Catatan</span>
                                </button>
                            @endif
                        </div>

                        {{-- Lightbox Modal (inside same x-data scope) --}}
                        <div x-show="lightboxOpen" x-cloak
                             class="fixed inset-0 z-[200] flex items-center justify-center bg-black/95 backdrop-blur-sm"
                             @keydown.escape.window="closeLightbox()"
                             @keydown.left.window="prevImage()"
                             @keydown.right.window="nextImage()"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">

                            {{-- Close --}}
                            <button @click="closeLightbox()" class="absolute top-5 right-5 z-[210] w-12 h-12 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            {{-- Prev --}}
                            <button x-show="lightboxImages.length > 1" @click.stop="prevImage()"
                                    class="absolute left-5 top-1/2 -translate-y-1/2 z-[210] w-14 h-14 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            </button>

                            {{-- Next --}}
                            <button x-show="lightboxImages.length > 1" @click.stop="nextImage()"
                                    class="absolute right-5 top-1/2 -translate-y-1/2 z-[210] w-14 h-14 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 text-white transition-all">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>

                            {{-- Image --}}
                            <div class="flex flex-col items-center justify-center w-full h-full p-16" @click="closeLightbox()">
                                <img :src="lightboxImages[lightboxIndex]"
                                     alt="Gambar Tuntutan"
                                     @click.stop
                                     class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-white/10">
                                <div x-show="lightboxImages.length > 1" class="mt-6 text-white/70 text-xs font-mono tracking-widest uppercase">
                                    Imej <span x-text="lightboxIndex + 1" class="text-white font-bold"></span> / <span x-text="lightboxImages.length" class="text-white font-bold"></span>
                                </div>
                            </div>
                        </div>

                        {{-- Notes Modal (inside same x-data scope) --}}
                        @if($claim->description)
                        <div x-show="notesOpen" x-cloak
                             class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-md p-4"
                             @keydown.escape.window="closeNotes()"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                            <div class="bg-white w-full max-w-2xl rounded-[2rem] shadow-2xl overflow-hidden" @click.away="closeNotes()">
                                <div class="px-8 py-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100 flex items-center justify-between">
                                    <div>
                                        <span class="block text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1">Catatan Tuntutan</span>
                                        <h3 class="text-lg font-black text-gray-900">{{ $claim->member_name }}</h3>
                                    </div>
                                    <button @click="closeNotes()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white/70 text-gray-500 hover:text-gray-800 hover:bg-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                                <div class="p-8">
                                    <p class="text-gray-600 leading-relaxed whitespace-pre-line text-base">{{ $claim->description }}</p>
                                    <div class="mt-8 flex justify-end">
                                        <button @click="closeNotes()" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>{{-- end card --}}
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-16">
                    {{ $claims->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

    </div>

    {{-- Stats Section --}}
    <div class="relative bg-[#001a6e] overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-cyan-500/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-500/5 rounded-full blur-[80px] translate-y-1/3 -translate-x-1/4"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 text-white/70 rounded-lg mb-4 border border-white/10">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase">Impak STU</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Kami Dalam Angka</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-8">
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-emerald-300 tracking-tight block mb-2">48</span>
                    <p class="text-white/40 uppercase tracking-[0.1em] text-sm">Tahun Berdiri</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">12k+</span>
                    <p class="text-white/40 uppercase tracking-[0.1em] text-sm">Ahli Berdaftar</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">{{ $claims->total() }}</span>
                    <p class="text-white/40 uppercase tracking-[0.1em] text-sm">Bukti Tuntutan</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">25</span>
                    <p class="text-white/40 uppercase tracking-[0.1em] text-sm">Daerah Liputan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="relative bg-white overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-50 rounded-full blur-[100px] translate-y-1/3 translate-x-1/3"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#001a6e] tracking-tight mb-4 max-w-2xl mx-auto leading-tight">
                Perlindungan Untuk Setiap Ahli STU
            </h2>
            <p class="text-gray-400 text-lg mb-10 max-w-xl mx-auto">
                Sertai kami hari ini dan dapatkan perlindungan menyeluruh untuk anda dan keluarga.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/hubungi') }}" class="px-10 py-4 bg-[#001a6e] text-white uppercase tracking-wider text-sm font-bold rounded-2xl hover:bg-[#000d36] transition-all duration-300 shadow-lg shadow-blue-900/20">
                    Hubungi Kami
                </a>
                <a href="{{ url('/keahlian') }}" class="px-10 py-4 bg-gray-100 text-gray-700 uppercase tracking-wider text-sm font-bold rounded-2xl hover:bg-gray-200 transition-all duration-300">
                    Maklumat Keahlian
                </a>
            </div>
        </div>
    </div>
@endsection
