@extends('layouts.app')

@section('title', 'Aktiviti Kami – Sabah Teachers Union')

@section('content')
    <section class="relative bg-slate-900 py-32 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -right-24 w-64 h-64 bg-secondary rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center text-white">
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-white transition-colors">Utama</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-secondary font-semibold">Aktiviti Kami</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
                Aktiviti <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Kami</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Visualisasi komitmen Sabah Teachers' Union dalam memperjuangkan kebajikan ahli dan masyarakat setempat melalui tindakan nyata.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4">

            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 h-[90%] w-0.5 bg-gradient-to-b from-primary/20 via-primary/10 to-transparent mt-10"></div>

            <div class="space-y-16 lg:space-y-32">
                @foreach($stories as $index => $it)
                @php 
                    $isEven = $index % 2 === 0; 
                    // Prepare images array
                    $imagesArr = $it->images ?? [];
                    if (count($imagesArr) === 0 && $it->image_path) {
                        $imagesArr = [$it->image_path];
                    }
                    if (count($imagesArr) === 0) {
                        $imagesArr = ['https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1000&q=80']; // Fallback
                    }
                @endphp

                <div class="relative flex flex-col lg:flex-row items-center group animate-in fade-in slide-in-from-bottom-8 duration-700 delay-{{ ($index % 6) * 100 }}">
                    {{-- Central Dot --}}
                    <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 rounded-full bg-white border-4 border-primary z-10 items-center justify-center group-hover:scale-125 transition-transform duration-300">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    {{-- Text Content --}}
                    <div class="w-full lg:w-1/2 mb-8 lg:mb-0 {{ $isEven ? 'lg:pr-24 text-left lg:text-right' : 'lg:pl-24 lg:order-last text-left' }}">
                        <div class="transition-all duration-500 transform group-hover:translate-y-[-5px]">
                            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-4">
                                {{ $it->tag }}
                            </span>
                            <p class="text-sm font-medium text-gray-400 mb-2">{{ $it->event_date ? $it->event_date->format('d M Y') : 'TIADA TARIKH' }}</p>
                            <h3 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors leading-tight">
                                {{ $it->title }}
                            </h3>
                            <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                                {{ $it->description }}
                            </p>
                        </div>
                    </div>                    {{-- Image / Slider Content --}}
                    <div class="w-full lg:w-1/2 {{ $isEven ? 'lg:pl-24' : 'lg:pr-24' }}">
                        <div x-data="{ 
                                activeIndex: 0, 
                                images: {{ json_encode(array_map(fn($img) => strpos($img, 'http') === 0 ? $img : Storage::url($img), $imagesArr)) }},
                                touchStart: 0,
                                touchEnd: 0,
                                next() { this.activeIndex = (this.activeIndex + 1) % this.images.length },
                                prev() { this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length },
                                handleTouch() {
                                    const diff = this.touchStart - this.touchEnd;
                                    if (Math.abs(diff) > 40) {
                                        if (diff > 0) this.next();
                                        else this.prev();
                                    }
                                }
                             }" 
                             @touchstart="touchStart = $event.changedTouches[0].screenX"
                             @touchend="touchEnd = $event.changedTouches[0].screenX; handleTouch()"
                             class="relative overflow-hidden rounded-[2rem] shadow-2xl group-hover:shadow-primary/20 transition-all duration-500 h-[300px] sm:h-[400px] touch-pan-y bg-gray-100">
                            
                            {{-- Slides --}}
                            <div class="absolute inset-0 z-0 select-none">
                                <template x-for="(src, idx) in images" :key="idx">
                                    <img x-show="activeIndex === idx" 
                                         :src="src" 
                                         x-transition:enter="transition opacity duration-500"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition opacity duration-500"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0"
                                         class="absolute inset-0 w-full h-full object-cover pointer-events-none">
                                </template>
                            </div>

                            {{-- Overlay --}}
                            <div class="absolute inset-0 bg-primary/5 group-hover:bg-transparent transition-colors duration-300 z-10 pointer-events-none"></div>

                            {{-- Navigation Arrows (Show always on responsive, hover on desktop) --}}
                            <template x-if="images.length > 1">
                                <div class="absolute inset-0 z-20 flex items-center justify-between px-4 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity">
                                    <button @click="prev()" class="w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-xl flex items-center justify-center text-primary hover:bg-primary hover:text-white transition active:scale-90">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                    <button @click="next()" class="w-10 h-10 rounded-full bg-white/90 backdrop-blur shadow-xl flex items-center justify-center text-primary hover:bg-primary hover:text-white transition active:scale-90">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                </div>
                            </template>

                            {{-- Multi-image Indicators --}}
                            <template x-if="images.length > 1">
                                <div class="absolute bottom-6 right-6 z-20 flex gap-2 bg-black/30 backdrop-blur-md px-3 py-2 rounded-full border border-white/10">
                                    <template x-for="(src, idx) in images" :key="idx">
                                        <button @click="activeIndex = idx" 
                                                class="h-1.5 rounded-full transition-all duration-300 pointer-events-auto"
                                                :class="activeIndex === idx ? 'bg-white w-6' : 'bg-white/40 w-1.5'"></button>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>v>
                </div>
                @endforeach

                <!-- Standard Laravel Pagination -->
                <div class="pt-20">
                    <div class="custom-pagination">
                        {{ $stories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .custom-pagination nav { display: flex; justify-content: center; gap: 0.5rem; }
        .custom-pagination span[aria-current="page"] > span { @apply bg-primary text-white border-primary shadow-lg shadow-primary/20; }
        .custom-pagination a, .custom-pagination span > span { 
            @apply flex items-center justify-center w-12 h-12 rounded-xl border border-gray-100 bg-white text-sm font-bold text-gray-500 transition-all duration-300 hover:border-primary hover:text-primary hover:shadow-xl hover:shadow-primary/10;
        }
        .custom-pagination svg { @apply w-5 h-5; }
    </style>
@endsection

@push('scripts')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
@endpush
