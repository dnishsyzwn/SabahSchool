@extends('layouts.app')

@section('title', 'Berita & Artikel | STU')

@push('styles')
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-primary overflow-hidden pt-20">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/berita-hero.png') }}" alt="Berita & Artikel" class="w-full h-full object-cover">
            <!-- Premium Gradient Overlays -->
            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-transparent to-primary/40"></div>
            
            <!-- Abstract Blur Accents -->
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2 opacity-60"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-green/5 rounded-full blur-[80px] translate-y-1/3 -translate-x-1/4"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-16">
            <div class="max-w-4xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/20 text-secondary rounded-lg mb-6 border border-secondary/30 backdrop-blur-sm">
                    <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase">Terkini & Arkib</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Berita & Artikel <br>
                    <span class="text-secondary italic">Pusat Informasi</span>
                </h1>
                <p class="text-lg text-gray-300 max-w-2xl leading-relaxed">
                    Ikuti perkembangan terbaru mengenai STU, inisiatif pendidikan, dan artikel bermanfaat untuk warga pendidik di Sabah.
                </p>
            </div>
        </div>

    </section>

    <!-- News List Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search & Filters -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-16">
                <!-- Filter Control Section -->
                <div class="flex flex-col lg:flex-row items-stretch lg:items-end gap-6">
                    <!-- Text Search group -->
                    <div class="flex-grow">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2 ml-1">Carian Berita</label>
                        <div class="relative group">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                   placeholder="Cari tajuk atau artikel..."
                                   class="w-full pl-6 pr-24 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 outline-none text-gray-600 font-medium">
                            <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-green text-white rounded-xl hover:bg-green-600 transition-colors font-semibold">
                                Cari
                            </button>
                        </div>
                    </div>

                    <!-- Date Filters Group -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-6 w-full lg:w-auto">
                        <!-- From Date -->
                        <div class="relative flex-1">
                            <label for="from_date" class="block text-sm font-medium text-gray-700 mb-2 ml-1">Dari Tarikh</label>
                            <input type="text" 
                                id="from_date" 
                                name="from_date"
                                value="{{ request('from_date') }}"
                                class="datepicker-from w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 outline-none text-gray-600 font-medium cursor-pointer"
                                placeholder="dd/mm/yyyy"
                                readonly>
                            <div class="absolute left-4 top-[46px] text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Divider Arrow (Hidden on small screens) -->
                        <div class="hidden lg:flex items-center pt-8 text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>

                        <!-- Date Input Group: Hingga -->
                        <div class="relative flex-1">
                            <label for="to_date" class="block text-sm font-medium text-gray-700 mb-2 ml-1">Hingga Tarikh</label>
                            <input type="text" 
                                id="to_date" 
                                name="to_date"
                                value="{{ request('to_date') }}"
                                class="datepicker-to w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 outline-none text-gray-600 font-medium cursor-pointer"
                                placeholder="dd/mm/yyyy"
                                readonly>
                            <div class="absolute left-4 top-[46px] text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>

                        <!-- Filter Submit Button -->
                        <button type="submit" class="w-full sm:w-auto p-4 bg-primary text-white rounded-2xl shadow-lg shadow-primary/20 hover:bg-primary-900 transition-all duration-300 hover:-translate-y-1 active:scale-95 flex-shrink-0 flex items-center justify-center gap-2 group">
                            <span class="sm:hidden font-semibold">Tapis Keputusan</span>
                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $articles = [
                        ['title' => 'Seminar Pendidikan 2026', 'desc' => 'Meneroka paradigma baharu dalam sistem pengajaran digital untuk guru-guru di seluruh Sabah.', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655', 'date' => '15 Jan 2026', 'category' => 'Pendidikan'],
                        ['title' => 'Kebajikan Guru Sabah', 'desc' => 'Inisiatif baharu STU dalam memastikan kebajikan dan perlindungan ahli sentiasa diutamakan.', 'img' => 'https://images.unsplash.com/photo-1590650153855-d9e808231d41', 'date' => '12 Jan 2026', 'category' => 'Kebajikan'],
                        ['title' => 'Teknologi Masa Kini', 'desc' => 'Bagaimana mengintegrasikan AI dalam bilik darjah untuk pembelajaran yang lebih efektif.', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7', 'date' => '10 Jan 2026', 'category' => 'Pendidikan'],
                        ['title' => 'Kepimpinan Pendidikan', 'desc' => 'Membina barisan kepimpinan sekolah yang dinamik dan berwawasan tinggi.', 'img' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952', 'date' => '08 Jan 2026', 'category' => 'Berita STU'],
                        ['title' => 'Inovasi PDPR', 'desc' => 'Strategi pengajaran kreatif untuk menarik minat pelajar dalam era hibrid.', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3', 'date' => '05 Jan 2026', 'category' => 'Pendidikan'],
                        ['title' => 'Kesihatan Mental Guru', 'desc' => 'Menangani tekanan kerja dan mengekalkan kesihatan mental yang optima.', 'img' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e', 'date' => '01 Jan 2026', 'category' => 'Kebajikan'],
                        ['title' => 'Kurikulum Baharu', 'desc' => 'Persediaan guru-guru Sabah terhadap semakan kurikulum kebangsaan akan datang.', 'img' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6', 'date' => '28 Dis 2025', 'category' => 'Pendidikan'],
                        ['title' => 'Biasiswa Pengajian', 'desc' => 'Peluang biasiswa untuk guru yang ingin melanjutkan pelajaran ke peringkat Master/PhD.', 'img' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644', 'date' => '25 Dis 2025', 'category' => 'Kebajikan'],
                        ['title' => 'Hari Guru Sabah', 'desc' => 'Sambutan gilang-gemilang menghargai jasa pendidik di seluruh negeri.', 'img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18', 'date' => '20 Dis 2025', 'category' => 'Berita STU']
                    ];
                @endphp

                @foreach($articles as $article)
                <div class="group flex flex-col bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
                    <!-- Image Container -->
                    <div class="relative h-64 w-full overflow-hidden rounded-[2rem] mb-6 flex-shrink-0">
                        <img src="{{ $article['img'] }}?q=80&w=2070&auto=format&fit=crop" 
                             alt="{{ $article['title'] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-green font-bold text-xs rounded-full shadow-sm">
                                {{ $article['category'] }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="px-3 pb-4 flex-grow flex flex-col">
                        <div class="flex items-center gap-2 text-gray-400 text-xs font-semibold mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $article['date'] }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 leading-tight mb-4 group-hover:text-green transition-colors">
                            {{ $article['title'] }}
                        </h3>
                        <p class="text-gray-500 leading-relaxed text-sm line-clamp-3 mb-8">
                            {{ $article['desc'] }}
                        </p>

                        <!-- Footer -->
                        <div class="mt-auto pt-6 border-t border-gray-50">
                            <a href="#" class="inline-flex items-center gap-2 text-green font-bold text-sm hover:gap-3 transition-all">
                                Baca Artikel Penuh
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination Placeholder -->
            <div class="mt-20 flex justify-center items-center gap-2">
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-100 text-gray-400 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-green text-white font-bold shadow-lg shadow-green/20">1</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition-colors">2</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition-colors">3</button>
                <span class="px-2 text-gray-400 font-bold">...</span>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-100 text-gray-600 font-bold hover:bg-gray-50 transition-colors">12</button>
                <button class="w-12 h-12 flex items-center justify-center rounded-xl bg-white border border-gray-100 text-gray-400 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </section>

   
@endsection

@push('scripts')
@endpush
