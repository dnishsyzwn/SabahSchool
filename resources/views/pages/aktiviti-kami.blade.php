@extends('layouts.app')

@section('title', 'Aktiviti Kami | Sabah Teachers Union')

@section('content')
    {{-- Hero Header --}}
    <div class="relative bg-[#f8fafc] overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -right-24 w-64 h-64 bg-secondary rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 lg:py-36 relative z-10">
            <div class="max-w-4xl">
                {{-- Elegant Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green rounded-full mb-6 shadow-sm border border-green/10">
                    <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase">2020 — 2024</span>
                </div>

                {{-- Main headline --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-[#001a6e] tracking-tight leading-[1.1] mb-6">
                    Aktiviti<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green to-[#016b61]">Kami</span>
                </h1>

                {{-- Body text --}}
                <p class="text-lg md:text-xl text-gray-500 max-w-2xl leading-relaxed">
                    Dari program pembangunan profesional hingga aktiviti komuniti, kami komited dalam memartabatkan profesion keguruan di Sabah.
                </p>

                {{-- Accent bar --}}
                <div class="w-20 h-1 bg-gradient-to-r from-[#001a6e] to-green rounded-full mt-10 opacity-70"></div>
            </div>
        </div>
    </div>

    {{-- Activity Categories Filter --}}
    <div class="border-b border-gray-200 bg-white sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-0">
        </div>
    </div>

    {{-- Featured Activity --}}
    @if($featured)
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-16 md:py-24">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Content side --}}
                <div>
                    {{-- Category label --}}
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/10 text-[#001a6e] rounded-full font-mono text-xs tracking-[0.15em] uppercase mb-6 border border-secondary/20">
                        <span class="w-1.5 h-1.5 bg-secondary rounded-full"></span>
                        {{ $featured->category }} — {{ $featured->event_date?->format('Y') ?? '' }}
                    </span>

                    {{-- Headline --}}
                    <h2 class="text-4xl md:text-5xl font-extrabold text-[#001a6e] tracking-tight leading-[1.1] mb-6">
                        {!! str_replace(['<br>', '\n'], '<br>', e($featured->title)) !!}
                    </h2>

                    {{-- Stats --}}
                    <div class="flex gap-10 mb-8">
                        @if($featured->amount)
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">{{ $featured->amount }}</span>
                            <span class="text-sm text-gray-400 tracking-wide">Pampasan</span>
                        </div>
                        @endif
                        @if($featured->location)
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">{{ $featured->location }}</span>
                            <span class="text-sm text-gray-400 tracking-wide">Daerah</span>
                        </div>
                        @endif
                        @if($featured->event_date)
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">{{ $featured->event_date->format('Y') }}</span>
                            <span class="text-sm text-gray-400 tracking-wide">Tahun</span>
                        </div>
                        @endif
                    </div>

                    <p class="text-gray-500 leading-relaxed mb-8 max-w-lg">
                        {{ $featured->description }}
                    </p>

                    <!-- <a href="#" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#001a6e] hover:bg-[#000d36] text-white font-bold rounded-2xl shadow-[0_8px_20px_rgba(0,26,110,0.25)] hover:shadow-[0_12px_28px_rgba(0,26,110,0.35)] transition-all duration-300 transform hover:-translate-y-0.5 uppercase tracking-wider text-sm border border-white/10">
                        <span>Lihat Butiran</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a> -->
                </div>

                {{-- Image side --}}
                <div class="relative overflow-hidden rounded-3xl aspect-[4/3] lg:aspect-square shadow-[0_20px_60px_-15px_rgba(0,26,110,0.15)] border border-gray-100 bg-gray-50">
                    @if($featured->featured_image)
                        <img src="{{ Storage::url($featured->featured_image) }}"
                             alt="{{ $featured->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-4 text-gray-300">
                            <svg class="w-16 h-16 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs font-mono tracking-widest uppercase">no image</span>
                        </div>
                    @endif
                    {{-- Accent top border --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#001a6e] via-secondary to-green"></div>
                    {{-- Featured badge overlay --}}
                    @if($featured->is_featured)
                        <span class="absolute top-4 left-4 bg-[#001a6e] text-secondary font-mono text-xs px-3 py-1.5 uppercase tracking-wider rounded-full shadow-lg">Featured</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Activity Grid --}}
    <div class="bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28">
            {{-- Section header --}}
            <div class="flex items-center gap-6 mb-14">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green rounded-lg mb-3">
                        <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                        <span class="text-xs font-bold tracking-wider uppercase">Semua Aktiviti</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Aktiviti Terkini</h2>
                </div>
                <div class="flex-1 h-px bg-gray-200 hidden md:block"></div>
                <span class="font-mono text-sm text-gray-400 hidden md:block">2024</span>
            </div>

            {{-- Grid --}}
            <div id="activity-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($activities as $activity)
                {{-- Activity Card --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500 bg-gray-50">
                        @if($activity->featured_image)
                            <img src="{{ Storage::url($activity->featured_image) }}" 
                                 alt="{{ $activity->title }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center gap-2 text-gray-300 group-hover:scale-110 transition-transform duration-700">
                                <svg class="w-10 h-10 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-[10px] font-mono tracking-widest uppercase">no image</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3 uppercase">{{ $activity->event_date?->format('d M Y') ?? 'TIADA TARIKH' }}</div>
                    @if($activity->category)
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">{{ $activity->category }}</span>
                    @endif
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        {!! str_replace(['<br>', '\n'], '<br>', e($activity->title)) !!}
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">{{ $activity->location }} @if($activity->amount) • {{ $activity->amount }} @endif</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                        {{ $activity->description }}
                    </p>
                    <!-- <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div> -->
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Load More --}}
    <div id="load-more-container" class="bg-[#f8fafc] border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-14 flex justify-center">
            <button id="load-more-btn" class="group relative inline-flex items-center justify-center gap-3 px-10 py-4 bg-white hover:bg-[#001a6e] text-[#001a6e] hover:text-white font-bold rounded-2xl shadow-sm border border-[#001a6e]/20 hover:shadow-[0_8px_25px_rgba(0,26,110,0.25)] transition-all duration-300 transform hover:-translate-y-0.5 uppercase tracking-wider text-sm">
                <span>Muat Lagi Aktiviti</span>
                <svg class="w-4 h-4 rotate-90 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="relative bg-[#001a6e] overflow-hidden">
        {{-- Decorative orbs --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-secondary/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-green/10 rounded-full blur-[80px] translate-y-1/3 -translate-x-1/4"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 relative z-10">
            {{-- Section header --}}
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/10 text-secondary rounded-lg mb-4 border border-secondary/20">
                    <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase">Impak STU</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Kami Dalam Angka</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-8">
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-secondary tracking-tight block mb-2">48</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Tahun Berdiri</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">12k+</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Ahli Berdaftar</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">156</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Aktiviti 2024</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">25</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Daerah Liputan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="relative bg-[#f8fafc] overflow-hidden">
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-green-100/50 rounded-full blur-[100px] translate-y-1/3 translate-x-1/3"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green rounded-lg mb-6 border border-green/10">
                <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                <span class="text-xs font-bold tracking-wider uppercase">Ikuti Kami</span>
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#001a6e] tracking-tight mb-6 max-w-3xl mx-auto">
                Sertai Aktiviti<br>Kami Akan Datang
            </h2>
            <p class="text-gray-500 text-lg mb-10 max-w-xl mx-auto">
                Dapatkan maklumat terkini tentang program dan aktiviti STU terus ke e-mel anda.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Alamat e-mel anda"
                       class="flex-1 h-14 bg-white border border-gray-200 text-gray-900 placeholder-gray-400 px-4 rounded-2xl focus:border-[#001a6e] focus:ring-2 focus:ring-[#001a6e]/20 outline-none transition-all shadow-sm">
                <button class="h-14 px-8 bg-[#001a6e] text-white uppercase tracking-[0.08em] text-sm font-bold rounded-2xl hover:bg-[#000d36] hover:shadow-[0_8px_20px_rgba(0,26,110,0.3)] transition-all duration-300 transform hover:-translate-y-0.5 border border-white/10">
                    Hantar
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grid = document.getElementById('activity-grid');
            if (!grid) return;
            
            const cards = grid.children;
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadMoreContainer = document.getElementById('load-more-container');
            let visibleCount = 6;

            function updateCards() {
                for (let i = 0; i < cards.length; i++) {
                    if (i < visibleCount) {
                        cards[i].classList.remove('hidden');
                        // Optional: Add a simple fade-in effect
                        cards[i].style.opacity = '1';
                    } else {
                        cards[i].classList.add('hidden');
                        cards[i].style.opacity = '0';
                    }
                }
                
                // Hide the entire container if no more cards to show
                if (visibleCount >= cards.length) {
                    loadMoreBtn.classList.add('hidden');
                    loadMoreContainer.classList.add('hidden');
                }
            }

            // Initialize
            updateCards();

            loadMoreBtn.addEventListener('click', function () {
                visibleCount += 6;
                updateCards();
                
                // Slight scroll to the newly loaded content
                const firstNewCard = cards[visibleCount - 6];
                if (firstNewCard) {
                    firstNewCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });
    </script>
    @endpush
@endsection
