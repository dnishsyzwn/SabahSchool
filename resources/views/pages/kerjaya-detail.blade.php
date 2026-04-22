@extends('layouts.app')

@section('title', $job->title . ' | Sabah Teachers Union')

@section('content')

@php
    $typeLabel = match($job->type) {
        'full_time' => 'Sepenuh Masa',
        'part_time' => 'Sambilan',
        'contract' => 'Kontrak',
        'internship' => 'Latihan Amali',
        default => $job->type
    };
@endphp

{{-- Standard Header --}}
<div class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop" 
             alt="Header Background" 
             class="w-full h-full object-cover opacity-30">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
        <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-4 drop-shadow-md uppercase italic">
            {{ $job->title }}
        </h1>
        <div class="flex flex-wrap justify-center gap-6 text-[10px] font-black uppercase tracking-[0.2em]">
            <span class="flex items-center gap-2 text-white/90">
                <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                {{ $job->location }}
            </span>
            <span class="flex items-center gap-2 text-white/90">
                <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ $typeLabel }}
            </span>
            <span class="flex items-center gap-2 text-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Tamat: {{ $job->deadline->format('d M Y') }}
            </span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Back Link --}}
    <div class="mb-12">
        <a href="{{ route('kerjaya.index') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-primary transition-all group">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Senarai Kerjaya
        </a>
    </div>

    <div class="space-y-16">
        
        {{-- Job Description --}}
        <div>
            <h3 class="text-xs font-black text-gray-900 mb-6 flex items-center gap-4 uppercase tracking-[0.3em]">
                <span class="w-10 h-[2px] bg-secondary"></span>
                Deskripsi Tugas
            </h3>
            <div class="prose max-w-none text-gray-600 leading-relaxed font-medium">
                {!! nl2br(e($job->description)) !!}
            </div>
        </div>

        {{-- Requirements --}}
        @if($job->requirements)
        <div>
            <h3 class="text-xs font-black text-gray-900 mb-6 flex items-center gap-4 uppercase tracking-[0.3em]">
                <span class="w-10 h-[2px] bg-primary"></span>
                Syarat Kelayakan
            </h3>
            <div class="prose max-w-none text-gray-600 leading-relaxed font-medium">
                {!! nl2br(e($job->requirements)) !!}
            </div>
        </div>
        @endif

        <div class="pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Gaji Ditawarkan</p>
                <p class="text-xl font-black text-gray-900">{{ $job->salary_range ?: 'Terbuka' }}</p>
            </div>
            <a href="#mohon" class="px-10 py-5 bg-primary text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                Mohon Sekarang
            </a>
        </div>

        {{-- Application Procedure Info (Re-using design from list) --}}
        <div id="mohon" class="bg-primary/5 rounded-3xl p-8 md:p-12 border border-primary/10 animate-fade-in-up">
            <div class="max-w-3xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 italic">Prosedur Permohonan</h2>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <p>Sila hantar resume dan dokumen sokongan anda ke alamat e-mel rasmi kami:</p>
                    <div class="flex items-center gap-3 p-4 bg-white rounded-2xl border border-primary/10 w-fit">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-black text-primary text-sm tracking-widest uppercase">admin@sabahteachersunion.com</span>
                    </div>
                    <ul class="list-disc pl-5 space-y-2 mt-6 font-medium text-sm text-gray-600">
                        <li>Resume / Curriculum Vitae (CV) terkini</li>
                        <li>Salinan Sijil Akademik berkaitan</li>
                        <li>Salinan Kad Pengenalan</li>
                        <li>Gambar berukuran pasport</li>
                    </ul>
                    <p class="mt-6 p-4 bg-white border border-secondary/20 rounded-2xl text-xs font-bold text-gray-500 uppercase tracking-wider leading-loose">
                        Hanya calon yang disenarai pendek akan dihubungi untuk sesi temuduga.
                    </p>
                </div>
            </div>
        </div>

@endsection
