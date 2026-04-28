@if($news->count() > 0)
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center my-0">
        <div class="h-px w-full bg-linear-to-r from-transparent via-gray-400 to-transparent"></div>
    </div>
    <section class="py-20 bg-gray-100/60 overflow-hidden">
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
                    <a href="{{ route('berita.index') }}"
                        class="flex items-center gap-2 text-green font-bold hover:underline">
                        Lihat Semua
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Articles Carousel Container -->
            <div class="relative group/carousel">
                @if($news->count() > 3)
                    <!-- Floating Navigation Buttons -->
                    <button id="article-prev"
                        class="absolute -left-4 lg:-left-6 top-1/2 -translate-y-1/2 z-10 p-4 rounded-full bg-white text-gray-700 shadow-xl hover:bg-green hover:text-white transition-all duration-300 opacity-100 lg:opacity-40 lg:group-hover/carousel:opacity-100 disabled:hidden border border-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button id="article-next"
                        class="absolute -right-4 lg:-right-6 top-1/2 -translate-y-1/2 z-10 p-4 rounded-full bg-white text-gray-700 shadow-xl hover:bg-green hover:text-white transition-all duration-300 opacity-100 lg:opacity-40 lg:group-hover/carousel:opacity-100 disabled:hidden border border-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                @endif

                <div id="{{ $news->count() > 3 ? 'articles-slider-container' : '' }}" class="overflow-hidden">
                    <div id="{{ $news->count() > 3 ? 'articles-slider' : '' }}" 
                         class="flex flex-row flex-nowrap gap-8 transition-transform duration-700 ease-in-out">
                        @foreach($news as $index => $article)
                            <div
                                class="article-slide flex-shrink-0 {{ $index >= 6 ? 'hidden md:flex' : 'flex' }} w-full md:w-[calc(33.333%-21.33px)]">
                                <div
                                    class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-500 group h-full flex flex-col">
                                    <!-- Image Container -->
                                    <div class="relative h-64 w-full overflow-hidden rounded-[2rem] mb-6 flex-shrink-0">
                                        <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://placehold.co/600x400/001a6e/feb21a?text=' . urlencode($article->title) }}"
                                            alt="{{ $article->title }}"
                                            width="600"
                                            height="400"
                                            loading="lazy"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    </div>
                                
                                    <!-- Content -->
                                    <div class="px-2 pb-2 flex-grow flex flex-col text-left">
                                        <div class="flex items-center gap-2 mb-3">
                                            <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $article->title }}</h3>
                                        </div>
                                        <p class="text-gray-500 leading-relaxed mb-6 text-sm line-clamp-2">
                                            {{ $article->excerpt_plain_text }}
                                        </p>
                                    </div>
                                
                                    <!-- Footer -->
                                    <div class="mt-auto border-t border-gray-50 pt-6 flex justify-center">
                                        <a href="{{ route('berita.show', $article->slug) }}"
                                            class="bg-gray-50 hover:bg-green hover:text-white transition-colors duration-300 rounded-full px-8 py-2.5 font-bold text-gray-900 border border-gray-100 text-sm">
                                            Baca Lagi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if($news->count() > 3)
                <!-- Indicators Container (Will be populated by JS) -->
                <div id="articles-indicators" class="flex justify-center gap-3 mt-12">
                    <!-- Indicators injected here -->
                </div>
            @endif
        </div>
    </section>
@endif