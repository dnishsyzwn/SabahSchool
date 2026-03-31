@extends('layouts.app')

@section('title', $post->title . ' | STU')

@section('content')
    <!-- Hero Header -->
    <section class="relative min-h-[40vh] flex items-center bg-primary overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            @if($post->thumbnail)
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('images/berita-hero.png') }}" alt="Berita" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/40 to-primary/20"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-12">
            <div class="max-w-3xl">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-secondary hover:text-white transition-colors mb-8 group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-bold text-sm tracking-wide uppercase">Kembali ke Senarai Berita</span>
                </a>
                
                @if($post->category)
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/20 text-secondary rounded-lg mb-6 border border-secondary/30 backdrop-blur-sm">
                        <span class="text-xs font-bold tracking-wider uppercase">{{ $post->category->name }}</span>
                    </div>
                @endif
                
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-gray-300 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $post->published_at?->translatedFormat('d F Y') ?? $post->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    @if($post->author)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Oleh: {{ $post->author->name }}</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ number_format($post->view_count) }} Paparan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                
                <!-- Article Content (75%) -->
                <div class="w-full lg:w-3/4">
                    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                        
                        {{-- Featured Thumbnail Image --}}
                        @if($post->thumbnail)
                            <div class="relative rounded-3xl overflow-hidden mb-12 aspect-video gallery-trigger shadow-lg ring-1 ring-black/5">
                                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif

                        {{-- Article Body --}}
                        <div class="prose prose-lg max-w-none 
                                    prose-p:text-gray-600 prose-p:leading-relaxed
                                    prose-headings:text-primary prose-headings:font-bold
                                    prose-strong:text-primary
                                    prose-blockquote:border-secondary prose-blockquote:bg-primary/5 prose-blockquote:rounded-r-2xl
                                    prose-img:rounded-2xl prose-img:shadow-md
                                    prose-a:text-secondary prose-a:font-semibold
                                    prose-ul:text-gray-600 prose-li:marker:text-secondary">
                            {!! \App\Helpers\ContentRenderer::render($post->content) !!}
                        </div>

                        <!-- Article Footer -->
                        <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap items-center justify-between gap-6">
                            <div class="flex items-center gap-3">
                                @if($post->category)
                                    <span class="text-sm font-bold text-gray-500 uppercase">Kategori:</span>
                                    <span class="px-3 py-1 bg-secondary/10 text-secondary text-xs font-bold rounded-lg uppercase tracking-wider">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Share Buttons -->
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-gray-500 uppercase">Kongsi:</span>
                                <div class="flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                                       class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank"
                                       class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-green hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    </a>
                                    <button onclick="navigator.clipboard.writeText(window.location.href).then(()=>alert('Pautan disalin!'))"
                                            class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (25%) -->
                <div class="w-full lg:w-1/4">
                    <div class="sticky top-24 space-y-8">
                        
                        <!-- Category Widget -->
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-secondary rounded-full"></span>
                                Kategori
                            </h3>
                            <div class="space-y-3">
                                @foreach(\App\Models\NewsCategory::withCount(['posts' => fn($q) => $q->where('status','published')])->having('posts_count','>',0)->get() as $cat)
                                    <a href="{{ route('berita.index', ['category' => $cat->id]) }}"
                                       class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-primary hover:text-white transition-all group {{ $post->category_id == $cat->id ? 'bg-primary text-white' : '' }}">
                                        <span class="font-bold">{{ $cat->name }}</span>
                                        <span class="px-2 py-1 bg-white text-primary text-xs font-bold rounded-lg group-hover:bg-secondary/20 group-hover:text-secondary tracking-wider">{{ $cat->posts_count }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Recent News Widget -->
                        @if($recentPosts->count() > 0)
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-secondary rounded-full"></span>
                                Berita Terkini
                            </h3>
                            <div class="space-y-6">
                                @foreach($recentPosts as $recent)
                                <a href="{{ route('berita.show', $recent->slug) }}" class="flex gap-4 group">
                                    <div class="w-24 aspect-video rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                                        @if($recent->thumbnail)
                                            <img src="{{ Storage::url($recent->thumbnail) }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full bg-primary/10 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="text-[10px] font-bold text-secondary mb-1">{{ $recent->published_at?->format('d M Y') }}</span>
                                        <h4 class="text-xs font-bold text-primary group-hover:text-secondary transition-colors line-clamp-2 leading-snug">{{ $recent->title }}</h4>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related News -->
    @if($related->count() > 0)
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-primary mb-12">Berita Berkaitan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($related as $rel)
                <div class="group bg-gray-50 rounded-[2.5rem] p-6 border border-gray-100 hover:bg-white hover:shadow-xl hover:shadow-primary/5 transition-all duration-500 hover:-translate-y-2">
                    <div class="relative rounded-3xl overflow-hidden mb-6 aspect-video bg-gray-200">
                        @if($rel->thumbnail)
                            <img src="{{ Storage::url($rel->thumbnail) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @endif
                    </div>
                    <div class="flex items-center gap-3 mb-4">
                        @if($rel->category)
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider">{{ $rel->category->name }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                        @endif
                        <span class="text-xs font-medium text-gray-500">{{ $rel->published_at?->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-4 line-clamp-2 group-hover:text-secondary transition-colors leading-snug">
                        {{ $rel->title }}
                    </h3>
                    <a href="{{ route('berita.show', $rel->slug) }}" class="inline-flex items-center gap-2 text-primary font-bold text-sm group/btn">
                        Baca Penuh
                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
