@extends('admin.layouts.app')
@section('title', 'Tambah Artikel Berita')
@section('header', 'Tambah Artikel Berita')

@section('actions')
<div class="flex gap-2">
    <button type="button" id="btn-preview"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Preview
    </button>
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

    /* ── Modals ── */
    #crop-modal, #preview-modal, #cat-modal { display: none; }
    #crop-modal.open, #preview-modal.open, #cat-modal.open { display: flex; }
    .preview-device-btn.active { background: #3b82f6; color: white; }

    /* ── Custom Scrollbar ── */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f9fafb; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #d1d5db; }

    input[type="radio"]:checked + .status-card { border-color: #3b82f6; background: #eff6ff; }
    input[type="radio"]:checked + .status-card .status-icon { background: #3b82f6; color: white; transform: scale(1.1); }
    input[type="radio"]:checked + .status-card .status-check { display: flex; }

    /* ── Custom Dropdown ── */
    #cat-dropdown-menu { display: none; }
    #cat-dropdown-menu.open { display: block; }

    /* Sidebar Layout Fix for Sticky */
    .xl\:sticky {
        align-self: start;
    }
</style>
@endpush

@section('content')
<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" id="news-form">
    @csrf
    <input type="hidden" id="content-input" name="content" value="{{ old('content') }}">

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">

        {{-- Left: Content --}}
        <div class="xl:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                {{-- Thumbnail moved here --}}
                <div class="mb-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Visual Utama (Thumbnail)</p>
                    <div id="thumb-wrap" class="{{ old('thumbnail_url') ? '' : 'hidden' }} mb-4 relative group rounded-2xl overflow-hidden border border-gray-100 aspect-video bg-gray-50 max-w-2xl mx-auto">
                        <img id="thumb-preview" src="{{ old('thumbnail_url') }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <button type="button" id="btn-rm-thumb" class="bg-white/20 backdrop-blur-md text-white p-3 rounded-full hover:bg-red-500 transition shadow-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                    </div>
                    <label for="thumbnail" id="thumb-label" style="{{ old('thumbnail_url') ? 'display:none' : '' }}" class="flex flex-col items-center justify-center gap-3 border-2 border-dashed border-gray-200 rounded-2xl py-12 cursor-pointer text-gray-400 hover:border-blue-400 hover:text-blue-500 hover:bg-blue-50/30 transition group max-w-2xl mx-auto">
                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center group-hover:bg-blue-50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="text-center">
                            <p class="text-xs font-bold uppercase tracking-wide">Pilih Visual Utama</p>
                            <p class="text-[10px] text-gray-300 mt-1">JPG, PNG, WEBP (Nisbah 16:9 disyorkan)</p>
                        </div>
                        <input type="file" id="thumbnail" accept="image/*" class="hidden">
                        <input type="hidden" name="thumbnail_url" id="thumbnail_url" value="{{ old('thumbnail_url') }}">
                    </label>
                </div>

                <div class="border-t border-gray-50 pt-8">
                    <label for="title" class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-3">Tajuk Artikel <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" autofocus
                           class="w-full px-0 py-2 text-3xl font-extrabold border-0 border-b-2 border-gray-100 focus:border-blue-500 outline-none text-gray-900 bg-transparent transition placeholder:text-gray-200"
                           placeholder="Masukkan tajuk di sini...">
                    @error('title') <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-4 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                    <div>
                        <p class="text-xs font-bold text-gray-700 uppercase tracking-wider">Kandungan Utama</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">Gunakan toolbar <span class="bg-white px-1 border rounded text-gray-600">+</span> untuk menambah elemen</p>
                    </div>
                </div>
                <div id="editorjs" class="px-8 py-6"></div>
                @error('content') <p class="text-red-500 text-xs px-8 pb-4 font-medium">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Right: Settings (Sticky) --}}
        <div class="space-y-6 xl:sticky xl:top-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Status Penerbitan</p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach(['draft'=>['Draf','Simpan Dulu','text-amber-600 bg-amber-50'],'published'=>['Terbit','Siarkan','text-emerald-600 bg-emerald-50']] as $val=>[$lbl,$desc,$cls])
                    <div class="relative">
                        <input type="radio" name="status" value="{{ $val }}" {{ old('status','draft')===$val?'checked':'' }} class="sr-only" id="st-{{$val}}">
                        <label for="st-{{$val}}" class="status-card flex flex-col items-center gap-2 cursor-pointer p-4 rounded-2xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/10 transition group relative">
                            <div class="status-icon w-10 h-10 rounded-full {{ $cls }} flex items-center justify-center transition duration-300">
                                @if($val === 'draft')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @endif
                            </div>
                            <p class="text-[11px] font-bold {{ explode(' ',$cls)[0] }}">{{ $lbl }}</p>
                            <div class="status-check hidden absolute top-2 right-2">
                                <div class="w-4 h-4 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Klasifikasi Kategori</p>
                
                {{-- Custom Searchable Dropdown --}}
                <div class="relative" id="cat-dropdown-container">
                    <button type="button" onclick="toggleCatDropdown()" id="cat-trigger" 
                            class="w-full flex items-center justify-between px-4 py-3 text-sm border border-gray-100 bg-gray-50/50 rounded-xl hover:bg-white hover:border-blue-200 transition text-left group">
                        <span id="cat-label" class="text-gray-600 font-medium">-- Pilih Kategori --</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-transform" id="cat-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div id="cat-dropdown-menu" class="absolute z-[50] mt-2 w-full bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden animate-in fade-in slide-in-from-top-2 duration-200">
                        <div class="p-3 border-b border-gray-50">
                            <div class="relative">
                                <input type="text" id="cat-search" placeholder="Cari kategori..." 
                                       class="w-full pl-9 pr-4 py-2 text-xs border border-gray-100 bg-gray-50/50 rounded-lg focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition">
                                <svg class="absolute left-3 top-2.5 w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                        </div>
                        
                        <div id="cat-options" class="max-h-60 overflow-y-auto p-2 space-y-0.5 custom-scrollbar">
                            {{-- Inject via JS --}}
                        </div>

                        <div class="p-2 border-t border-gray-50 bg-gray-50/50">
                            <button type="button" onclick="openCategoryModal()" class="w-full py-2 text-[10px] font-bold text-blue-600 hover:bg-white rounded-lg transition uppercase tracking-wider flex items-center justify-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                Urus Kategori
                            </button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="category_id" id="category_id_val" value="{{ old('category_id') }}">
                @error('category_id') <p class="text-red-500 text-[10px] mt-2 font-medium">{{ $message }}</p> @enderror
            </div>

            <button type="button" id="btn-save"
                    class="w-full py-4 bg-blue-600 text-white font-extrabold rounded-2xl hover:bg-blue-700 active:scale-[0.98] transition shadow-xl shadow-blue-200 uppercase tracking-widest text-xs">
                Simpan Draf
            </button>
        </div>
    </div>
</form>

{{-- Category Management Modal --}}
<div id="cat-modal" class="fixed inset-0 z-[1000] bg-slate-900/60 backdrop-blur-md items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-800 uppercase tracking-widest text-[10px]">Pengurusan Kategori</h3>
            <div class="flex items-center gap-2">
                <button type="button" onclick="toggleAddSection()" class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </button>
                <button type="button" onclick="closeCategoryModal()" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition">✕</button>
            </div>
        </div>
        
        <div class="p-6">
            {{-- Add Form (Hidden by default) --}}
            <div id="modal-add-section" class="hidden mb-6 p-4 bg-blue-50/50 rounded-2xl border border-blue-100 animate-in slide-in-from-top-2 duration-200">
                <label class="block text-[10px] font-black text-blue-600 uppercase tracking-wider mb-2">Kategori Baru</label>
                <div class="flex gap-2">
                    <input type="text" id="new-cat-name" placeholder="cth: Sukan, Ekonomi..." 
                           class="flex-1 px-4 py-2.5 text-sm border-0 bg-white rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 outline-none transition">
                    <button type="button" onclick="addNewCategory()" class="px-4 py-2.5 bg-blue-600 text-white text-xs font-black rounded-xl hover:bg-blue-700 transition shadow-md">SIMPAN</button>
                </div>
            </div>

            {{-- Modal Search --}}
            <div class="relative mb-4">
                <input type="text" id="modal-cat-search" placeholder="Cari untuk padam..." 
                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-100 bg-gray-50/50 rounded-xl focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition">
                <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            
            <div id="modal-cat-list" class="space-y-1 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                {{-- Categories injected via JS --}}
            </div>
        </div>
    </div>
</div>

{{-- Crop Modal --}}
<div id="crop-modal" class="fixed inset-0 z-[1000] bg-black/90 backdrop-blur-md items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
            <h3 class="font-bold text-gray-800 text-sm italic tracking-tight">Kekemasan Visual</h3>
            <div id="crop-queue-info" class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">PROSES</div>
        </div>
        <div class="bg-gray-100 flex items-center justify-center" style="height:380px;">
            <img id="crop-target" src="" alt="" style="max-height:360px; max-width:100%;">
        </div>
        <div class="px-6 py-4 bg-white border-t flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-1.5 p-1 bg-gray-50 rounded-xl">
                <button class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent bg-white shadow-sm hover:translate-y-[-1px] transition" data-ratio="NaN">Bebas</button>
                <button class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1.777">16:9</button>
                <button class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1.333">4:3</button>
                <button class="crop-ar px-3 py-1.5 text-[10px] font-bold rounded-lg border border-transparent text-gray-400 hover:text-gray-600 transition" data-ratio="1">1:1</button>
            </div>
            <div class="flex items-center gap-3">
                <button id="btn-crop-cancel" class="px-5 py-2.5 text-xs font-bold text-gray-500 hover:text-gray-700 transition">Batal</button>
                <button id="btn-crop-skip" class="px-5 py-2.5 text-xs font-bold bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Asal</button>
                <button id="btn-crop-done" class="px-6 py-2.5 text-xs font-black bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition shadow-md">POTONG</button>
            </div>
        </div>
    </div>
</div>

{{-- Preview Modal --}}
<div id="preview-modal" class="fixed inset-0 z-[900] bg-slate-900/40 backdrop-blur-sm items-start justify-center overflow-y-auto p-4 py-12">
    <div class="bg-white w-full max-w-6xl rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] overflow-hidden animate-in slide-in-from-bottom-8 duration-500">
        <div class="flex items-center justify-between px-6 py-4 bg-white border-b sticky top-0 z-10">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 bg-rose-500 rounded-full"></div>
                <div class="w-2.5 h-2.5 bg-amber-400 rounded-full"></div>
                <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full"></div>
                <span class="ml-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest hidden md:inline">Pratonton Artikel</span>
            </div>
            <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl">
                <button class="preview-device-btn active px-4 py-1.5 text-[10px] font-bold rounded-lg shadow-sm transition" data-width="375">📱 Mobile</button>
                <button class="preview-device-btn px-4 py-1.5 text-[10px] font-bold text-slate-400 hover:text-slate-600 transition" data-width="768">📟 Tablet</button>
                <button class="preview-device-btn px-4 py-1.5 text-[10px] font-bold text-slate-400 hover:text-slate-600 transition" data-width="full">🖥️ Desktop</button>
            </div>
            <button id="btn-close-preview" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition leading-none text-xl">✕</button>
        </div>
        <div class="bg-slate-50/50 p-6 md:p-10 min-h-[70vh]">
            <div id="preview-frame" class="bg-white mx-auto transition-all duration-500 rounded-2xl shadow-2xl shadow-slate-200/50 overflow-hidden" style="max-width:375px; width:100%">
                <div class="p-8 md:p-12">
                    <div id="prev-cat" class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black rounded-lg uppercase tracking-widest mb-6 border border-blue-100">Kategori</div>
                    <h1 id="prev-title" class="text-3xl font-extrabold text-slate-900 mb-6 leading-[1.2] tracking-tight">Tajuk artikel</h1>
                    <div id="prev-thumbnail-wrap" class="hidden rounded-2xl overflow-hidden aspect-video mb-8 shadow-lg">
                        <img id="prev-thumbnail" src="" class="w-full h-full object-cover">
                    </div>
                    <div id="prev-content" class="prose prose-slate prose-lg max-w-none prose-p:leading-relaxed prose-headings:tracking-tight prose-img:shadow-md prose-img:rounded-3xl prose-blockquote:border-blue-500 prose-blockquote:bg-blue-50/50 prose-blockquote:py-2 prose-blockquote:px-6">
                        <p class="text-slate-300 italic text-sm">Kandungan pratonton akan dipaparkan di sini...</p>
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
    constructor({data}){this.data=data||{align:'left'};this._root=null;}
    render(){
        const wrap=document.createElement('div');
        wrap.innerHTML='<div style="font-[800] text-[9px] text-slate-400 px-3 py-2 uppercase tracking-wide">Alignment</div>';
        const row=document.createElement('div'); row.style.cssText='display:flex; gap:4px; padding:0 8px 8px;';
        const aligns=[
            {v:'left',i:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="15" y2="12"/><line x1="3" y1="18" x2="19" y2="18"/></svg>'},
            {v:'center',i:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="7" y1="12" x2="17" y2="12"/><line x1="5" y1="18" x2="19" y2="18"/></svg>'},
            {v:'right',i:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="9" y1="12" x2="21" y2="12"/><line x1="5" y1="18" x2="21" y2="18"/></svg>'},
        ];
        aligns.forEach(a=>{
            const b=document.createElement('button'); b.type='button'; b.innerHTML=a.i; b.className='align-tune-btn'+(this.data.align===a.v?' active':'');
            b.addEventListener('click',()=>{ this.data.align=a.v; row.querySelectorAll('.align-tune-btn').forEach(x=>x.classList.remove('active')); b.classList.add('active'); if(this._root)this._root.style.textAlign=a.v; });
            row.appendChild(b);
        });
        wrap.appendChild(row); return wrap;
    }
    wrap(c){this._root=c; c.style.textAlign=this.data.align||'left'; return c;}
    save(){return this.data;}
}

class CustomImageBlock{
    static get toolbox(){return{title:'Gambar',icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 15l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"/></svg>'};}
    constructor({data}){this.data={url:data.url||'',caption:data.caption||'',width:data.width||'100',align:data.align||'center'};this.wrapper=null;}
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
    save(){return this.data;}
}

class ImageGalleryTool{
    static get toolbox(){return{title:'Galeri',icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>'};}
    constructor({data}){this.data={images:data.images||[],columns:data.columns||2,aspectRatio:data.aspectRatio||'16/9'};this.wrapper=null;}
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
    save(){return this.data;}
}

// ══ Init ══
const editor=new EditorJS({
    holder:'editorjs', placeholder:'Mula berkarya di sini...', inlineToolbar:['bold','italic','link'],
    data:{!! old('content','null') !!},
    tools:{
        alignTune:AlignTune,
        header:{class:Header, config:{levels:[2,3,4], defaultLevel:2}, tunes:['alignTune']},
        list:{class:NestedList, inlineToolbar:true},
        quote:{class:Quote, inlineToolbar:true, config:{quotePlaceholder:'Kata-kata hikmah...', captionPlaceholder:'Penulis'}},
        image:{class:CustomImageBlock},
        gallery:{class:ImageGalleryTool},
        paragraph:{tunes:['alignTune']}
    }
});

// ══ Form ══
// ══ Category Management ══
let allCategories = [];

function toggleCatDropdown() {
    const menu = document.getElementById('cat-dropdown-menu');
    const arrow = document.getElementById('cat-arrow');
    const isOpen = menu.classList.contains('open');
    
    // Close on second click
    if(isOpen) {
        menu.classList.remove('open');
        arrow.style.transform = 'rotate(0deg)';
    } else {
        menu.classList.add('open');
        arrow.style.transform = 'rotate(180deg)';
        document.getElementById('cat-search').focus();
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', e => {
    if(!document.getElementById('cat-dropdown-container').contains(e.target)) {
        document.getElementById('cat-dropdown-menu').classList.remove('open');
        document.getElementById('cat-arrow').style.transform = 'rotate(0deg)';
    }
});

function openCategoryModal() { 
    document.getElementById('cat-dropdown-menu').classList.remove('open');
    document.getElementById('cat-modal').classList.add('open');
    document.getElementById('modal-add-section').classList.add('hidden');
    refreshCategoryLists();
}

function closeCategoryModal() { document.getElementById('cat-modal').classList.remove('open'); }

function toggleAddSection() {
    const sec = document.getElementById('modal-add-section');
    sec.classList.toggle('hidden');
    if(!sec.classList.contains('hidden')) document.getElementById('new-cat-name').focus();
}

document.getElementById('cat-search').addEventListener('input', e => {
    const q = e.target.value.toLowerCase();
    renderCategoryOptions(allCategories.filter(c => c.name.toLowerCase().includes(q)));
});

document.getElementById('modal-cat-search').addEventListener('input', e => {
    const q = e.target.value.toLowerCase();
    renderModalCategoryList(allCategories.filter(c => c.name.toLowerCase().includes(q)));
});

async function refreshCategoryLists() {
    const r = await fetch('{{ route("admin.news.categories.index") }}');
    allCategories = await r.json();
    renderCategoryOptions(allCategories);
    renderModalCategoryList(allCategories);
    
    // Sync current selection label
    const selectedId = document.getElementById('category_id_val').value;
    const selectedCat = allCategories.find(c => c.id == selectedId);
    if(selectedCat) selectCategory(selectedCat.id, selectedCat.name);
}

function renderModalCategoryList(cats) {
    const modalList = document.getElementById('modal-cat-list');
    if(cats.length === 0) {
        modalList.innerHTML = '<p class="text-[10px] text-gray-400 text-center py-8 italic">Tiada kategori dijumpai...</p>';
        return;
    }
    modalList.innerHTML = cats.map(c => `
        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100 group">
            <span class="text-sm font-medium text-gray-700">${c.name}</span>
            <button type="button" onclick="deleteCategory(${c.id})" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
            </button>
        </div>
    `).join('');
}

function renderCategoryOptions(cats) {
    const container = document.getElementById('cat-options');
    if(cats.length === 0) {
        container.innerHTML = '<p class="text-[10px] text-gray-400 text-center py-4 italic">Tiada kategori dijumpai...</p>';
        return;
    }
    
    container.innerHTML = cats.map(c => `
        <button type="button" onclick="selectCategory(${c.id}, '${c.name.replace(/'/g, "\\'")}')" 
                class="w-full text-left px-3 py-2 text-xs text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition flex items-center justify-between group">
            <span>${c.name}</span>
            <svg class="w-3 h-3 text-blue-500 opacity-0 group-hover:opacity-100 transition" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
        </button>
    `).join('');
}

function selectCategory(id, name) {
    document.getElementById('category_id_val').value = id;
    document.getElementById('cat-label').textContent = name;
    document.getElementById('cat-label').classList.remove('text-gray-400');
    document.getElementById('cat-label').classList.add('text-blue-600', 'font-bold');
    document.getElementById('cat-dropdown-menu').classList.remove('open');
    document.getElementById('cat-arrow').style.transform = 'rotate(0deg)';
}

// Initial fetch
refreshCategoryLists();

async function addNewCategory() {
    const name = document.getElementById('new-cat-name').value;
    if(!name) return;
    
    const r = await fetch('{{ route("admin.news.categories.store") }}', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ name })
    });
    
    const d = await r.json();
    if(d.ok) {
        document.getElementById('new-cat-name').value = '';
        refreshCategoryLists();
    } else {
        Swal.fire({ icon: 'error', title: 'Ralat', text: d.message || 'Gagal menambah kategori.' });
    }
}

async function deleteCategory(id) {
    if(!confirm('Adakah anda pasti mahu memadam kategori ini?')) return;
    
    const r = await fetch(`{{ url('admin/news-categories') }}/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' }
    });
    
    const d = await r.json();
    if(d.ok) {
        refreshCategoryLists();
    } else {
        Swal.fire({ icon: 'error', title: 'Had Sekatan', text: d.message });
    }
}

document.getElementById('btn-save').addEventListener('click',async()=>{
    const b=document.getElementById('btn-save'); 
    const status = document.querySelector('input[name="status"]:checked').value;
    const originalText = b.textContent;
    b.textContent='PROSES...'; b.disabled=true;
    try{ const d=await editor.save(); document.getElementById('content-input').value=JSON.stringify(d); document.getElementById('news-form').submit(); }
    catch{ b.textContent=originalText; b.disabled=false; }
});

// Update button text on status change
document.querySelectorAll('input[name="status"]').forEach(radio => {
    radio.addEventListener('change', e => {
        const btn = document.getElementById('btn-save');
        btn.textContent = e.target.value === 'published' ? 'Terbitkan' : 'Simpan Draf';
    });
});

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
        if(b.type==='quote')return`<blockquote>${d.text}${d.caption?`<cite>— ${d.caption}</cite>`:''}</blockquote>`;
        if(b.type==='image'){
            const w=d.width||'100', m=w==='100'?'100%':w+'%';
            return`<figure style="text-align:${d.align||'center'}"><div style="display:inline-block; max-width:${m}; width:100%"><img src="${d.url}" style="width:100%; border-radius:20px; display:block;"></div>${d.caption?`<figcaption>${d.caption}</figcaption>`:''}</figure>`;
        }
        if(b.type==='gallery'){
            const cs={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[d.columns]||'grid-cols-2', r=d.aspectRatio||'16/9', ar=r==='auto'?'height:auto;':`aspect-ratio:${r};`;
            return`<div class="grid ${cs} gap-4 my-6">${(d.images||[]).map(x=>`<figure style="margin:0"><img src="${x.url}" style="width:100%; ${ar} object-fit:cover; border-radius:16px; display:block;">${x.caption?`<figcaption style="font-size:11px; color:#94a3b8; text-align:center; margin-top:6px;">${x.caption}</figcaption>`:''}</figure>`).join('')}</div>`;
        }
        if(b.type==='list')return`<${d.style==='ordered'?'ol':'ul'}>${(d.items||[]).map(i=>`<li>${typeof i==='object'?i.content:i}</li>`).join('')}</${d.style==='ordered'?'ol':'ul'}>`;
        return '';
    }).join('\n');
}
document.getElementById('btn-preview').addEventListener('click',async()=>{
    const d=await editor.save();
    document.getElementById('prev-title').textContent=document.getElementById('title').value||'Tajuk Artikel';
    document.getElementById('prev-content').innerHTML=buildHtml(d.blocks)||'<p>Mula menaip untuk melihat pratonton...</p>';
    document.getElementById('prev-cat').textContent=document.getElementById('cat-label').textContent||'Umum';
    document.getElementById('preview-modal').classList.add('open');
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
</script>
@endpush
