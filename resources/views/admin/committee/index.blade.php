@extends('admin.layouts.app')

@section('title', 'Pengurusan Kepimpinan STU')
@section('header', 'Pengurusan AJK & Exco')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<style>
    /* ─── Cards ─────────────────────────────── */
    .member-wrap { position: relative; user-select: none; transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    body.sortable-active, body.sortable-active * { cursor: grabbing !important; }
    
    .sortable-ghost { opacity: 0.1 !important; transform: scale(0.6) rotate(-5deg); filter: grayscale(1) blur(2px); transition: all 0.3s; }
    .sortable-chosen { outline: 6px solid rgba(79, 70, 229, 0.3); outline-offset: 15px; border-radius: 9999px; }
    
    .sortable-drag { 
        filter: drop-shadow(0 40px 80px rgba(79, 70, 229, 0.5)) brightness(1.1); 
        transform: scale(1.1) rotate(4deg) translateY(-15px) !important; 
        z-index: 100000 !important; 
        pointer-events: none;
    }

    /* ─── Drag Handle ──────────────────────── */
    .drag-handle { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); background: #4f46e5; border-radius: 0.75rem; }
    .member-wrap:hover .drag-handle { transform: scale(1.1) rotate(15deg); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4); }
    
    /* ─── Hover Overlay ────────────────────── */
    .card-overlay { opacity: 0; transform: scale(0.8); transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); pointer-events: none; }
    .member-wrap:hover .card-overlay { opacity: 1; transform: scale(1); pointer-events: auto; }

    /* ─── Row Groups ───────────────────────── */
    .row-group { border-radius: 2.5rem; border: 2px dashed #e2e8f0; transition: all 0.3s; background: #fcfcfd; }
    .row-group:hover { border-color: #cbd5e1; background: #f8fafc; }
    .row-group.drag-over { border-color: #6366f1; background: rgba(99, 102, 241, 0.05); border-style: solid; }

    /* ─── Buttons & UI ─────────────────────── */
    .col-btn { background: white; color: #64748b; font-weight: 800; border: 1px solid #e2e8f0; border-radius: 0.85rem; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
    .col-btn:hover:not(.active) { border-color: #cbd5e1; color: #1e293b; background: #f8fafc; transform: translateY(-1px); }
    .col-btn.active { background: #4f46e5; color: white; border-color: #4338ca; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.5); transform: scale(1.1); }

    /* ─── Validation Styling ───────────────── */
    .input-error { border-color: #ef4444 !important; background-color: #fff1f2 !important; color: #991b1b !important; ring: 4px solid rgba(239, 68, 68, 0.1) !important; }
    .error-label { color: #ef4444 !important; font-weight: 800 !important; font-size: 10px !important; margin-top: 6px; display: block; text-transform: uppercase; letter-spacing: 0.05em; }

    /* ─── Modal/Drawer ─────────────────────── */
    #drawer { transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1); transform: translateX(100%); width: 100%; max-width: 500px; }
    #drawer.open { transform: translateX(0); }
    #overlay { transition: opacity 0.3s; }

    /* SweetAlert Custom Styles */
    .swal2-popup.rounded-confirm { border-radius: 2rem !important; padding: 2rem !important; }
    .swal2-title.custom-title { font-weight: 900 !important; text-transform: uppercase !important; letter-spacing: -0.05em !important; color: #1e293b !important; }
</style>
@endpush

@section('content')

{{-- ══ TOOLBAR ══ --}}
<div class="sticky top-0 z-30 -mx-6 -mt-6 mb-8 px-6 py-4 bg-white/90 backdrop-blur-xl border-b border-gray-100 shadow-sm">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-1.5 h-10 bg-indigo-600 rounded-full"></div>
            <div>
                <p class="text-sm font-black text-gray-900 uppercase tracking-widest leading-none">Pengurusan Kepimpinan</p>
                <p class="text-[10px] text-gray-400 font-bold mt-1 uppercase tracking-tight">Eksperimentasi & Susunan Secara Visual (Drag & Drop)</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ url('/ahli-tertinggi-exco') }}" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-3 text-xs font-black text-gray-600 bg-gray-50 border border-gray-200 rounded-2xl hover:bg-gray-100 transition active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Lihat Paparan Umum
            </a>
        </div>
    </div>
</div>

@foreach([['TOP','top','AHLI JAWATANKUASA TERTINGGI', $topMembers, $topRowConfigs],
          ['EXCO','exco','EXCO BAHAGIAN', $excoMembers, $excoRowConfigs]] as [$type, $prefix, $heading, $members, $rowConfigs])

<div class="mb-16">
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <div class="h-8 w-1 bg-indigo-600 rounded-full"></div>
            <h2 class="text-xl font-black text-gray-900 uppercase tracking-tighter">{{ $heading }}</h2>
        </div>
        <button onclick="addRow('{{ $type }}')"
                class="inline-flex items-center gap-2 px-6 py-3.5 bg-indigo-600 text-white text-xs font-black rounded-[1.25rem] hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/30 active:scale-95 uppercase tracking-widest">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Tambah Baris Baru
        </button>
    </div>

    <div id="{{ $prefix }}-rows" class="space-y-10">
        @foreach($rowConfigs as $rowIdx => $rowCfg)
        @php
            $rowMembers = $members->get((int)$rowIdx, collect());
            $cols       = max(1, min(3, (int)($rowCfg['cols'] ?? 1)));
            $colMap     = [1=>'grid-cols-1', 2=>'grid-cols-1 sm:grid-cols-2', 3=>'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3'];
            $colClass   = $colMap[$cols] ?? 'grid-cols-1';
        @endphp
        <div class="row-group p-10" data-row-index="{{ $rowIdx }}" data-type="{{ $type }}">
            <div class="flex flex-wrap items-center justify-between gap-6 mb-10">
                <div class="flex items-center gap-5">
                    <div class="bg-indigo-50 px-5 py-2 rounded-2xl border border-indigo-100/50">
                        <span class="text-[11px] font-black text-indigo-700 uppercase tracking-widest font-mono">BARIS {{ (int)$rowIdx + 1 }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span class="text-[11px] font-bold uppercase tracking-widest">{{ $rowMembers->count() }} Ahli</span>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-3 bg-white/50 p-2 rounded-2xl border border-gray-100 shadow-sm">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest pl-2 hidden sm:inline">Lajur:</span>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        @foreach([1,2,3] as $c)
                        <button type="button" onclick="setRowCols(this,'{{ $type }}',{{ $rowIdx }},{{ $c }})"
                                class="col-btn w-9 h-9 md:w-11 md:h-11 text-xs flex items-center justify-center {{ (int)$c === (int)$cols ? 'active' : '' }} font-mono">{{ $c }}</button>
                        @endforeach
                    </div>
                    <div class="h-6 w-px bg-gray-200 mx-0.5 md:mx-1"></div>
                    <button type="button" onclick="openDrawer(null,'{{ $type }}',{{ $rowIdx }})"
                            class="w-9 h-9 md:w-11 md:h-11 flex items-center justify-center bg-emerald-500 text-white rounded-xl md:rounded-2xl hover:bg-emerald-600 transition active:scale-90 shadow-lg shadow-emerald-500/30" title="Tambah ahli">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    </button>
                    @if(count($rowConfigs) > 1)
                    <button type="button" onclick="deleteRow('{{ $type }}',{{ $rowIdx }})"
                            class="w-9 h-9 md:w-11 md:h-11 flex items-center justify-center bg-red-50 text-red-500 rounded-xl md:rounded-2xl hover:bg-red-500 hover:text-white transition active:scale-90 border border-red-100" title="Padam baris">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                    @endif
                </div>
            </div>

            <div class="member-grid grid {{ $colClass }} gap-12 lg:gap-16 justify-items-center min-h-[220px] py-4"
                 id="{{ $prefix }}-row-{{ $rowIdx }}" data-row="{{ $rowIdx }}" data-type="{{ $type }}">
                @forelse($rowMembers as $member)
                @php $imgSrc = $member->image_path ? Storage::url($member->image_path) : asset('images/lelaki-pending.png'); @endphp
                <div class="member-wrap flex flex-col items-center text-center" data-id="{{ $member->id }}" data-row="{{ $rowIdx }}" data-type="{{ $type }}">
                    @include('admin.committee.partials.member-card', ['member' => $member, 'imgSrc' => $imgSrc])
                </div>
                @empty
                <div class="col-span-full py-20 flex flex-col items-center justify-center opacity-30 select-none border-2 border-dashed border-gray-200 rounded-[3rem] w-full max-w-md">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-gray-500">Baris Kosong · Seret Ahli Ke Sini</p>
                </div>
                @endforelse
            </div>
        </div>
        @endforeach
    </div>
</div>
@if($type === 'TOP') <div class="relative py-12"><div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div><div class="relative flex justify-center"><span class="bg-white px-8"><div class="w-3 h-3 bg-indigo-100 rounded-full"></div></span></div></div> @endif
@endforeach

{{-- ══ OVERLAY ══ --}}
<div id="overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-md z-40 hidden opacity-0" onclick="closeDrawer()"></div>

{{-- ══ DRAWER ══ --}}
<div id="drawer" class="fixed top-0 right-0 h-full bg-white shadow-[-30px_0_60px_rgba(30,41,59,0.15)] z-50 flex flex-col">
    <div class="px-10 py-10 border-b border-gray-50 bg-gray-50/20">
        <div class="flex items-center justify-between mb-2">
            <h3 id="d-title" class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Profil Ahli</h3>
            <button onclick="closeDrawer()" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-white border border-gray-100 hover:bg-gray-50 transition shadow-sm text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <p id="d-subtitle" class="text-[10px] font-black text-indigo-400 uppercase tracking-widest"></p>
    </div>
    
    <div class="flex-1 overflow-y-auto p-10 custom-scrollbar space-y-10">
        <form id="member-form" class="space-y-8" oninput="clearValidationErrors(event)">
            @csrf
            <input type="hidden" id="f-id">
            
            {{-- Image Section --}}
            <div class="relative flex flex-col items-center">
                <div class="relative group cursor-pointer" onclick="document.getElementById('f-img').click()">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-white shadow-2xl ring-1 ring-gray-100 group-hover:ring-indigo-400 transition-all duration-500 bg-gray-50">
                        <img id="f-img-preview" src="{{ asset('images/lelaki-pending.png') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <input type="file" id="f-img" class="sr-only" accept="image/*" onchange="previewImg(event)">
                <p class="mt-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Format: JPG/PNG (Max: 4MB)</p>
            </div>

            <div class="grid gap-6">
                <div data-field="name">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-2.5">Nama Penuh <span class="text-red-500">*</span></label>
                    <input type="text" id="f-name" name="name" required class="w-full px-6 py-4.5 text-sm bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 shadow-sm">
                    <span class="error-msg hidden"></span>
                </div>
                
                <div data-field="position">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-2.5">Jawatan Utama <span class="text-red-500">*</span></label>
                    <input type="text" id="f-position" name="position" required placeholder="Cth: PRESIDEN" class="w-full px-6 py-4.5 text-sm bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 shadow-sm">
                    <span class="error-msg hidden"></span>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div data-field="type">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-2.5">Kategori</label>
                        <select id="f-type" name="type" onchange="onTypeOrRowChange()" class="w-full px-5 py-4.5 text-sm bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 appearance-none bg-no-repeat bg-[right_1.5rem_center] cursor-pointer">
                            <option value="TOP">Ahli Tertinggi</option>
                            <option value="EXCO">Exco Bahagian</option>
                        </select>
                    </div>
                    <div data-field="row_index">
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-2.5">Pilih Baris</label>
                        <select id="f-row-select" name="row_index" onchange="onTypeOrRowChange()" class="w-full px-5 py-4.5 text-sm bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all font-bold text-slate-800 appearance-none bg-no-repeat bg-[right_1.5rem_center] cursor-pointer"></select>
                    </div>
                </div>

                <div data-field="sort_order">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.15em] mb-2.5 flex justify-between">
                        <span>No. Kedudukan</span>
                        <span class="text-indigo-500" id="sort-range-info"></span>
                    </label>
                    <input type="number" id="f-sort" name="sort_order" min="1" placeholder="Auto" class="w-full px-6 py-4.5 text-sm bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none transition-all font-bold text-indigo-600 font-mono shadow-sm">
                    <span class="error-msg hidden"></span>
                </div>

                <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 space-y-6">
                    <div class="flex items-center justify-between">
                        <div><p class="text-xs font-black text-slate-700 uppercase tracking-widest">Status Aktif</p><p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Papar di portal umum</p></div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="f-active" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                    <div class="h-px bg-slate-200/50"></div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-400 text-white rounded-xl flex items-center justify-center shadow-lg shadow-yellow-400/20"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
                            <div><p class="text-xs font-black text-slate-700 uppercase tracking-widest">Tonjolkan (Highlight)</p><p class="text-[9px] text-yellow-600 font-bold uppercase tracking-widest mt-0.5">Border emas & kesan khas</p></div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="f-highlight" name="is_highlight" value="1" class="sr-only peer">
                            <div class="w-14 h-7 bg-slate-200 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-yellow-500"></div>
                        </label>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
    
    <div class="px-10 py-8 border-t border-gray-50 bg-gray-50/20 flex gap-4">
        <button onclick="closeDrawer()" class="flex-1 py-4.5 text-xs font-black text-slate-500 bg-white border border-slate-200 rounded-2xl hover:bg-slate-100 transition active:scale-95 uppercase tracking-widest">Batal</button>
        <button id="f-submit" onclick="submitForm()" class="flex-1 py-4.5 text-xs font-black text-white bg-indigo-600 rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/30 active:scale-95 uppercase tracking-widest flex items-center justify-center gap-2">
            <span>Simpan Data</span>
        </button>
    </div>
</div>

{{-- Crop Modal --}}
<div id="crop-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/90 hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white w-full max-w-2xl rounded-[3rem] overflow-hidden shadow-2xl scale-95 transition-transform duration-300" id="crop-content">
        <div class="p-10 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Laraskan Bingkai</h3>
            <button onclick="closeCropModal()" class="text-slate-300 hover:text-slate-500"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="p-10 bg-slate-50 flex items-center justify-center">
            <div class="cropper-container w-full max-h-[50vh] overflow-hidden rounded-3xl shadow-inner bg-white p-2">
                <img id="cropping-image" src="" class="max-w-full block">
            </div>
        </div>
        <div class="p-10 border-t border-gray-50 flex justify-end gap-5">
            <button onclick="closeCropModal()" class="px-8 py-4 text-xs font-black text-slate-400 bg-slate-100 rounded-2xl hover:bg-slate-200 transition uppercase tracking-widest">Batal</button>
            <button onclick="confirmCrop()" class="px-12 py-4 text-xs font-black text-white bg-indigo-600 rounded-2xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-500/30 active:scale-95 uppercase tracking-widest">Sahkan</button>
        </div>
    </div>
</div>

<div id="toast" class="fixed bottom-10 right-10 z-[60] opacity-0 translate-y-10 pointer-events-none transition-all duration-500">
    <div id="toast-inner" class="flex items-center gap-5 px-8 py-6 rounded-[2.5rem] shadow-2xl text-xs font-black text-white uppercase tracking-widest animate-bounce-in">
        <div id="toast-icon-box" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center">
            <svg id="toast-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"></svg>
        </div>
        <span id="toast-msg"></span>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
const CSRF    = document.querySelector('meta[name="csrf-token"]').content;
const BASE    = '{{ rtrim(url("admin/committee"), "/") }}';
const URLS    = {
    reorder:    '{{ route("admin.committee.reorder") }}',
    moveMember: '{{ route("admin.committee.move-member") }}',
    addRow:     '{{ route("admin.committee.add-row") }}',
    deleteRow:  '{{ route("admin.committee.delete-row") }}',
    rowCols:    '{{ route("admin.committee.update-row-cols") }}',
};

const rowConfigs = { TOP: @json(array_keys($topRowConfigs)), EXCO: @json(array_keys($excoRowConfigs)) };
const rowMemberCounts = { TOP: @json($topMembers->map(fn($group) => $group->count())), EXCO: @json($excoMembers->map(fn($group) => $group->count())) };

// ══ CUSTOM CONFIRM HELPER ══
function confirmAction(title, text, confirmText, callback) {
    Swal.fire({
        title: title,
        html: `<p class="text-sm font-medium text-slate-500 leading-relaxed">${text}</p>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#64748b',
        confirmButtonText: confirmText,
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-confirm shadow-2xl',
            title: 'custom-title',
            confirmButton: 'rounded-xl px-8 py-3 text-xs uppercase font-black tracking-widest mx-2',
            cancelButton: 'rounded-xl px-8 py-3 text-xs uppercase font-black tracking-widest mx-2'
        },
        showClass: { popup: 'animate__animated animate__fadeInUp animate__faster' }
    }).then((result) => { if (result.isConfirmed) callback(); });
}

// ══ SortableJS ══
document.querySelectorAll('.member-grid').forEach(el => {
    Sortable.create(el, {
        group: 'unified-pool', animation: 200, handle: '.drag-handle', fallbackOnBody: true, forceFallback: true, swapThreshold: 0.65,
        ghostClass: 'sortable-ghost', chosenClass: 'sortable-chosen', dragClass: 'sortable-drag',
        onStart() { document.body.classList.add('sortable-active'); },
        onEnd(evt) { document.body.classList.remove('sortable-active'); if (evt.from === evt.to) saveMemberOrder(el); },
        onAdd(evt) {
            const memberId = parseInt(evt.item.dataset.id);
            const newRow = parseInt(el.dataset.row);
            const newType = el.dataset.type;
            post(URLS.moveMember, { id: memberId, row_index: newRow, type: newType }).then(d => {
                if (d.success) showToast('Kedudukan berjaya dipindah!', 'success');
            });
            saveMemberOrder(el); saveMemberOrder(evt.from);
        }
    });
});

function saveMemberOrder(grid) {
    const items = [...grid.querySelectorAll(':scope > .member-wrap')].map((el, i) => ({ id: parseInt(el.dataset.id), sort_order: i }));
    if (items.length) post(URLS.reorder, { items });
}

// ══ Row & Column Management ══
function setRowCols(btn, type, rowIdx, cols) {
    // FIX: Clear only within this specific toolbar instance
    const parentContainer = btn.closest('.flex.items-center.gap-2');
    if (parentContainer) {
        parentContainer.querySelectorAll('.col-btn').forEach(b => b.classList.remove('active'));
    }
    btn.classList.add('active');
    
    const prefix = type === 'TOP' ? 'top' : 'exco';
    const grid = document.getElementById(prefix + '-row-' + rowIdx);
    const colMap = { 1:['grid-cols-1'], 2:['grid-cols-1','sm:grid-cols-2'], 3:['grid-cols-1','sm:grid-cols-2','lg:grid-cols-3'] };
    if (grid) {
        ['grid-cols-1','grid-cols-2','grid-cols-3','sm:grid-cols-2','lg:grid-cols-3'].forEach(c => grid.classList.remove(c));
        colMap[cols].forEach(c => grid.classList.add(c));
    }
    post(URLS.rowCols, { type, row_index: rowIdx, cols });
}

async function addRow(type) {
    const d = await post(URLS.addRow, { type, cols: 3 });
    if (d.success) { showToast(d.message); setTimeout(() => location.reload(), 600); }
}

function deleteRow(type, rowIdx) {
    confirmAction('Padam Baris?', 'Adakah anda pasti? Semua ahli dalam baris ini akan dipindahkan ke Baris Utama (Satu).', 'Ya, Padam Baris', async () => {
        const d = await post(URLS.deleteRow, { type, row_index: rowIdx });
        if (d.success) { showToast(d.message); setTimeout(() => location.reload(), 600); }
    });
}

// ══ Image Handling ══
let cropper = null, croppedBlob = null;
function previewImg(e) {
    if (!e.target.files[0]) return;
    const reader = new FileReader();
    reader.onload = (event) => { document.getElementById('cropping-image').src = event.target.result; openCropModal(); };
    reader.readAsDataURL(e.target.files[0]);
}
function openCropModal() {
    const m = document.getElementById('crop-modal'); m.classList.remove('hidden');
    setTimeout(() => { m.classList.add('opacity-100'); document.getElementById('crop-content').classList.remove('scale-95'); }, 10);
    if (cropper) cropper.destroy();
    cropper = new Cropper(document.getElementById('cropping-image'), { aspectRatio: 1, viewMode: 1, autoCropArea: 0.8 });
}
function closeCropModal() {
    const m = document.getElementById('crop-modal'); m.classList.remove('opacity-100');
    document.getElementById('crop-content').classList.add('scale-95'); setTimeout(() => m.classList.add('hidden'), 300);
}
function confirmCrop() {
    cropper.getCroppedCanvas({ width: 600, height: 600 }).toBlob((blob) => {
        croppedBlob = blob; document.getElementById('f-img-preview').src = URL.createObjectURL(blob); closeCropModal();
    }, 'image/jpeg', 0.9);
}

// ══ Drawer & Validation ══
let editingMemberId = null;
function openDrawer(id, type, rowIdx) {
    editingMemberId = id;
    document.getElementById('f-id').value = id || '';
    document.getElementById('f-type').value = type;
    resetForm();
    populateRowSelect(type, rowIdx);
    if (id) {
        document.getElementById('d-title').textContent = 'Kemaskini Profil';
        fetch(`${BASE}/${id}/edit`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } }).then(r => r.json()).then(fill);
    } else { 
        document.getElementById('d-title').textContent = 'Tambah Ahli';
        onTypeOrRowChange(); 
    }
    document.getElementById('overlay').classList.remove('hidden');
    requestAnimationFrame(() => { document.getElementById('overlay').style.opacity = '1'; document.getElementById('drawer').classList.add('open'); });
}
function closeDrawer() {
    document.getElementById('overlay').style.opacity = '0';
    document.getElementById('drawer').classList.remove('open');
    setTimeout(() => document.getElementById('overlay').classList.add('hidden'), 400);
}

function onTypeOrRowChange() {
    const type = document.getElementById('f-type').value, row = document.getElementById('f-row-select').value;
    const counts = rowMemberCounts[type] || {}, count = parseInt(counts[row] || 0);
    const maxPos = editingMemberId ? count : count + 1;
    const sortInput = document.getElementById('f-sort'), info = document.getElementById('sort-range-info');
    sortInput.max = maxPos; info.textContent = `(Maks: ${maxPos})`;
}

function resetForm() { 
    document.getElementById('member-form').reset(); 
    document.getElementById('f-img-preview').src = '{{ asset("images/lelaki-pending.png") }}'; 
    clearValidationErrors();
}
function fill(d) {
    document.getElementById('f-name').value = d.name;
    document.getElementById('f-position').value = d.position;
    document.getElementById('f-sort').value = parseInt(d.sort_order) + 1;
    document.getElementById('f-active').checked = !!d.is_active;
    document.getElementById('f-highlight').checked = !!d.is_highlight;
    document.getElementById('f-img-preview').src = d.image_url;
    onTypeOrRowChange();
}

// ─── VALIDATION HELPERS ───
function clearValidationErrors() {
    const form = document.getElementById('member-form');
    form.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    form.querySelectorAll('.error-label').forEach(el => el.remove());
}

function applyValidationErrors(errors) {
    clearValidationErrors();
    
    Object.keys(errors).forEach(field => {
        const input = document.getElementsByName(field)[0] || document.getElementById(`f-${field}`);
        if (input) {
            input.classList.add('input-error');
            const label = document.createElement('span');
            label.className = 'error-label';
            label.textContent = errors[field][0];
            input.closest('[data-field]')?.appendChild(label);
        }
    });
}

async function submitForm() {
    const btn = document.getElementById('f-submit'), id = document.getElementById('f-id').value;
    const sortInput = document.getElementById('f-sort'), val = parseInt(sortInput.value);
    const min = parseInt(sortInput.min) || 1, max = parseInt(sortInput.max) || 999;

    clearValidationErrors();

    // Client-side Range Check
    if (sortInput.value && (val < min || val > max)) {
        applyValidationErrors({ sort_order: [`Kedudukan mestilah antara ${min} hingga ${max}.`] });
        showToast('Ralat kedudukan!', 'error');
        return;
    }

    btn.disabled = true;
    const fd = new FormData(document.getElementById('member-form'));
    const url = id ? `${BASE}/${id}` : BASE;
    if (id) fd.append('_method', 'PUT');
    if (croppedBlob) fd.append('image_path', croppedBlob, 'cropped.jpg');
    
    try {
        const res = await fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
        const data = await res.json();
        if (data.success) { 
            showToast(data.message); closeDrawer(); 
            setTimeout(() => location.reload(), 700); 
        } else if (res.status === 422) {
            applyValidationErrors(data.errors);
            showToast('Maklumat tidak lengkap!', 'error');
        } else {
            showToast(data.message || 'Ralat berlaku', 'error');
        }
    } catch { showToast('Ralat sambungan!', 'error'); } finally { btn.disabled = false; }
}

function deleteMember(id, name) {
    confirmAction('Padam Ahli?', `Adakah anda pasti ingin memadam <strong>"${name}"</strong>?`, 'Ya, Padam Ahli', async () => {
        const d = await fetch(`${BASE}/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': CSRF, 'X-Requested-With': 'XMLHttpRequest' } }).then(r => r.json());
        if (d.success) { document.querySelector(`[data-id="${id}"]`).remove(); showToast(d.message); }
    });
}

function populateRowSelect(type, selectedRow) {
    const sel = document.getElementById('f-row-select'); sel.innerHTML = '';
    (rowConfigs[type] || [0]).forEach(r => {
        const opt = document.createElement('option'); opt.value = r; opt.textContent = 'Baris ' + (parseInt(r)+1);
        if (parseInt(r) === parseInt(selectedRow)) opt.selected = true; sel.appendChild(opt);
    });
}

async function post(url, body) { return fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, body: JSON.stringify(body) }).then(r => r.json()); }

let toastT;
function showToast(msg, type='success') {
    const t = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    document.getElementById('toast-inner').className = `flex items-center gap-5 px-8 py-6 rounded-[2.5rem] shadow-2xl text-xs font-black text-white uppercase tracking-widest ${type==='success'?'bg-indigo-600':'bg-red-500'}`;
    const iconSide = document.getElementById('toast-icon');
    iconSide.innerHTML = type === 'success' ? '<path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>' : '<path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>';
    t.classList.remove('opacity-0', 'translate-y-10', 'pointer-events-none');
    clearTimeout(toastT); toastT = setTimeout(() => { t.classList.add('opacity-0', 'translate-y-10', 'pointer-events-none'); }, 3000);
}
</script>
@endpush
