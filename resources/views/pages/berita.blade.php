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

            <!-- Articles Grid Container -->
            <div id="articles-container" class="relative">
                @include('pages.partials.news-grid')
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    let searchTimeout;

    // ══ AJAX News Fetch Engine ══
    async function fetchNews(url) {
        const container = document.getElementById('articles-container');
        const loader = document.getElementById('grid-loader');
        
        // Show loader
        if(loader) {
            loader.style.opacity = '1';
            loader.style.pointerEvents = 'auto';
        }

        try {
            const response = await fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const html = await response.text();
            container.innerHTML = html;
            
            // Re-bind pagination and sorting
            bindDynamicEvents();
            
            // Update URL for sharing
            window.history.pushState(null, '', url);
        } catch (error) {
            console.error('Fetch error:', error);
        } finally {
            if(loader) {
                loader.style.opacity = '0';
                loader.style.pointerEvents = 'none';
            }
        }
    }

    function buildUrl() {
        const search = document.getElementById('search').value;
        const category = document.getElementById('category').value;
        const url = new URL(window.location.origin + window.location.pathname);
        
        if(search) url.searchParams.set('search', search);
        if(category) url.searchParams.set('category', category);
        
        return url.toString();
    }

    function bindDynamicEvents() {
        // Handle pagination links
        document.querySelectorAll('.grid-pagination a').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                fetchNews(link.href);
            });
        });
    }

    // ══ Filter Listeners ══
    document.getElementById('search').addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchNews(buildUrl());
        }, 500); // 500ms debounce
    });

    document.getElementById('category').addEventListener('change', () => {
        fetchNews(buildUrl());
    });

    // Prevent default form submit
    document.querySelector('form').addEventListener('submit', e => {
        e.preventDefault();
        fetchNews(buildUrl());
    });

    // ══ Browser Back Button ══
    window.addEventListener('popstate', () => {
        location.reload();
    });

    // Initial binding
    document.addEventListener('DOMContentLoaded', bindDynamicEvents);
</script>
@endpush
