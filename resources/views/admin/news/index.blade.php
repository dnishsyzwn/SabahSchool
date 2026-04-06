@extends('admin.layouts.app')

@section('title', 'Pengurusan Berita')
@section('header', 'Pengurusan Berita')

@section('actions')
    <a href="{{ route('admin.news.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Artikel
    </a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden transition-all duration-500">
    
    {{-- Advanced Filter Bar --}}
    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex-1 w-full">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-1">Cari & Tapis</h2>
            <p class="text-[10px] text-gray-400 font-medium">Urus dan tapis senarai artikel berita anda dengan pantas</p>
        </div>

        <form id="filter-form" method="GET" action="{{ route('admin.news.index') }}" class="flex flex-col sm:flex-row flex-[2] gap-3 w-full">
            {{-- Dynamic Search --}}
            <div class="relative flex-1 group">
                <input type="text" name="search" id="search-input" value="{{ request('search') }}" 
                       placeholder="Cari tajuk atau kandungan..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-100 bg-white rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300">
                <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            {{-- Status Filter --}}
            <div class="sm:w-48 group">
                <select name="status" id="status-filter" 
                        class="w-full px-4 py-2.5 text-sm border border-gray-100 bg-white rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Terbit (Published)</option>
                    <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draf (Draft)</option>
                    <option value="archived"  {{ request('status') === 'archived'  ? 'selected' : '' }}>Arkib (Archived)</option>
                </select>
            </div>

            <input type="hidden" name="sort" id="sort-input" value="{{ request('sort', 'created_at') }}">
            <input type="hidden" name="direction" id="direction-input" value="{{ request('direction', 'desc') }}">

            <button type="submit" class="hidden">Cari</button>

            @if(request('search') || request('status') || request('sort'))
                <a href="{{ route('admin.news.index') }}" 
                   class="px-5 py-2.5 bg-gray-100 text-gray-600 text-xs font-black rounded-xl hover:bg-gray-200 transition uppercase tracking-widest flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- AJAX Table Container --}}
    <div id="table-container">
        @include('admin.news.partials.table')
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let searchTimeout;

    // ══ AJAX Table Core ══
    async function fetchTable(url) {
        const container = document.getElementById('table-container');
        const loader = document.getElementById('table-loader');
        
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
            
            // Update URL
            window.history.pushState(null, '', url);
        } catch (error) {
            console.error('Fetch error:', error);
            Swal.fire({ icon: 'error', title: 'Ralat', text: 'Gagal memuatkan data. Sila cuba lagi.' });
        } finally {
            if(loader) {
                loader.style.opacity = '0';
                loader.style.pointerEvents = 'none';
            }
        }
    }

    function buildUrl() {
        const form = document.getElementById('filter-form');
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);
        return `${form.action}?${params.toString()}`;
    }

    function bindDynamicEvents() {
        // Handle pagination links
        document.querySelectorAll('.table-pagination a').forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                fetchTable(link.href);
            });
        });
    }

    // ══ Sorting ══
    function sort(column) {
        const sortInput = document.getElementById('sort-input');
        const dirInput = document.getElementById('direction-input');
        
        if (sortInput.value === column) {
            dirInput.value = dirInput.value === 'asc' ? 'desc' : 'asc';
        } else {
            sortInput.value = column;
            dirInput.value = 'asc';
        }
        
        fetchTable(buildUrl());
    }

    // ══ Filter Listeners ══
    document.getElementById('search-input').addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            fetchTable(buildUrl());
        }, 500); // 500ms debounce
    });

    document.getElementById('status-filter').addEventListener('change', () => {
        fetchTable(buildUrl());
    });

    document.getElementById('filter-form').addEventListener('submit', e => {
        e.preventDefault();
        fetchTable(buildUrl());
    });

    // ══ Browser Back Button ══
    window.addEventListener('popstate', () => {
        location.reload(); // Simplest way to handle back/forward correctly for now
    });

    // ══ Delete Confirmation (Standardized) ══
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Padam Artikel?',
            html: `Adakah anda pasti ingin memadam artikel <strong>"${title}"</strong>? Tindakan ini tidak boleh dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl shadow-2xl',
                confirmButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest',
                cancelButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/news/${id}`;
                form.submit();
            }
        });
    }

    // Initial binding
    document.addEventListener('DOMContentLoaded', bindDynamicEvents);
</script>

<form id="delete-form" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endpush
