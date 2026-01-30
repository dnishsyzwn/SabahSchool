@extends('layouts.app')

@section('title', 'Muat Turun | Sabah Teachers Union')

@section('content')

{{-- 
    Define the animations here to ensure they match the Gallery page. 
    If you already have these in your tailwind.config.js, you can remove this style block.
--}}
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        opacity: 0; /* Start hidden */
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
</style>

<div class="min-h-screen bg-gray-50/30">
    <!-- Hero Section -->
    <div class="bg-white border-b border-gray-100 animate-fade-in-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <!-- <div class="inline-flex items-center justify-center w-16 h-16 bg-red-50 rounded-full mb-6">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div> -->
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Muat Turun Borang</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Sila pilih dan muat turun borang yang berkaitan dengan urusan anda. Borang yang telah lengkap boleh dihantar melalui halaman <a href="{{ url('/borang/hantar') }}" class="text-primary hover:underline font-semibold">Hantar Borang</a>.</p>
        </div>
    </div>

    <!-- Forms Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $borangs = [
                    ['title' => 'Borang Keahlian STU', 'desc' => 'Borang permohonan menjadi ahli rasmi Sabah Teachers Union.', 'file' => 'BorangKeahlian.pdf', 'size' => '14.8 KB'],
                    ['title' => 'Borang Tuntutan Kebajikan', 'desc' => 'Borang untuk tuntutan khairat kematian atau bantuan bencana.', 'file' => 'BorangKebajikan.pdf', 'size' => '25.3 KB'],
                    ['title' => 'Borang Tuntutan Perjalanan', 'desc' => 'Borang tuntutan elaun perjalanan bagi aktiviti kesatuan.', 'file' => 'BorangPerjalanan.pdf', 'size' => '18.1 KB'],
                    ['title' => 'Borang Pesanan Buku', 'desc' => 'Borang tempahan buku panduan guru dan rujukan pendidikan.', 'file' => 'BorangBuku.pdf', 'size' => '12.4 KB'],
                    ['title' => 'Borang Permohonan Cuti', 'desc' => 'Borang permohonan cuti penggal atau urusan peribadi guru.', 'file' => 'BorangCuti.pdf', 'size' => '10.5 KB'],
                    ['title' => 'Borang Pendaftaran Kursus', 'desc' => 'Borang pendaftaran bagi kursus kecemerlangan guru STU.', 'file' => 'BorangKursus.pdf', 'size' => '22.9 KB'],
                ];
            @endphp

            @foreach($borangs as $index => $borang)
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 animate-fade-in-up" style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center text-red-400 group-hover:text-red-500 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">{{ $borang['size'] }}</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $borang['title'] }}</h3>
                    <p class="text-gray-500 text-sm mb-8 leading-relaxed">{{ $borang['desc'] }}</p>
                    
                    <a href="{{ asset('pdf/' . $borang['file']) }}" download 
                       class="flex items-center justify-center gap-2 w-full py-3.5 bg-gray-900 hover:bg-primary text-white font-bold rounded-xl transition-all duration-300 group">
                        <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Muat Turun
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Help Section -->
        <div class="mt-20 bg-primary/5 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8 animate-fade-in-up delay-700">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Tidak menjumpai borang yang anda cari?</h2>
                <p class="text-gray-600">Hubungi pejabat STU untuk mendapatkan borang-borang lain atau maklumat lanjut.</p>
            </div>
            <a href="{{ url('/hubungi') }}" class="px-8 py-4 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:scale-105 transition-all duration-300 whitespace-nowrap">
                Hubungi Kami
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Any specific script for muat-turun page
</script>
@endpush

@endsection