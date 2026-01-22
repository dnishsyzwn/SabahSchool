<section class="py-20 bg-gray-50/50 overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green rounded-lg mb-4">
                    <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase">Berita & Artikel</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">Artikel Terkini @ STU</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="#" class="flex items-center gap-2 text-green font-bold hover:underline">
                    Lihat Semua
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Articles Carousel Container -->
        <div class="relative group/carousel">
            <!-- Floating Navigation Buttons -->
            <button id="article-prev" class="absolute -left-4 lg:-left-6 top-1/2 -translate-y-1/2 z-10 p-4 rounded-full bg-white text-gray-700 shadow-xl hover:bg-green hover:text-white transition-all duration-300 opacity-100 lg:opacity-40 lg:group-hover/carousel:opacity-100 disabled:hidden border border-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button id="article-next" class="absolute -right-4 lg:-right-6 top-1/2 -translate-y-1/2 z-10 p-4 rounded-full bg-white text-gray-700 shadow-xl hover:bg-green hover:text-white transition-all duration-300 opacity-100 lg:opacity-40 lg:group-hover/carousel:opacity-100 disabled:hidden border border-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            <div id="articles-slider-container" class="overflow-visible">
                <div id="articles-slider" class="flex transition-transform duration-700 ease-in-out gap-8">
                    @php
                        $articles = [
                            ['title' => 'Seminar Pendidikan 2026', 'desc' => 'Meneroka paradigma baharu dalam sistem pengajaran digital untuk guru-guru di seluruh Sabah.', 'img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655'],
                            ['title' => 'Kebajikan Guru Sabah', 'desc' => 'Inisiatif baharu STU dalam memastikan kebajikan dan perlindungan ahli sentiasa diutamakan.', 'img' => 'https://images.unsplash.com/photo-1544717297-fa95b33c0317'],
                            ['title' => 'Teknologi Masa Kini', 'desc' => 'Bagaimana mengintegrasikan AI dalam bilik darjah untuk pembelajaran yang lebih efektif.', 'img' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7'],
                            ['title' => 'Kepimpinan Pendidikan', 'desc' => 'Membina barisan kepimpinan sekolah yang dinamik dan berwawasan tinggi.', 'img' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952'],
                            ['title' => 'Inovasi PDPR', 'desc' => 'Strategi pengajaran kreatif untuk menarik minat pelajar dalam era hibrid.', 'img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3'],
                            ['title' => 'Kesihatan Mental Guru', 'desc' => 'Menangani tekanan kerja dan mengekalkan kesihatan mental yang optima.', 'img' => 'https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e'],
                            ['title' => 'Kurikulum Baharu', 'desc' => 'Persediaan guru-guru Sabah terhadap semakan kurikulum kebangsaan akan datang.', 'img' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6'],
                            ['title' => 'Biasiswa Pengajian', 'desc' => 'Peluang biasiswa untuk guru yang ingin melanjutkan pelajaran ke peringkat Master/PhD.', 'img' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1'],
                            ['title' => 'Hari Guru Sabah', 'desc' => 'Sambutan gilang-gemilang menghargai jasa pendidik di seluruh negeri.', 'img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18']
                        ];
                    @endphp

                    @foreach($articles as $article)
                        <div class="article-slide flex-[0_0_100%] md:flex-[0_0_calc(50%-16px)] lg:flex-[0_0_calc(33.333%-21.33px)]">
                            <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group cursor-pointer h-full flex flex-col">
                                <!-- Image Container -->
                                <div class="relative h-64 w-full overflow-hidden rounded-[2rem] mb-6 flex-shrink-0">
                                    <img src="{{ $article['img'] }}?q=80&w=2070&auto=format&fit=crop" 
                                         alt="{{ $article['title'] }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </div>
                                
                                <!-- Content -->
                                <div class="px-2 pb-2 flex-grow flex flex-col">
                                    <div class="flex items-center gap-2 mb-3">
                                        <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $article['title'] }}</h3>
                                        <svg class="w-5 h-5 text-green flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 leading-relaxed mb-6 text-sm line-clamp-2">
                                        {{ $article['desc'] }}
                                    </p>

                                    <!-- Footer -->
                                    <div class="mt-auto border-t border-gray-50 pt-6 flex justify-center">
                                        <button class="bg-gray-50 hover:bg-green hover:text-white transition-colors duration-300 rounded-full px-8 py-2.5 font-bold text-gray-900 border border-gray-100 text-sm">
                                            Baca Lagi +
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Indicators Container (Will be populated by JS) -->
        <div id="articles-indicators" class="flex justify-center gap-3 mt-12">
            <!-- Indicators injected here -->
        </div>
    </div>
</section>
