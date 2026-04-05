@if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative">
        {{-- Skeleton/Loading Overlay --}}
        <div id="grid-loader" class="absolute inset-0 bg-gray-50/50 backdrop-blur-[1px] z-20 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
            <div class="flex flex-col items-center gap-3">
                <div class="w-10 h-10 border-4 border-green/20 border-t-green rounded-full animate-spin"></div>
                <span class="text-xs font-bold text-green uppercase tracking-widest">Memuatkan...</span>
            </div>
        </div>

        @foreach($posts as $post)
        <div class="group flex flex-col bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden animate-in fade-in duration-700">
            <!-- Image -->
            <div class="relative aspect-video w-full overflow-hidden rounded-[2rem] mb-6 flex-shrink-0">
                @if($post->thumbnail)
                    <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-primary/20 to-primary/40 flex items-center justify-center">
                        <svg class="w-16 h-16 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                @endif
                @if($post->category)
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-green font-bold text-xs rounded-full shadow-sm">
                            {{ $post->category->name }}
                        </span>
                    </div>
                @endif
            </div>
            
            <!-- Content -->
            <div class="px-3 pb-4 flex-grow flex flex-col">
                <div class="flex items-center gap-2 text-gray-400 text-xs font-semibold mb-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}
                </div>
                <h3 class="text-xl font-bold text-gray-900 leading-tight mb-4 group-hover:text-green transition-colors line-clamp-2 min-h-[3rem]">
                    {{ $post->title }}
                </h3>
                <p class="text-gray-500 leading-relaxed text-sm line-clamp-3 mb-8">
                    {{ \App\Helpers\ContentRenderer::getExcerpt($post->content, 120) }}
                </p>
                <div class="mt-auto pt-6 border-t border-gray-50">
                    <a href="{{ route('berita.show', $post->slug) }}" class="group/btn flex items-center gap-2 text-primary font-bold text-sm tracking-tight">
                        Baca Penuh
                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="mt-20 flex justify-center grid-pagination">
            {{ $posts->links('vendor.pagination.custom-berita') }}
        </div>
    @endif

@else
    <div class="text-center py-20 bg-white rounded-[3rem] shadow-sm border border-gray-50 animate-in zoom-in duration-500">
        <svg class="w-20 h-20 mx-auto text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Tiada Artikel Dijumpai</h3>
        <p class="text-gray-400">Cuba cari dengan kata kunci atau kategori yang lain.</p>
        <a href="{{ route('berita.index') }}" class="mt-6 inline-block px-8 py-3 bg-green text-white font-bold rounded-2xl hover:bg-green-600 transition shadow-lg shadow-green/20">Lihat Semua Berita</a>
    </div>
@endif
