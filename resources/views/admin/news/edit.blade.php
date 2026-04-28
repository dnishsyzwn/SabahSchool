@extends('admin.layouts.app')
@section('title', 'Kemaskini Artikel')
@section('header', Str::limit($news->title, 45))

@section('actions')
<div class="flex gap-2">
    <button type="button" id="btn-preview"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Preview
    </button>
    @if($news->status === 'published')
    <a href="{{ route('berita.show', $news->slug) }}" target="_blank"
       class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-lg hover:bg-emerald-100 transition border border-emerald-100 shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        Laman Awam
    </a>
    @endif
    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
<style>
    /* ── Editor Basics ── */
    #editorjs { min-height: 500px; }
    .codex-editor__redactor { padding-bottom: 150px !important; }
    .ce-block__content { max-width: 100% !important; margin: 0 !important; padding: 2px 60px 2px 10px !important; }
    .ce-toolbar__content { max-width: 100% !important; margin: 0 !important; }
    .ce-toolbar__actions { right: 0; }
    .ce-paragraph { line-height: 1.8; color: #374151; font-size: 1.05rem; }

    /* ── Heading Styling ── */
    #editorjs h2 { font-size: 1.875rem !important; font-weight: 800 !important; color: #1e3a5f !important; border-bottom: 2px solid #f3f4f6; padding-bottom: 8px; margin-top: 10px; }
    #editorjs h3 { font-size: 1.4rem !important; font-weight: 700 !important; color: #1e3a5f !important; margin-top: 5px; }
    #editorjs h4 { font-size: 1.15rem !important; font-weight: 600 !important; color: #374151 !important; }

    /* ── Custom Image Block ── */
    @keyframes cimg-spin { to { transform: rotate(360deg); } }
    .cimg-spinner { width:28px; height:28px; border:3px solid #f3f4f6; border-top-color:#3b82f6; border-radius:50%; animation:cimg-spin .8s linear infinite; }
    .cimg-upload-label { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:10px; padding:40px 20px; border:2px dashed #e5e7eb; border-radius:16px; cursor:pointer; color:#9ca3af; background:#fafafa; transition:all .2s; }
    .cimg-upload-label:hover { border-color:#3b82f6; background:#f0f7ff; color:#3b82f6; }
    .cimg-toolbar { display:flex; align-items:center; gap:8px; margin-bottom:12px; padding:6px 10px; background:#f9fafb; border-radius:10px; border:1px solid #f3f4f6; flex-wrap:wrap; }
    .cimg-ctrl-btn { padding:3px 8px; font-size:10px; font-weight:700; border-radius:6px; border:1px solid #e5e7eb; background:white; color:#4b5563; cursor:pointer; transition:.15s; }
    .cimg-ctrl-btn.active { border-color:#3b82f6; background:#3b82f6; color:white; }
    .cimg-align-btn { width:26px; height:26px; border-radius:6px; border:1px solid #e5e7eb; background:white; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:.15s; color:#4b5563; }
    .cimg-align-btn.active { border-color:#3b82f6; background:#eff6ff; color:#3b82f6; }

    /* ── Gallery Block ── */
    .gallery-block { border: 2px dashed #e5e7eb; border-radius: 18px; padding: 15px; margin: 10px 0; background: #fff; }
    .gallery-img-wrap { position: relative; border-radius: 12px; overflow: hidden; background: #f9fafb; border: 1px solid #f3f4f6; }
    .gallery-del-btn { position: absolute; top: 6px; right: 6px; width: 24px; height: 24px; background: rgba(239, 68, 68, 0.9); color: white; border: none; border-radius: 50%; cursor: pointer; font-size: 12px; display: flex; align-items: center; justify-content: center; z-index: 10; backdrop-filter: blur(4px); transition: .2s; }
    .gallery-del-btn:hover { transform: scale(1.1); background: #ef4444; }
    .gallery-caption-inp { width: 100%; padding: 6px 10px; font-size: 11px; border: none; border-top: 1px solid #f3f4f6; background: white; outline: none; color: #4b5563; font-style: italic; }
    .gallery-hdr-controls { display:flex; align-items:center; gap:10px; flex-wrap:wrap; }

    /* ── Custom List Drag Selection ── */
    .cdx-nested-list__item-content.custom-selected-list-item { background-color: #e8f0fe !important; border-radius: 3px; }

    /* ── Modals (Google Style) ── */
    #crop-modal, #preview-modal, #cat-modal { 
        display: none; 
        backdrop-filter: blur(8px);
        background: rgba(15, 23, 42, 0.6);
    }
    #crop-modal.open, #preview-modal.open, #cat-modal.open { display: flex; }
    
    .modal-card {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ── Category Dropdown (Premium) ── */
    #cat-dropdown-menu {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform-origin: top;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #cat-dropdown-menu.hidden {
        display: none;
        transform: scale(0.95);
        opacity: 0;
    }
    #cat-dropdown-menu:not(.hidden) {
        display: block;
        transform: scale(1);
        opacity: 1;
    }

    .cat-item-active {
        background-color: #eff6ff;
        color: #2563eb;
        font-weight: 700;
    }

    /* Sidebar Layout Fix for Sticky */
    .lg\:sticky {
        align-self: start;
    }

    /* ── Status Card Active State ── */
    input:checked + .status-card {
        border-color: #2563eb !important;
        background-color: #eff6ff !important;
    }
    input:checked + .status-card .status-icon {
        background-color: #2563eb !important;
        color: #ffffff !important;
    }
    input:checked + .status-card .status-check {
        display: flex !important;
    }
    input:checked + .status-card p.text-gray-800 {
        color: #1e3a8a !important;
    }
</style>
@endpush

@section('content')
@php
    $safeContent = null;
    if (!empty($news->content)) {
        $decoded = json_decode($news->content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $safeContent = $decoded;
        } else {
            // If it's not JSON, it might be legacy HTML
            $safeContent = ['blocks' => [['type' => 'paragraph', 'data' => ['text' => $news->content]]]];
        }
    }
@endphp



<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" id="news-form">
    @csrf @method('PUT')
    <input type="hidden" id="content-input" name="content" value="{{ old('content', $news->content) }}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-8 items-start">

        {{-- Left: Content --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                {{-- Thumbnail moved here --}}
                <div class="mb-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Visual Utama (Thumbnail)</p>
                    @php
                        $thumbUrl = old('thumbnail_url', $news->thumbnail ? Storage::url($news->thumbnail) : '');
                    @endphp
                    <div id="thumb-wrap" class="{{ $thumbUrl ? '' : 'hidden' }} mb-4 relative group rounded-2xl overflow-hidden border border-gray-100 aspect-video bg-gray-50 max-w-2xl mx-auto">
                        <img id="thumb-preview" src="{{ $thumbUrl }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <button type="button" id="btn-rm-thumb" class="bg-white/20 backdrop-blur-md text-white p-3 rounded-full hover:bg-red-500 transition shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <label for="thumbnail" id="thumb-label" style="{{ $thumbUrl ? 'display:none' : '' }}" class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-gray-200 rounded-2xl py-12 cursor-pointer text-gray-400 hover:border-blue-400 hover:text-blue-500 hover:bg-blue-50/30 transition group max-w-2xl mx-auto">
                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-blue-50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold uppercase tracking-wide">Tukar Visual Utama</p>
                            <p class="text-[10px] text-gray-300 mt-1">JPG, PNG, WEBP (Nisbah 16:9 disyorkan)</p>
                        </div>
                        <input type="file" id="thumbnail" accept="image/*" class="hidden">
                        <input type="hidden" name="thumbnail_url" id="thumbnail_url" value="{{ old('thumbnail_url', $news->thumbnail ? Storage::url($news->thumbnail) : '') }}">
                    </label>
                </div>

                <div class="border-t border-gray-50 pt-8">
                    <label for="title" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-3">Tajuk Artikel <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                           class="w-full px-0 py-2 text-3xl font-extrabold border-0 border-b-2 border-gray-100 focus:border-blue-500 outline-none text-gray-900 bg-transparent transition placeholder:text-gray-200"
                           placeholder="Masukkan tajuk di sini...">
                    @error('title') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-6">
                <!-- Formatting Tip -->
                <div class="bg-blue-50/70 border-b border-blue-100 p-4 flex items-start gap-4 rounded-t-2xl">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center flex-shrink-0 text-blue-600 shadow-sm border border-blue-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-extrabold text-blue-900 mb-0.5">Tips Menghias Kandungan</h4>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            <strong>Highlight/Pilih Tulisan</strong> untuk menukar warna, tebal (bold), atau menambah garis bawah. 
                            Gunakan <code class="bg-white px-1.5 py-0.5 rounded border border-blue-200 font-bold mx-0.5">Cmd/Ctrl + Shift + V</code> untuk menampal sebagai teks biasa (*plain text*).
                        </p>
                    </div>
                </div>

                <div class="px-8 py-4 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">Kandungan Utama</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Edit dan susun kandungan anda menggunakan blok EditorJS</p>
                    </div>
                    <div class="flex items-center gap-1.5 bg-white p-1 rounded-lg border border-gray-100 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                        <button type="button" id="btn-undo" class="flex items-center justify-center p-1.5 rounded transition text-gray-400 hover:text-blue-600 hover:bg-blue-50 disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-gray-400 disabled:cursor-not-allowed" title="Undo / Undur (Cmd+Z)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                        </button>
                        <div class="w-px h-4 bg-gray-200"></div>
                        <button type="button" id="btn-redo" class="flex items-center justify-center p-1.5 rounded transition text-gray-400 hover:text-blue-600 hover:bg-blue-50 disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-gray-400 disabled:cursor-not-allowed" title="Redo / Maju (Cmd+Y)">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"></path></svg>
                        </button>
                    </div>
                </div>
                <div id="editorjs" class="px-8 py-6 relative z-10"></div>
                @error('content') <p class="text-red-500 text-xs px-8 pb-4 font-medium">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Right: Settings (Sticky) --}}
        <div class="space-y-6 lg:sticky lg:top-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Klasifikasi Kategori</p>
                {{-- Modern Category Selector (Redesigned) --}}
                <div class="relative" id="cat-dropdown-container">
                    <div class="group">
                        <label class="block text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Kategori Utama</label>
                        <button type="button" onclick="toggleCatDropdown(event)" id="cat-trigger" 
                                class="w-full flex items-center justify-between px-4 py-3 text-sm border border-gray-200 bg-white rounded-xl hover:border-blue-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                                <span id="cat-label" class="text-gray-700 font-semibold truncate max-w-[150px]">
                                    {{ $news->category?->name ?? 'Pilih Kategori' }}
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-transform duration-300" id="cat-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>

                    <div id="cat-dropdown-menu" class="absolute z-[100] mt-2 w-full bg-white rounded-2xl border border-gray-100 hidden">
                        <div class="p-2">
                            <div class="relative mb-1">
                                <input type="text" id="cat-search" placeholder="Cari..." 
                                       class="w-full pl-9 pr-4 py-2 text-sm border-0 bg-gray-50 rounded-xl focus:ring-0 outline-none transition placeholder:text-gray-400">
                                <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            
                            <div id="cat-options" class="max-h-56 overflow-y-auto space-y-0.5 custom-scrollbar p-1">
                                {{-- Categories injected via JS --}}
                            </div>

                            <div class="mt-1 pt-1 border-t border-gray-50">
                                <button type="button" onclick="openCategoryModal(event)" class="w-full py-2.5 text-[10px] font-bold text-blue-600 hover:bg-blue-50 rounded-xl transition uppercase tracking-wider flex items-center justify-center gap-2">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    Urus Kategori
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="category_id" id="category_id_val" value="{{ old('category_id', $news->category_id) }}">
                @error('category_id') <p class="text-red-500 text-[10px] mt-2 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Status & Visibiliti</p>
                @php
                    $availableStatuses = [
                        'draft'     => ['Draf', 'amber', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                        'published' => ['Penerbitan', 'emerald', 'M5 13l4 4L19 7'],
                        'archived'  => ['Simpanan', 'slate', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                    ];
                @endphp
                <div class="space-y-3 mb-6">
                    @foreach($availableStatuses as $val => [$lbl, $color, $iconPath])
                        @php
                            $shouldHide = false;
                            if ($news->status === 'archived' && $val === 'draft') $shouldHide = true;
                            if ($news->status === 'draft' && $val === 'archived') $shouldHide = true;
                            if ($news->status === 'published' && $val === 'draft') $shouldHide = true;
                        @endphp
                        @if($shouldHide) @continue @endif
                        <div class="relative">
                            <input type="radio" name="status" value="{{ $val }}" 
                                   {{ old('status', $news->status) === $val ? 'checked' : '' }} 
                                   class="sr-only peer" id="st-{{ $val }}">
                            <label for="st-{{ $val }}" 
                                   class="status-card flex items-center justify-between cursor-pointer p-4 rounded-xl border-2 border-gray-100 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 hover:border-blue-200 transition-all duration-300 group relative">
                                <div class="flex items-center gap-3">
                                    <div class="status-icon w-10 h-10 rounded-xl bg-{{ $color }}-50 text-{{ $color }}-600 peer-checked:bg-blue-600 peer-checked:text-white flex items-center justify-center transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-black uppercase tracking-tight text-gray-800 group-peer-checked:text-blue-900">{{ $lbl }}</p>
                                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $val }}</p>
                                    </div>
                                </div>
                                <div class="status-check hidden peer-checked:flex">
                                    <div class="w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center shadow-lg animate-in zoom-in duration-300">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-gray-50 space-y-3">
                    <button type="button" id="btn-save" class="w-full py-4 bg-blue-600 text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-blue-700 transition shadow-xl shadow-blue-100 hover:shadow-blue-200 hover:-translate-y-0.5 transition-all duration-300">
                        Kemaskini Artikel Berita
                    </button>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" onclick="confirmDelete()" 
                                class="flex items-center justify-center py-4 bg-red-50 text-red-600 font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-red-100 transition border border-red-100">
                            Padam
                        </button>
                        <a href="{{ route('admin.news.index') }}" class="flex items-center justify-center py-4 bg-gray-50 text-gray-400 font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-gray-100 transition border border-gray-100">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

        <form id="delete-post-form" action="{{ route('admin.news.destroy', $news) }}" method="POST" class="hidden">
            @csrf @method('DELETE')
        </form>
    </div>
</div>

{{-- Category Management Modal (Premium Multi-State Redesign) --}}
<div id="cat-modal" class="fixed inset-0 z-[1000] flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] shadow-[0_30px_100px_-20px_rgba(0,0,0,0.3)] w-full max-w-lg overflow-hidden animate-in zoom-in duration-300 modal-card border border-white/20">
        
        {{-- VIEW 1: LIST & SEARCH --}}
        <div id="cat-view-list" class="flex flex-col h-full">
            <div class="px-10 py-8 border-b border-gray-100 bg-gradient-to-br from-slate-50 to-white flex items-center justify-between">
                <div>
                    <h3 class="font-black text-gray-900 uppercase tracking-[0.25em] text-[11px]">Urus Kategori</h3>
                    <p class="text-[10px] text-slate-400 mt-1.5 font-bold tracking-tight">Cari atau hapus kategori berita</p>
                </div>
                <button type="button" onclick="closeCategoryModal()" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-2xl transition-all duration-300 group">
                    <svg class="w-6 h-6 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-10 space-y-6">
                <div class="flex gap-3">
                    <div class="relative flex-1">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" id="modal-cat-search" placeholder="Cari kategori..." 
                               class="w-full pl-12 pr-6 py-4 text-sm font-bold border-2 border-slate-200 bg-white rounded-[1.25rem] focus:border-blue-500 focus:ring-8 focus:ring-blue-500/5 outline-none transition-all duration-300 text-slate-700 placeholder:text-slate-400">
                    </div>
                    <button type="button" onclick="showAddCatView()" class="px-6 py-4 bg-blue-600 text-white text-[10px] font-black rounded-[1.25rem] hover:bg-blue-700 transition-all duration-300 shadow-xl shadow-blue-100 flex items-center gap-2 uppercase tracking-widest active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        Baru
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Senarai Sedia Ada</label>
                        <span id="cat-count-badge" class="px-3 py-1 bg-slate-100 text-slate-600 text-[9px] font-black rounded-full uppercase tracking-tighter border border-slate-200">0 KATEGORI</span>
                    </div>
                    <div id="modal-cat-list" class="max-h-[35vh] overflow-y-auto pr-3 space-y-2 custom-scrollbar -mr-3">
                        {{-- Categories injected via JS --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- VIEW 2: ADD NEW --}}
        <div id="cat-view-add" class="hidden flex flex-col h-full animate-in slide-in-from-right-4 duration-300">
            <div class="px-10 py-8 border-b border-blue-100 bg-gradient-to-br from-blue-50 to-white flex items-center gap-4">
                <button type="button" onclick="showListCatView()" class="w-10 h-10 flex items-center justify-center text-blue-600 bg-white shadow-sm border-2 border-blue-100 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <div>
                    <h3 class="font-black text-gray-900 uppercase tracking-[0.25em] text-[11px]">Tambah Kategori Baru</h3>
                    <p class="text-[10px] text-blue-500 mt-1.5 font-bold tracking-tight">Cipta klasifikasi berita baru</p>
                </div>
            </div>

            <div class="p-10 space-y-8">
                <div class="space-y-4">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Kategori</label>
                    <input type="text" id="new-cat-name" placeholder="cth: Pendidikan, Sukan, Kebajikan..." 
                           class="w-full px-6 py-5 text-base font-bold border-2 border-slate-300 bg-white rounded-[1.5rem] focus:border-blue-600 focus:ring-8 focus:ring-blue-500/5 outline-none transition-all duration-300 text-slate-800 placeholder:text-slate-300">
                    <p class="text-[10px] text-slate-500 font-medium italic px-1 bg-amber-50 py-2 rounded-lg border border-amber-100/50 flex items-center gap-2">
                        <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"/></svg>
                        Pastikan nama kategori unik dan senang difahami.
                    </p>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="showListCatView()" class="flex-1 py-4 text-[10px] font-black text-slate-600 bg-slate-100 uppercase tracking-[0.2em] rounded-[1.25rem] hover:bg-slate-200 border-2 border-slate-200 transition-all duration-300 active:scale-95">Batal</button>
                    <button type="button" onclick="addNewCategory()" class="flex-[2] py-4 bg-slate-900 text-white text-[10px] font-black rounded-[1.25rem] hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-slate-200 hover:shadow-blue-200 uppercase tracking-[0.2em] active:scale-95">Simpan Kategori</button>
                </div>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="px-10 py-6 bg-slate-50/50 border-t border-slate-100 flex items-center gap-3">
            <div class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></div>
            <p class="text-[9px] font-bold text-slate-500 uppercase tracking-wider font-black">Mod Pengurusan Aktif</p>
        </div>
    </div>
</div>

@include('admin.partials.crop-modal')

<div id="preview-modal" class="fixed inset-0 z-[900] bg-slate-900/40 backdrop-blur-sm items-start justify-center overflow-y-auto p-4 py-12 hidden">
    <div class="bg-white w-full max-w-6xl rounded-3xl shadow-2xl overflow-hidden animate-in slide-in-from-bottom-8 duration-500">
        <div class="flex items-center justify-between px-6 py-4 bg-white border-b sticky top-0 z-10">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 bg-rose-500 rounded-full"></div>
                <div class="w-2.5 h-2.5 bg-amber-400 rounded-full"></div>
                <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></div>
            </div>
            <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl">
                <button class="preview-device-btn active px-4 py-1.5 text-[10px] font-bold rounded-lg shadow-sm transition" data-width="375">📱 Mobile</button>
                <button class="preview-device-btn px-4 py-1.5 text-[10px] font-bold text-slate-400 hover:text-slate-600 transition" data-width="768">📟 Tablet</button>
                <button class="preview-device-btn px-4 py-1.5 text-[10px] font-bold text-slate-400 hover:text-slate-600 transition" data-width="full">🖥️ Desktop</button>
            </div>
            <button id="btn-close-preview" class="p-2 text-slate-400 hover:text-rose-500 rounded-lg transition leading-none text-xl">✕</button>
        </div>
        <div class="bg-slate-50/50 p-6 md:p-10 min-h-[70vh]">
            <div id="preview-frame" class="bg-white mx-auto transition-all duration-500 rounded-2xl shadow-2xl overflow-hidden" style="max-width:375px; width:100%">
                <div class="p-8 md:p-12">
                    <div id="prev-cat" class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-lg uppercase tracking-widest mb-6 border border-blue-100">Kategori</div>
                    <h1 id="prev-title" class="text-3xl font-extrabold text-slate-900 mb-6 leading-tight tracking-tight">Tajuk artikel</h1>
                    <div id="prev-thumbnail-wrap" class="{{ $news->thumbnail ? '' : 'hidden' }} rounded-2xl overflow-hidden aspect-video mb-8 shadow-lg">
                        <img id="prev-thumbnail" src="{{ $news->thumbnail ? Storage::url($news->thumbnail) : '' }}" class="w-full h-full object-cover">
                    </div>
                    <div id="prev-content" class="prose prose-slate prose-lg max-w-none prose-p:leading-relaxed prose-headings:tracking-tight prose-img:rounded-3xl prose-blockquote:border-blue-500 prose-blockquote:bg-blue-50/50 prose-blockquote:py-2 prose-blockquote:px-6">
                        {!! \App\Helpers\ContentRenderer::render($news->content) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.30.6/dist/editorjs.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.8.7/dist/header.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@1.4.2/dist/nested-list.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@2.7.4/dist/quote.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@1.1.0/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@1.4.0/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/text-color@2.0.2/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@2.3.0/dist/table.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/strikethrough@1.0.1/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@1.5.0/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-undo@2.0.28/dist/bundle.min.js"></script>
<script>
const UPLOAD_URL = '{{ route("admin.news.image.upload") }}';
const CSRF_TOKEN = '{{ csrf_token() }}';


// ══ Crop Logic ══
let _cropper=null, _cropResolve=null, _cropReject=null;
async function openCropModal(file, ratio = NaN){
    return new Promise(async (res,rej)=>{
        _cropResolve=res; _cropReject=rej;
        const img=document.getElementById('crop-target');
        let processedFile = file;

        // Detect HEIC (iPhone)
        if (file.name.toLowerCase().endsWith('.heic') || file.type.includes('heic') || file.type.includes('heif')) {
            Swal.fire({ title: 'Memproses Imej iPhone...', text: 'Sila tunggu sementara kami menukarkan format imej anda.', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
            try {
                const b = await heic2any({ blob: file, toType: 'image/jpeg', quality: 0.8 });
                processedFile = Array.isArray(b) ? b[0] : b;
                Swal.close();
            } catch (err) {
                Swal.fire({ icon: 'error', title: 'Ralat Penukaran', text: 'Gagal menukarkan format imej iPhone anda.' });
                rej(err); return;
            }
        }

        img.onload=()=>{ 
            if(_cropper){_cropper.destroy();_cropper=null;} 
            _cropper=new Cropper(img,{viewMode:1,autoCropArea:.85,aspectRatio:ratio}); 
            // Sync UI state for AR buttons
            document.querySelectorAll('.crop-ar').forEach(b=>{
                const r=parseFloat(b.dataset.ratio);
                const active = (isNaN(r) && isNaN(ratio)) || (Math.abs(r - ratio) < 0.01);
                b.classList.toggle('bg-white', active); b.classList.toggle('shadow-sm', active); b.classList.toggle('border-transparent', active);
                if(!active) b.classList.add('text-gray-400'); else b.classList.remove('text-gray-400');
            });
        };
        img.src=URL.createObjectURL(processedFile);
        document.getElementById('crop-modal').classList.add('open');
    });
}
function _endCrop(blob){
    const f=new File([blob],'image.jpg',{type:'image/jpeg'});
    if(_cropper){_cropper.destroy();_cropper=null;}
    document.getElementById('crop-modal').classList.remove('open');
    const r=_cropResolve; _cropResolve=null; _cropReject=null; if(r)r(f);
}
document.getElementById('btn-crop-done').addEventListener('click',()=>{
    if(!_cropper||!_cropResolve)return;
    const btn=document.getElementById('btn-crop-done'); btn.textContent='...'; btn.disabled=true;
    const canvas = _cropper.getCroppedCanvas({maxWidth:2048, imageSmoothingHigh:true});
    if(!canvas) { btn.textContent='POTONG'; btn.disabled=false; return; }
    canvas.toBlob(b=>{ btn.textContent='POTONG'; btn.disabled=false; if(b) _endCrop(b); },'image/jpeg',0.8);
});
document.getElementById('btn-crop-skip').addEventListener('click',()=>{ 
    if(!_cropper||!_cropResolve)return;
    const btn=document.getElementById('btn-crop-skip'); btn.textContent='...'; btn.disabled=true;
    _cropper.setAspectRatio(NaN); 
    _cropper.setData({ x:0, y:0, width: _cropper.getImageData().naturalWidth, height: _cropper.getImageData().naturalHeight });
    const canvas = _cropper.getCroppedCanvas({maxWidth:2048});
    if(!canvas) { btn.textContent='Asal'; btn.disabled=false; return; }
    canvas.toBlob(b=>{ btn.textContent='Asal'; btn.disabled=false; if(b) _endCrop(b); },'image/jpeg',0.8);
});
document.getElementById('btn-crop-cancel').addEventListener('click',()=>{
    if(_cropper){_cropper.destroy();_cropper=null;}
    document.getElementById('crop-modal').classList.remove('open');
    const rej=_cropReject; _cropResolve=null; _cropReject=null; if(rej)rej(new Error('cancelled'));
});
document.querySelectorAll('.crop-ar').forEach(btn=>btn.addEventListener('click',()=>{
    if(!_cropper)return;
    const r=parseFloat(btn.dataset.ratio); _cropper.setAspectRatio(isNaN(r)?NaN:r);
    document.querySelectorAll('.crop-ar').forEach(b=>{ b.classList.remove('bg-white','shadow-sm','border-transparent'); b.classList.add('text-gray-400'); });
    btn.classList.add('bg-white','shadow-sm','border-transparent'); btn.classList.remove('text-gray-400');
}));

// ══ Upload ══
async function uploadFile(file){
    const fd=new FormData(); fd.append('image',file);
    const r=await fetch(UPLOAD_URL,{method:'POST',headers:{'X-CSRF-TOKEN':CSRF_TOKEN,'Accept':'application/json'},body:fd});
    
    if (!r.ok) {
        const d = await r.json();
        const msg = d.message || d.errors?.image?.[0] || 'Gagal memuat naik imej.';
        Swal.fire({ icon: 'error', title: 'Ralat Muat Naik', text: msg, confirmButtonColor: '#3b82f6' });
        throw new Error(msg);
    }
    const d=await r.json(); 
    return d.url;
}
async function deleteRemoteFile(url){
    if(!url || !url.includes('/storage/news/')) return; // Allow deleting any news-related image
    try{ await fetch('{{ route("admin.news.image.destroy") }}',{method:'DELETE',headers:{'X-CSRF-TOKEN':CSRF_TOKEN,'Content-Type':'application/json','Accept':'application/json'},body:JSON.stringify({url:url})}); }
    catch(e){}
}

// ══ Custom Tools ══
class AlignTune{
    static get isTune(){return true;}
    constructor({data}){this.data = (data && typeof data === 'object') ? data : {align:'left'};this._root=null;}
    render(){
        const wrap=document.createElement('div');
        wrap.innerHTML='<div style="font-[800] text-[9px] text-slate-400 px-3 py-2 uppercase tracking-wide">Alignment</div>';
        const row=document.createElement('div'); row.style.cssText='display:flex; gap:4px; padding:0 8px 8px;';
        ['left','center','right'].forEach(v=>{
            const b=document.createElement('button'); b.type='button'; b.className='align-tune-btn'+(this.data.align===v?' active':'');
            b.innerHTML=v==='left'?'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x1="21" y1="6"/><line x1="3" y1="12" x1="16" y1="12"/><line x1="3" y1="18" x1="19" y2="18"/></svg>':v==='center'?'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="7" y1="12" x1="17" y2="12"/><line x1="5" y1="18" x2="19" y2="18"/></svg>':'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="5" y1="18" x2="21" y2="18"/></svg>';
            b.addEventListener('click',()=>{ this.data.align=v; row.querySelectorAll('.align-tune-btn').forEach(x=>x.classList.remove('active')); b.classList.add('active'); if(this._root)this._root.style.textAlign=v; });
            row.appendChild(b);
        });
        wrap.appendChild(row); return wrap;
    }
    wrap(c){this._root=c; c.style.textAlign=this.data.align||'left'; return c;}
    save(){return JSON.parse(JSON.stringify(this.data));}
    updated(data){ this.data=JSON.parse(JSON.stringify(data)); if(this._root) this._root.style.textAlign=this.data.align||'left'; }
}

class CustomImageBlock{
    static get toolbox(){return{title:'Gambar',icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 15l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/></svg>'};}
    constructor({data}){
        const d = data || {};
        this.data={url:d.url||'',caption:d.caption||'',width:d.width||'100',align:d.align||'center'};
        this.wrapper=null;
    }
    render(){this.wrapper=document.createElement('div');this._build();return this.wrapper;}
    _build(){this.wrapper.innerHTML=''; this.data.url?this._view():this._pick();}
    _pick(){
        const id='up-'+Date.now(), lbl=document.createElement('label'); lbl.htmlFor=id; lbl.className='cimg-upload-label';
        lbl.innerHTML=`<div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center font-bold text-gray-400 shadow-inner">+</div><span style="font-size:12px; font-weight:700;">Sisipkan Gambar</span><input type="file" id="${id}" accept="image/*" class="hidden">`;
        lbl.querySelector('input').addEventListener('change',async e=>{
            const f=e.target.files[0]; if(!f){this._die();return;}
            lbl.innerHTML='<div class="cimg-spinner"></div>';
            try{ const c=await openCropModal(f); const u=await uploadFile(c); this.data.url=u; this._build(); } catch{this._die();}
        });
        this.wrapper.appendChild(lbl);
    }
    _view(){
        const ws=[{l:'25%',v:'25'},{l:'50%',v:'50'},{l:'75%',v:'75'},{l:'100%',v:'100'}];
        const tb=document.createElement('div'); tb.className='cimg-toolbar';
        const wRow=document.createElement('div'); wRow.style.cssText='display:flex; gap:3px; align-items:center;';
        wRow.innerHTML='<span style="font-size:8px; font-weight:800; color:#9ba3af; margin-right:4px;">SIZE</span>';
        ws.forEach(o=>{
            const b=document.createElement('button'); b.type='button'; b.textContent=o.l; b.className='cimg-ctrl-btn'+(this.data.width===o.v?' active':'');
            b.addEventListener('click',()=>{this.data.width=o.v; wRow.querySelectorAll('.cimg-ctrl-btn').forEach(x=>x.classList.toggle('active',x.textContent===o.l)); iW.style.maxWidth=o.v==='100'?'100%':o.v+'%'; });
            wRow.appendChild(b);
        });
        const aRow=document.createElement('div'); aRow.style.cssText='display:flex; gap:3px; margin-left:8px; border-left:1px solid #f3f4f6; padding-left:8px;';
        ['left','center','right'].forEach(v=>{
            const b=document.createElement('button'); b.type='button'; b.className='cimg-align-btn'+(this.data.align===v?' active':'');
            b.innerHTML=v==='left'?'<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="16" y2="12"/><line x1="3" y1="18" x2="19" y2="18"/></svg>':v==='center'?'<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="7" y1="12" x2="17" y2="12"/><line x1="5" y1="18" x2="19" y2="18"/></svg>':'<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="5" y1="18" x2="21" y2="18"/></svg>';
            b.addEventListener('click',()=>{this.data.align=v; w.style.textAlign=v; aRow.querySelectorAll('.cimg-align-btn').forEach(x=>x.classList.remove('active')); b.classList.add('active'); });
            aRow.appendChild(b);
        });
        const chg=document.createElement('button'); chg.type='button'; chg.title='Tukar Gambar';
        chg.style.cssText='margin-left:auto; width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:8px; border:none; background:#eff6ff; color:#3b82f6; cursor:pointer; transition:.2s;';
        chg.innerHTML='<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 3h5v5M4 20L21 3M21 16v5h-5M15 15l6 6M4 4l5 5"/></svg>';
        chg.onmouseover=()=>{chg.style.background='#3b82f6'; chg.style.color='#fff';};
        chg.onmouseout=()=>{chg.style.background='#eff6ff'; chg.style.color='#3b82f6';};
        chg.addEventListener('click',async()=>{
            const inp=document.createElement('input'); inp.type='file'; inp.accept='image/*';
            inp.onchange=async(e)=>{
                const f=e.target.files[0]; if(!f)return;
                const oldUrl=this.data.url;
                tb.innerHTML='<div style="display:flex; align-items:center; gap:8px; padding-left:4px;"><div class="cimg-spinner" style="width:14px; height:14px; border-width:2px;"></div><span style="font-size:9px; font-weight:800; color:#3b82f6; letter-spacing:0.05em;">MENUKAR...</span></div>';
                try{ const c=await openCropModal(f); const u=await uploadFile(c); this.data.url=u; this._build(); await deleteRemoteFile(oldUrl); }
                catch{this._build();}
            }; inp.click();
        });

        const del=document.createElement('button'); del.type='button'; del.title='Padam Blok';
        del.style.cssText='margin-left:6px; width:28px; height:28px; display:flex; align-items:center; justify-content:center; border-radius:8px; border:none; background:#fef2f2; color:#ef4444; cursor:pointer; transition:.2s;';
        del.innerHTML='<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/></svg>';
        del.onmouseover=()=>{del.style.background='#ef4444'; del.style.color='#fff';};
        del.onmouseout=()=>{del.style.background='#fef2f2'; del.style.color='#ef4444';};
        del.addEventListener('click',async()=>{ const oldUrl=this.data.url; this.data.url=''; this._build(); await deleteRemoteFile(oldUrl); });

        tb.appendChild(wRow); tb.appendChild(aRow); tb.appendChild(chg); tb.appendChild(del);
        const w=document.createElement('div'); w.style.textAlign=this.data.align;
        const iW=document.createElement('div'); iW.style.cssText=`display:inline-block; width:100%; border-radius:16px; overflow:hidden; vertical-align:top; max-width:${this.data.width==='100'?'100%':this.data.width+'%'};`;
        const im=document.createElement('img'); im.src=this.data.url; im.style.width='100%'; iW.appendChild(im);
        const cp=document.createElement('input'); cp.type='text'; cp.value=this.data.caption; cp.placeholder='Nota gambar...'; cp.style.cssText='width:100%; border:none; outline:none; text-align:center; font-size:12px; color:#9ca3af; padding:8px 0; background:transparent; font-style:italic;';
        cp.addEventListener('input',e=>this.data.caption=e.target.value);
        w.appendChild(tb); w.appendChild(iW); w.appendChild(cp); this.wrapper.appendChild(w);
    }
    _die(){ setTimeout(()=>{ try{const i=editor.blocks.getCurrentBlockIndex(); if(i>=0)editor.blocks.delete(i);}catch{this.wrapper.innerHTML='';} },85); }
    save(){return JSON.parse(JSON.stringify(this.data));}
    updated(data){ this.data=JSON.parse(JSON.stringify(data)); this._build(); }
}

class ImageGalleryTool{
    static get toolbox(){return{title:'Galeri',icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>'};}
    constructor({data}){
        const d = data || {};
        this.data={images:d.images||[],columns:d.columns||2,aspectRatio:d.aspectRatio||'16/9'};
        this.wrapper=null;
    }
    render(){this.wrapper=document.createElement('div'); this.wrapper.className='gallery-block'; this._draw(); return this.wrapper;}
    _draw(){
        this.wrapper.innerHTML='';
        const rs=[{l:'1:1',v:'1/1'},{l:'4:3',v:'4/3'},{l:'16:9',v:'16/9'},{l:'9:16',v:'9/16'},{l:'3:4',v:'3/4'},{l:'Auto',v:'auto'}];
        const hdr=document.createElement('div'); hdr.style.cssText='display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;';
        hdr.innerHTML='<span style="font-size:9px; font-weight:900; color:#cbd5e1; text-transform:uppercase; letter-spacing:0.1em;">Konfigurasi Galeri</span>';
        const ctrl=document.createElement('div'); ctrl.className='gallery-hdr-controls';
        const cSel=document.createElement('div'); cSel.style.cssText='display:flex; gap:3px;';
        [1,2,3].forEach(n=>{
            const b=document.createElement('button'); b.type='button'; b.textContent=n;
            b.style.cssText=`width:24px; height:24px; border-radius:6px; font-size:10px; font-weight:900; border:1px solid ${this.data.columns===n?'#3b82f6':'#f1f5f9'}; background:${this.data.columns===n?'#3b82f6':'#fff'}; color:${this.data.columns===n?'#fff':'#64748b'}; cursor:pointer;`;
            b.addEventListener('click',()=>{this.data.columns=n; this._draw();}); cSel.appendChild(b);
        });
        const rSel=document.createElement('div'); rSel.style.cssText='display:flex; gap:3px; margin-left:8px; border-left:1px solid #f1f5f9; padding-left:8px;';
        rs.forEach(o=>{
            const b=document.createElement('button'); b.type='button'; b.textContent=o.l;
            b.style.cssText=`padding:0 6px; height:24px; border-radius:6px; font-size:9px; font-weight:900; border:1px solid ${this.data.aspectRatio===o.v?'#3b82f6':'#f1f5f9'}; background:${this.data.aspectRatio===o.v?'#3b82f6':'#fff'}; color:${this.data.aspectRatio===o.v?'#fff':'#64748b'}; cursor:pointer;`;
            b.addEventListener('click',()=>{this.data.aspectRatio=o.v; this._draw();}); rSel.appendChild(b);
        });
        ctrl.appendChild(cSel); ctrl.appendChild(rSel); hdr.appendChild(ctrl); this.wrapper.appendChild(hdr);
        if(this.data.images.length){
            const g=document.createElement('div'); g.className=`grid ${this.data.columns===1?'grid-cols-1':this.data.columns===2?'grid-cols-2':'grid-cols-3'} gap-4 mb-4`;
            this.data.images.forEach((x,i)=>{
                const cell=document.createElement('div'); cell.className='gallery-img-wrap';
                const im=document.createElement('img'); im.src=x.url; im.style.cssText=`width:100%; display:block; object-fit:cover; ${this.data.aspectRatio==='auto'?'height:auto;':'aspect-ratio:'+this.data.aspectRatio+';'}`;
                const del=document.createElement('button'); del.type='button'; del.className='gallery-del-btn'; del.innerHTML='✕';
                del.addEventListener('click',async()=>{ const url=x.url; this.data.images.splice(i,1); this._draw(); await deleteRemoteFile(url); });
                const cp=document.createElement('input'); cp.className='gallery-caption-inp'; cp.placeholder='Kapsyen...'; cp.value=x.caption||'';
                cp.addEventListener('input',e=>this.data.images[i].caption=e.target.value);
                cell.appendChild(im); cell.appendChild(del); cell.appendChild(cp); g.appendChild(cell);
            });
            this.wrapper.appendChild(g);
        }
        const pickId='gp-'+Date.now(), pick=document.createElement('label'); pick.htmlFor=pickId;
        pick.style.cssText='display:flex; align-items:center; justify-content:center; gap:8px; width:100%; height:44px; border:2px dashed #f1f5f9; border-radius:12px; cursor:pointer; color:#94a3b8; font-size:12px; font-weight:800; background:#fcfdfe;';
        pick.innerHTML=`<span style="font-size:16px;">+</span> TAMBAH IMEJ<input id="${pickId}" type="file" multiple accept="image/*" class="hidden">`;
        pick.querySelector('input').addEventListener('change',async e=>{
            const fs=Array.from(e.target.files); if(!fs.length)return;
            pick.innerHTML='...'; pick.style.pointerEvents='none';
            for(const f of fs){ try{ const c=await openCropModal(f); const u=await uploadFile(c); this.data.images.push({url:u,caption:''}); }catch(err){if(err.message==='cancelled')break;}}
            this._draw();
        });
        this.wrapper.appendChild(pick);
    }
    save(){return JSON.parse(JSON.stringify(this.data));}
    updated(data){ this.data=JSON.parse(JSON.stringify(data)); this._draw(); }
}

// ══ Init ══
let editor;

try {
    const tools = {};

    // AlignTune must be registered FIRST
    if (typeof AlignTune !== 'undefined') tools.alignTune = AlignTune;

    if (typeof Header !== 'undefined') {
        tools.header = {
            class: Header,
            config: { levels: [2, 3, 4], defaultLevel: 2 },
            tunes: typeof AlignTune !== 'undefined' ? ['alignTune'] : [],
            inlineToolbar: true,
            shortcut: 'CMD+SHIFT+H'
        };
    }

    if (typeof NestedList !== 'undefined') {
        tools.list = { 
            class: NestedList, 
            inlineToolbar: true,
            config: { defaultStyle: 'unordered' }
        };
    }

    if (typeof Quote !== 'undefined') {
        tools.quote = { 
            class: Quote, 
            inlineToolbar: true, 
            config: { quotePlaceholder: 'Kata-kata hikmah...', captionPlaceholder: 'Penulis' }
        };
    }

    if (typeof CustomImageBlock !== 'undefined') tools.image = CustomImageBlock;
    if (typeof ImageGalleryTool !== 'undefined') tools.gallery = ImageGalleryTool;
    if (typeof Underline !== 'undefined') tools.underline = Underline;
    if (typeof Strikethrough !== 'undefined') tools.strikethrough = Strikethrough;
    
    if (typeof Marker !== 'undefined') {
        tools.marker = { class: Marker, shortcut: 'CMD+SHIFT+M' };
    }

    const colorClass = (typeof ColorPlugin !== 'undefined' ? ColorPlugin : (typeof Color !== 'undefined' ? Color : null));
    if (colorClass) {
        tools.color = { 
            class: colorClass, 
            config: { 
                colorCollections: ['#1e293b', '#2563eb', '#db2777', '#059669', '#d97706', '#dc2626', '#7c3aed'], 
                defaultColor: '#1e293b', 
                type: 'text' 
            } 
        };
    }

    if (typeof InlineCode !== 'undefined') tools.inlineCode = InlineCode;
    
    if (typeof Table !== 'undefined') {
        tools.table = { 
            class: Table, 
            inlineToolbar: true, 
            config: { rows: 2, cols: 3 } 
        };
    }

    const editorConfig = {
        holder: 'editorjs',
        placeholder: 'Teruskan suntingan anda...',
        inlineToolbar: true,
        data: {{ \Illuminate\Support\Js::from($safeContent) }},
        tools: tools,
        onReady: () => {
            if (typeof Undo !== 'undefined') {
                const btnUndo = document.getElementById('btn-undo');
                const btnRedo = document.getElementById('btn-redo');
                let editorUndo;
                
                const updateUndoButtons = () => {
                    if (!btnUndo || !btnRedo || !editorUndo) return;
                    
                    setTimeout(() => {
                        try {
                            const pos = editorUndo.position;
                            const stack = editorUndo.stack || [];
                            
                            const canUndo = pos > 0;
                            const canRedo = pos < (stack.length - 1);

                            btnUndo.disabled = !canUndo;
                            btnRedo.disabled = !canRedo;

                            if (canUndo) {
                                btnUndo.classList.remove('text-gray-400');
                                btnUndo.classList.add('text-blue-600', 'bg-blue-50/50');
                            } else {
                                btnUndo.classList.add('text-gray-400');
                                btnUndo.classList.remove('text-blue-600', 'bg-blue-50/50');
                            }

                            if (canRedo) {
                                btnRedo.classList.remove('text-gray-400');
                                btnRedo.classList.add('text-blue-600', 'bg-blue-50/50');
                            } else {
                                btnRedo.classList.add('text-gray-400');
                                btnRedo.classList.remove('text-blue-600', 'bg-blue-50/50');
                            }
                        } catch (e) {
                            btnUndo.disabled = false;
                            btnRedo.disabled = false;
                        }
                    }, 50);
                };

                try {
                    editorUndo = new Undo({ 
                        editor, 
                        onUpdate: () => { updateUndoButtons(); }
                    });

                    if (btnUndo) btnUndo.addEventListener('click', () => { editorUndo.undo(); });
                    if (btnRedo) btnRedo.addEventListener('click', () => { editorUndo.redo(); });

                    updateUndoButtons();
                } catch (e) {
                    console.error('Undo plugin initialization failed:', e);
                }
            }
        }
    };

    // Remove tools that failed to load
    Object.keys(editorConfig.tools).forEach(key => {
        let t = editorConfig.tools[key];
        if (t === null || (typeof t === 'object' && t.class === null)) delete editorConfig.tools[key];
    });

    if (typeof EditorJS !== 'undefined') {
        try {
            editor = new EditorJS(editorConfig);
        } catch (e) {
            console.error('EditorJS Constructor Error:', e);
            document.getElementById('editorjs').innerHTML = `<div class="p-10 text-center border-2 border-dashed border-red-200 rounded-3xl bg-red-50/50 my-10">
                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-red-900 mb-1">Gagal Memulakan Editor</h3>
                <p class="text-sm text-red-600 mb-4">Terdapat ralat teknikal semasa memuatkan kandungan artikel.</p>
                <code class="px-3 py-1 bg-white border border-red-100 rounded text-[10px] text-red-400 block max-w-xs mx-auto overflow-hidden text-ellipsis">${e.message}</code>
                <div class="mt-6">
                    <button type="button" onclick="window.location.reload()" class="px-6 py-2.5 bg-red-600 text-white text-xs font-black rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-100">Muat Semula Halaman</button>
                </div>
            </div>`;
        }
    } else {
        document.getElementById('editorjs').innerHTML = `<div class="p-10 text-center border-2 border-dashed border-amber-200 rounded-3xl bg-amber-50/50 my-10">
            <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-amber-900 mb-1">Sambungan Internet Perlahan</h3>
            <p class="text-sm text-amber-600 mb-6">Library editor tidak dapat dimuatkan. Sila semak sambungan internet anda.</p>
            <button type="button" onclick="window.location.reload()" class="px-6 py-2.5 bg-amber-600 text-white text-xs font-black rounded-xl hover:bg-amber-700 transition shadow-lg shadow-amber-100">Cuba Lagi</button>
        </div>`;
    }
} catch (e) {
    console.error('EditorJS Config Error (Edit):', e);
}

// ══ Bulk Formatting Support ══
document.addEventListener('keydown', async (e) => {
    // Only trigger on Cmd/Ctrl + B, U, or I
    const isFormatKey = (e.ctrlKey || e.metaKey) && ['b', 'u', 'i'].includes(e.key.toLowerCase());
    if (!isFormatKey) return;

    // Detection Method 1: Formal EditorJS Block Selection
    let selectedBlocks = Array.from(document.querySelectorAll('.ce-block--selected'));
    
    // Detection Method 2: Standard Browser Text Selection across multiple blocks
    if (selectedBlocks.length <= 1) {
        const selection = window.getSelection();
        if (selection.rangeCount > 0) {
            const range = selection.getRangeAt(0);
            const allBlocks = Array.from(document.querySelectorAll('.ce-block'));
            selectedBlocks = allBlocks.filter(block => range.intersectsNode(block));
        }
    }

    // Detection Method 3: Custom Drag-Selected List Items
    const customListItems = document.querySelectorAll('.custom-selected-list-item');
    if (customListItems.length > 1) {
        e.preventDefault();
        const tag = e.key.toLowerCase() === 'b' ? 'bold' : (e.key.toLowerCase() === 'u' ? 'underline' : (e.key.toLowerCase() === 'i' ? 'italic' : null));
        if (!tag) return;

        const sel = window.getSelection();
        const origRanges = [];
        for (let i = 0; i < sel.rangeCount; i++) origRanges.push(sel.getRangeAt(i));

        customListItems.forEach(el => {
            const r = document.createRange();
            r.selectNodeContents(el);
            sel.removeAllRanges();
            sel.addRange(r);
            document.execCommand(tag, false);
        });

        try { document.getElementById('editorjs').dispatchEvent(new Event('input', { bubbles: true })); } catch(err) {}

        sel.removeAllRanges();
        origRanges.forEach(r => sel.addRange(r));
        return;
    }

    if (selectedBlocks.length <= 1) return; // Still only 1 or 0? Do nothing (let native handle it)

    e.preventDefault();
    const tag = e.key.toLowerCase() === 'b' ? 'b' : (e.key.toLowerCase() === 'u' ? 'u' : 'i');
    const blocksList = Array.from(document.querySelectorAll('.ce-block'));
    
    for (let el of selectedBlocks) {
        const index = blocksList.indexOf(el);
        if (index === -1) continue;

        try {
            const block = await editor.blocks.getBlockByIndex(index);
            if (!block) continue;
            
            const data = await block.save();
            let changed = false;

            if (data.data.text !== undefined) {
                // Handle Paragraph, Header, Quote
                data.data.text = `<${tag}>${data.data.text}</${tag}>`;
                changed = true;
            } else if (data.data.items !== undefined) {
                // Handle List
                data.data.items = data.data.items.map(function formatItem(item) {
                    if (typeof item === 'string') return `<${tag}>${item}</${tag}>`;
                    if (typeof item === 'object' && item !== null) {
                        if (item.content !== undefined) item.content = `<${tag}>${item.content}</${tag}>`;
                        if (item.items && Array.isArray(item.items)) item.items = item.items.map(formatItem);
                        return item; // Keep object structure
                    }
                    return item;
                });
                changed = true;
            }

            if (changed) {
                await editor.blocks.update(data.id, data.data);
            }
        } catch (err) {
            console.error('Bulk format update failed:', err);
        }
    }
});

// ══ Form ══
// ══ Category Management ══
let allCategories = [];

function toggleCatDropdown(e) {
    if(e) e.stopPropagation();
    const menu = document.getElementById('cat-dropdown-menu');
    const arrow = document.getElementById('cat-arrow');
    const isHidden = menu.classList.contains('hidden');
    
    if(!isHidden) {
        menu.classList.add('hidden');
        if(arrow) arrow.style.transform = 'rotate(0deg)';
    } else {
        menu.classList.remove('hidden');
        if(arrow) arrow.style.transform = 'rotate(180deg)';
        document.getElementById('cat-search').focus();
    }
}

document.addEventListener('click', e => {
    const container = document.getElementById('cat-dropdown-container');
    const menu = document.getElementById('cat-dropdown-menu');
    if(container && menu && !container.contains(e.target)) {
        menu.classList.add('hidden');
        const arrow = document.getElementById('cat-arrow');
        if(arrow) arrow.style.transform = 'rotate(0deg)';
    }
});

function openCategoryModal(e) { 
    if(e) e.stopPropagation();
    document.getElementById('cat-dropdown-menu').classList.add('hidden');
    document.getElementById('cat-modal').classList.add('open');
    showListCatView();
    refreshCategoryLists();
}

function closeCategoryModal() { document.getElementById('cat-modal').classList.remove('open'); }

function showListCatView() {
    document.getElementById('cat-view-list').classList.remove('hidden');
    document.getElementById('cat-view-add').classList.add('hidden');
}

function showAddCatView() {
    document.getElementById('cat-view-list').classList.add('hidden');
    document.getElementById('cat-view-add').classList.remove('hidden');
    document.getElementById('new-cat-name').value = '';
    document.getElementById('new-cat-name').focus();
}

document.getElementById('cat-search').addEventListener('input', e => {
    const q = e.target.value.toLowerCase().trim();
    const filtered = allCategories.filter(c => c.name.toLowerCase().includes(q));
    renderCategoryOptions(filtered, q);
});

document.getElementById('cat-search').addEventListener('keydown', e => {
    if(e.key === 'Enter') {
        e.preventDefault();
        const q = e.target.value.trim();
        const exactMatch = allCategories.find(c => c.name.toLowerCase() === q.toLowerCase());
        if(exactMatch) {
            selectCategory(exactMatch.id, exactMatch.name);
        } else if(q.length > 0) {
            handleQuickAdd(q);
        }
    }
});

async function handleQuickAdd(name) {
    if(!name) return;
    
    try {
        const r = await fetch('{{ route("admin.news.categories.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ name })
        });
        
        const d = await r.json();
        if(d.ok) {
            document.getElementById('cat-search').value = '';
            await refreshCategoryLists();
            const newCat = allCategories.find(c => c.name.toLowerCase() === name.toLowerCase());
            if(newCat) selectCategory(newCat.id, newCat.name);
        } else {
            Swal.fire({ icon: 'error', title: 'Ralat', text: d.message || 'Gagal menambah kategori.' });
        }
    } catch(e) {
        console.error('Quick add failed:', e);
    }
}


document.getElementById('modal-cat-search').addEventListener('input', e => {
    const q = e.target.value.toLowerCase();
    renderModalCategoryList(allCategories.filter(c => c.name.toLowerCase().includes(q)));
});

async function refreshCategoryLists() {
    try {
        const r = await fetch('{{ route("admin.news.categories.index") }}');
        allCategories = await r.json();
        
        // Update counts
        const badge = document.getElementById('cat-count-badge');
        if(badge) badge.innerText = `${allCategories.length} KATEGORI`;

        renderCategoryOptions(allCategories);
        renderModalCategoryList(allCategories);
        
        // Sync current selection label
        const selectedId = document.getElementById('category_id_val').value;
        if(selectedId) {
            const selectedCat = allCategories.find(c => c.id == selectedId);
            if(selectedCat) {
                document.getElementById('cat-label').textContent = selectedCat.name;
                document.getElementById('cat-label').classList.add('text-blue-600', 'font-bold');
            }
        }
    } catch(e) {}
}

function renderModalCategoryList(cats) {
    const modalList = document.getElementById('modal-cat-list');
    if(cats.length === 0) {
        modalList.innerHTML = `
            <div class="py-12 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <p class="text-xs text-slate-400 italic">Tiada kategori dijumpai...</p>
            </div>`;
        return;
    }
    modalList.innerHTML = cats.map(c => `
        <div class="flex items-center justify-between p-4 rounded-2xl hover:bg-slate-50 transition-all group border border-transparent hover:border-slate-100 mb-1">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-[10px]">${c.name.charAt(0).toUpperCase()}</div>
                <span class="text-sm font-bold text-slate-700">${c.name}</span>
            </div>
            <button type="button" onclick="deleteCategory(${c.id})" class="w-10 h-10 flex items-center justify-center text-slate-300 hover:text-rose-500 hover:bg-rose-50 rounded-xl transition-all opacity-0 group-hover:opacity-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
            </button>
        </div>
    `).join('');
}

function renderCategoryOptions(cats, query = '') {
    const container = document.getElementById('cat-options');
    const selectedId = document.getElementById('category_id_val').value;
    let html = '';

    if(cats.length === 0 && query.length === 0) {
        container.innerHTML = '<div class="py-6 text-center"><p class="text-[10px] text-gray-400 italic">Tiada kategori...</p></div>';
        return;
    }
    
    html = cats.map(c => {
        const isActive = c.id == selectedId;
        return `
            <button type="button" onclick="selectCategory(${c.id}, '${c.name.replace(/'/g, "\\'")}')" 
                    class="w-full text-left px-4 py-3 text-xs rounded-xl transition-all flex items-center justify-between group ${isActive ? 'cat-item-active' : 'text-gray-600 hover:bg-gray-50'}">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-1.5 rounded-full ${isActive ? 'bg-blue-600 shadow-[0_0_6px_rgba(37,99,235,0.4)]' : 'bg-gray-300 group-hover:bg-blue-400'}"></div>
                    <span class="font-bold">${c.name}</span>
                </div>
                ${isActive ? '<svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>' : ''}
            </button>
        `;
    }).join('');

    if(query.length > 0 && !allCategories.find(c => c.name.toLowerCase() === query.toLowerCase())) {
        html += `
            <button type="button" onclick="handleQuickAdd('${query.replace(/'/g, "\\'")}')"
                    class="w-full text-left px-4 py-3.5 text-xs bg-blue-600 text-white hover:bg-blue-700 rounded-xl transition-all mt-2 shadow-lg shadow-blue-100 flex items-center justify-between group">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    <span class="font-bold uppercase tracking-wider text-[9px]">Tambah: ${query}</span>
                </div>
                <kbd class="hidden sm:block text-[8px] bg-white/20 px-1.5 py-0.5 rounded font-black tracking-tighter">ENTER</kbd>
            </button>
        `;
    }

    container.innerHTML = html || '<div class="py-6 text-center"><p class="text-[10px] text-gray-400 italic">Tiada hasil carian...</p></div>';
}

function selectCategory(id, name) {
    document.getElementById('category_id_val').value = id;
    document.getElementById('cat-label').textContent = name;
    document.getElementById('cat-label').classList.remove('text-red-600', 'text-gray-400');
    document.getElementById('cat-label').classList.add('text-blue-600', 'font-bold');
    document.getElementById('cat-trigger').classList.remove('border-red-300', 'bg-red-50/30');
    document.getElementById('cat-dropdown-menu').classList.add('hidden');
    document.getElementById('cat-arrow').style.transform = 'rotate(0deg)';
}

function confirmDelete() {
    Swal.fire({
        title: 'Padam Artikel?',
        text: 'Adakah anda pasti? Tindakan ini tidak boleh dibatalkan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Padam!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-post-form').submit();
        }
    });
}

// Initial fetch
refreshCategoryLists();

async function addNewCategory() {
    const name = document.getElementById('new-cat-name').value;
    if(!name) return;
    
    try {
        const r = await fetch('{{ route("admin.news.categories.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify({ name })
        });
        
        const d = await r.json();
        if(d.ok) {
            document.getElementById('new-cat-name').value = '';
            showListCatView();
            await refreshCategoryLists();
            Swal.fire({ icon: 'success', title: 'Berjaya', text: 'Kategori baru telah ditambah.', timer: 1500, showConfirmButton: false });
        } else {
            Swal.fire({ icon: 'error', title: 'Ralat', text: d.message || 'Gagal menambah kategori.' });
        }
    } catch(e) {
        console.error('Failed to add category:', e);
    }
}

async function deleteCategory(id) {
    Swal.fire({
        title: 'Padam Kategori?',
        text: "Anda pasti mahu memadam kategori ini? Artikel yang menggunakan kategori ini mungkin terjejas.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48', // rose-600
        cancelButtonColor: '#64748b',  // slate-500
        confirmButtonText: 'Ya, Padam',
        cancelButtonText: 'Batal',
        borderRadius: '1.5rem',
        customClass: {
            popup: 'rounded-[2rem] border-0 shadow-2xl',
            confirmButton: 'rounded-xl px-6 py-3 text-[10px] font-black uppercase tracking-widest',
            cancelButton: 'rounded-xl px-6 py-3 text-[10px] font-black uppercase tracking-widest'
        }
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const r = await fetch(`{{ url('admin/news-categories') }}/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
                });
                
                const d = await r.json();
                if(d.ok) {
                    refreshCategoryLists();
                    Swal.fire({ icon: 'success', title: 'Dipadam!', text: 'Kategori telah berjaya dipadam.', timer: 1500, showConfirmButton: false, borderRadius: '1.5rem' });
                } else {
                    Swal.fire({ icon: 'error', title: 'Had Sekatan', text: d.message, borderRadius: '1.5rem' });
                }
            } catch(e) {
                console.error('Delete failed:', e);
            }
        }
    });
}

document.getElementById('btn-save').addEventListener('click',async()=>{
    const b=document.getElementById('btn-save'); 
    const originalText = b.textContent;
    b.textContent='PROSES...'; b.disabled=true;
    try{ 
        if(!editor) throw new Error('Editor not initialized');
        const d=await editor.save(); 
        document.getElementById('content-input').value=JSON.stringify(d); 
        document.getElementById('news-form').submit(); 
    }
    catch(err){ 
        console.error('Save failed:', err);
        b.textContent=originalText; b.disabled=false; 
        Swal.fire({ icon: 'error', title: 'Ralat Simpan', text: 'Gagal menyimpan kandungan. Sila pastikan anda telah mengisi tajuk dan kandungan dengan betul.' });
    }
});

// Update button text on status change
document.querySelectorAll('input[name="status"]').forEach(radio => {
    radio.addEventListener('change', e => {
        const btn = document.getElementById('btn-save');
        btn.textContent = e.target.value === 'published' ? 'Kemaskini & Terbitkan' : 'Simpan Sebagai Draf';
    });
});

// Set initial text based on selection
const initialStatusEl = document.querySelector('input[name="status"]:checked');
if(initialStatusEl) {
    const initialStatus = initialStatusEl.value;
    document.getElementById('btn-save').textContent = initialStatus === 'published' ? 'Kemaskini Artikel' : 'Simpan Sebagai Draf';
}

// ══ UI Helpers ══
document.getElementById('thumbnail').addEventListener('change',async function(){
    const f=this.files[0]; if(!f)return;
    try {
        const c=await openCropModal(f, 1.777); // Default to 16:9 for thumbnails
        const u=await uploadFile(c);
        document.getElementById('thumbnail_url').value = u;
        document.getElementById('thumb-preview').src = u;
        document.getElementById('thumb-wrap').classList.remove('hidden');
        document.getElementById('thumb-label').style.display = 'none';
        document.getElementById('prev-thumbnail').src = u;
        document.getElementById('prev-thumbnail-wrap').classList.remove('hidden');
    } catch(e) {}
    this.value = ''; // Reset file input
});
document.getElementById('btn-rm-thumb')?.addEventListener('click',async()=>{
    const oldUrl = document.getElementById('thumbnail_url').value;
    document.getElementById('thumbnail_url').value=''; 
    document.getElementById('thumb-wrap').classList.add('hidden');
    document.getElementById('thumb-label').style.display = 'flex';
    document.getElementById('prev-thumbnail-wrap').classList.add('hidden');
    await deleteRemoteFile(oldUrl);
});

// ══ Preview Logic ══
function buildHtml(bs){
    return bs.map(b=>{
        const d=b.data, a=b.tunes?.alignTune?.align||'left', s=a!=='left'?` style="text-align:${a}"`:'';
        if(b.type==='paragraph')return`<p${s}>${d.text}</p>`;
        if(b.type==='header')return`<h${d.level}${s}>${d.text}</h${d.level}>`;
        if(b.type==='quote')return`<blockquote class="border-l-4 border-blue-500 bg-blue-50 p-4 my-4">${d.text}${d.caption?`<cite class="block mt-2 text-sm text-gray-500">— ${d.caption}</cite>`:''}</blockquote>`;
        if(b.type==='image'){
            const w=d.width||'100', m=w==='100'?'100%':w+'%';
            return`<figure style="text-align:${d.align||'center'}"><div style="display:inline-block; max-width:${m}; width:100%"><img src="${d.url}" style="width:100%; border-radius:20px; display:block;"></div>${d.caption?`<figcaption class="mt-2 text-xs text-gray-400 italic">${d.caption}</figcaption>`:''}</figure>`;
        }
        if(b.type==='gallery'){
            const cs={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[d.columns]||'grid-cols-2', r=d.aspectRatio||'16/9', ar=r==='auto'?'height:auto;':`aspect-ratio:${r};`;
            return`<div class="grid ${cs} gap-4 my-6">${(d.images||[]).map(x=>`<figure style="margin:0"><img src="${x.url}" style="width:100%; ${ar} object-fit:cover; border-radius:16px; display:block;">${x.caption?`<figcaption style="font-size:11px; color:#94a3b8; text-align:center; margin-top:6px;">${x.caption}</figcaption>`:''}</figure>`).join('')}</div>`;
        }
        if(b.type==='list')return`<${d.style==='ordered'?'ol':'ul'} class="list-inside ${d.style==='ordered'?'list-decimal':'list-disc'}">${(d.items||[]).map(i=>`<li>${typeof i==='object'?i.content:i}</li>`).join('')}</${d.style==='ordered'?'ol':'ul'}>`;
        if(b.type==='table'){
            const rows = d.content || [];
            return `<div class="overflow-x-auto my-4"><table class="min-w-full border-collapse border border-gray-200">
                ${rows.map(row => `<tr>${row.map(cell => `<td class="border border-gray-200 p-2">${cell}</td>`).join('')}</tr>`).join('')}
            </table></div>`;
        }
        return '';
    }).join('\n');
}
document.getElementById('btn-preview').addEventListener('click',async()=>{
    const btn = document.getElementById('btn-preview');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    
    try {
        if(!editor) throw new Error('Editor not initialized');
        const d=await editor.save();
        document.getElementById('prev-title').textContent=document.getElementById('title').value||'Tajuk Artikel';
        document.getElementById('prev-content').innerHTML=buildHtml(d.blocks)||'<p>Mula menaip untuk melihat pratonton...</p>';
        document.getElementById('prev-cat').textContent=document.getElementById('cat-label').textContent||'Umum';
        document.getElementById('preview-modal').classList.add('open');
    } catch(err) {
        console.error('Preview failed:', err);
        Swal.fire({ icon: 'error', title: 'Pratonton Gagal', text: 'Sila pastikan kandungan editor diisi dengan betul sebelum melihat pratonton.' });
    } finally {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
});
document.getElementById('btn-close-preview').addEventListener('click',()=>document.getElementById('preview-modal').classList.remove('open'));
document.querySelectorAll('.preview-device-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
        document.querySelectorAll('.preview-device-btn').forEach(x=>{x.classList.remove('active'); x.classList.add('text-slate-400');});
        btn.classList.add('active'); btn.classList.remove('text-slate-400');
        const f=document.getElementById('preview-frame'), w=btn.dataset.width;
        f.style.maxWidth=w==='full'?'100%':w+'px';
    });
});

// ══ Custom Cross-List-Item Selection Logic ══
let dragStartList = null;
let isDraggingList = false;

document.addEventListener('mousedown', (e) => {
    const li = e.target.closest('.cdx-nested-list__item-content');
    if (li) {
        isDraggingList = true;
        dragStartList = li;
        document.querySelectorAll('.custom-selected-list-item').forEach(el => el.classList.remove('custom-selected-list-item'));
        li.classList.add('custom-selected-list-item');
    } else {
        document.querySelectorAll('.custom-selected-list-item').forEach(el => el.classList.remove('custom-selected-list-item'));
    }
});

document.addEventListener('mousemove', (e) => {
    if (!isDraggingList || !dragStartList) return;
    const currentLi = e.target.closest('.cdx-nested-list__item-content');
    if (!currentLi) return;

    const block = currentLi.closest('.ce-block');
    if (!block || block !== dragStartList.closest('.ce-block')) return;

    const allItems = Array.from(block.querySelectorAll('.cdx-nested-list__item-content'));
    const startIdx = allItems.indexOf(dragStartList);
    const endIdx = allItems.indexOf(currentLi);

    const min = Math.min(startIdx, endIdx);
    const max = Math.max(startIdx, endIdx);

    allItems.forEach((el, idx) => {
        if (idx >= min && idx <= max) {
            el.classList.add('custom-selected-list-item');
        } else {
            el.classList.remove('custom-selected-list-item');
        }
    });
});

document.addEventListener('mouseup', () => {
    isDraggingList = false;
});

</script>
@endpush
