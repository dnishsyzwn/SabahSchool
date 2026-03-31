@extends('layouts.app')

@section('title', 'Berita & Artikel | STU')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[50vh] flex items-center bg-primary overflow-hidden pt-20">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/berita-hero.png') }}" alt="Berita & Artikel" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-transparent to-primary/40"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2 opacity-60"></div>
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
            <form method="GET" action="{{ route('berita.index') }}" class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-16">
                <div class="flex flex-col lg:flex-row items-stretch lg:items-end gap-6">
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
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2 ml-1">Kategori</label>
                        <select id="category" name="category" onchange="this.form.submit()"
                                class="w-full px-5 py-4 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-gray-600 font-medium">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->posts_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if(request('search') || request('category'))
                        <a href="{{ route('berita.index') }}" class="px-6 py-4 bg-gray-100 text-gray-600 font-semibold rounded-2xl hover:bg-gray-200 transition whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Articles Grid -->
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                    <div class="group flex flex-col bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden">
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
                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-4 group-hover:text-green transition-colors">
                                {{ $post->title }}
                            </h3>
                            <p class="text-gray-500 leading-relaxed text-sm line-clamp-3 mb-8">
                                {{ $post->excerpt ?? strip_tags(Str::limit($post->content, 200)) }}
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
                    <div class="mt-20 flex justify-center">
                        {{ $posts->withQueryString()->links('vendor.pagination.custom-berita') }}
                    </div>
                @endif

            @else
                <div class="text-center py-20">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <h3 class="text-2xl font-bold text-gray-500 mb-2">Tiada Artikel Dijumpai</h3>
                    <p class="text-gray-400">Cuba cari dengan kata kunci yang lain.</p>
                    <a href="{{ route('berita.index') }}" class="mt-4 inline-block text-green font-semibold hover:underline">Lihat semua berita</a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
@endpush
