@extends('layouts.app')

@section('title', 'Ahli Tertinggi & Exco | Sabah Teachers Union')

@section('content')
<!-- Hero Section -->
<div class="relative bg-primary pt-24 pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <img src="{{ asset('images/stu-logo.webp') }}" alt="" class="w-full h-full object-contain scale-150 blur-sm">
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4 animate-fade-in-up">
            SAHSIAH KEPIMPINAN <span class="text-secondary">STU</span>
        </h1>
        <div class="h-2 w-24 bg-secondary mx-auto rounded-full animate-fade-in-up delay-100"></div>
        <p class="mt-6 text-white/80 font-bold uppercase tracking-[0.3em] text-sm animate-fade-in-up delay-200">
            Sesi 2022 - 2026
        </p>
    </div>
</div>

<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
            $colMap = [
                1 => 'grid-cols-1',
                2 => 'grid-cols-2',
                3 => 'grid-cols-3',
            ];
        @endphp

        {{-- ══ Peringkat Tertinggi ══ --}}
        @if($topRows->count() > 0)
        <div class="mb-24">
            <div class="text-center mb-16">
                <h2 class="text-2xl md:text-3xl font-black text-primary uppercase tracking-widest inline-block border-b-4 border-secondary pb-2">
                    AHLI JAWATANKUASA TERTINGGI
                </h2>
            </div>
            <div class="space-y-20">
                @foreach($topRowConfigs as $rowIdx => $rowCfg)
                    @php
                        $members = $topRows->get((int)$rowIdx, collect());
                        $cols    = (int) ($rowCfg['cols'] ?? 1);
                        $gridCls = $colMap[$cols] ?? 'grid-cols-1';
                        $isFirst = ($rowIdx == 0);
                    @endphp
                    @if($members->count() > 0)
                    <div class="grid {{ $gridCls }} gap-4 md:gap-20 justify-items-center animate-fade-in-up">
                    @foreach($members as $i => $member)
                            @php
                                $imgSrc      = $member->image_path ? Storage::url($member->image_path) : asset('images/lelaki-pending.png');
                                $isHighlight = (bool) $member->is_highlight;
                            @endphp
                            <x-member-card
                                :name="$member->name"
                                :role="$member->position"
                                :image-src="$imgSrc"
                                :highlight="$isHighlight"
                                posX="center"
                                posY="center"
                            />
                        @endforeach
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        {{-- ══ Exco Bahagian ══ --}}
        @if($excoRows->count() > 0)
        <hr class="border-gray-100 mb-24">
        <div class="mb-16">
            <div class="text-center mb-16">
                <h2 class="text-2xl md:text-3xl font-black text-primary uppercase tracking-widest inline-block border-b-4 border-secondary pb-2">
                    EXCO BAHAGIAN
                </h2>
            </div>
            <div class="space-y-16">
                @foreach($excoRowConfigs as $rowIdx => $rowCfg)
                    @php
                        $members = $excoRows->get((int)$rowIdx, collect());
                        $cols    = (int) ($rowCfg['cols'] ?? 3);
                        $gridCls = $colMap[$cols] ?? 'grid-cols-1 sm:grid-cols-2 md:grid-cols-3';
                    @endphp
                    @if($members->count() > 0)
                    <div class="grid {{ $gridCls }} gap-4 md:gap-16 justify-items-center animate-fade-in-up">
                        @foreach($members as $member)
                            @php $imgSrc = $member->image_path ? Storage::url($member->image_path) : asset('images/lelaki-pending.png'); @endphp
                            <x-member-card
                                :name="$member->name"
                                :role="$member->position"
                                :image-src="$imgSrc"
                                posX="center"
                                posY="center"
                            />
                        @endforeach
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<!-- Section: CTA -->
<div class="bg-gray-50 py-20 border-t border-gray-100 text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-black text-primary uppercase mb-6 uppercase">Ingin Menghubungi Kepimpinan Kami?</h3>
        <p class="text-gray-500 mb-10 font-medium">Segala urusan rasmi atau aduan ahli boleh disalurkan terus melalui pautan di bawah.</p>
        <a href="{{ url('/hubungi') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-primary text-white font-black rounded-full hover:bg-secondary hover:text-primary transition-all duration-300 shadow-2xl group uppercase tracking-widest text-sm">
            Hubungi Kesatuan
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>
</div>
@endsection
