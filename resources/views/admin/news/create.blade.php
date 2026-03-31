@extends('admin.layouts.app')
@section('title', 'Tambah Artikel Berita')
@section('header', 'Tambah Artikel Berita')

@section('actions')
<div class="flex gap-2">
    <button type="button" id="btn-preview"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Preview
    </button>
    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
<style>
/* ── Editor Container ── */
#editorjs { min-height: 500px; padding: 16px 0; }
.codex-editor__redactor { padding-bottom: 120px !important; }
.ce-block__content, .ce-toolbar__content { max-width: 100% !important; margin: 0 !important; }
.ce-toolbar__actions { right: 0; }
.ce-paragraph[contenteditable] { line-height: 1.8; color: #374151; font-size: 1rem; }

/* ── Heading Hierarchy (H2/H3/H4 visually distinct) ── */
#editorjs h2 { font-size: 1.875rem !important; font-weight: 800 !important; color: #1e3a5f !important; line-height: 1.2; border-bottom: 2px solid #e5e7eb; padding-bottom: 0.4rem; margin-top: 0.5rem; }
#editorjs h3 { font-size: 1.45rem !important; font-weight: 700 !important; color: #1e3a5f !important; line-height: 1.3; margin-top: 0.25rem; }
#editorjs h4 { font-size: 1.15rem !important; font-weight: 600 !important; color: #374151 !important; line-height: 1.4; }

/* Heading level badge (shows H2/H3/H4 on the left edge) */
.ce-block--selected [data-heading-level] { position: relative; }
.ce-block:has(h2) .ce-block__content::before { content: 'H2'; }
.ce-block:has(h3) .ce-block__content::before { content: 'H3'; }
.ce-block:has(h4) .ce-block__content::before { content: 'H4'; }
.ce-block:has(h2) .ce-block__content::before,
.ce-block:has(h3) .ce-block__content::before,
.ce-block:has(h4) .ce-block__content::before {
    position: absolute; left: -2.5rem; top: 50%; transform: translateY(-50%);
    font-size: 9px; font-weight: 800; padding: 1px 5px; border-radius: 3px;
    background: #dbeafe; color: #1d4ed8; pointer-events: none; white-space: nowrap; }

/* ── Image Tool ── */
.image-tool__image-picture { border-radius: 12px; width: 100%; }
.image-tool__caption { text-align: center; color: #6b7280; font-style: italic; font-size: 0.875rem; margin-top: 0.5rem; }

/* ── Gallery Block ── */
.gallery-block { border: 2px dashed #e5e7eb; border-radius: 14px; padding: 14px; margin: 4px 0; }
.gallery-block:has(*:focus) { border-color: #3b82f6; }
.gallery-img-wrap { position: relative; border-radius: 10px; overflow: hidden; background: #f3f4f6; }
.gallery-img-wrap img { display: block; width: 100%; object-fit: cover; }
.gallery-del-btn { position: absolute; top: 6px; right: 6px; width: 24px; height: 24px; background: rgba(239,68,68,0.9); color: white; border: none; border-radius: 50%; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; line-height: 1; z-index: 10; }
.gallery-caption-inp { width: 100%; padding: 4px 8px; font-size: 11px; border: none; border-top: 1px solid #e5e7eb; background: white; outline: none; color: #4b5563; }
.gallery-caption-inp:focus { background: #eff6ff; }

/* ── Crop Modal ── */
#crop-modal { display: none; }
#crop-modal.open { display: flex; }

/* ── Preview Modal ── */
#preview-modal { display: none; }
#preview-modal.open { display: flex; }
.preview-device-btn.active { background: #1e3a5f; color: white; }

/* ── Width Tune (image settings) ── */
.width-tune-btn { flex: 1; padding: 4px 6px; font-size: 11px; font-weight: 600; border: 1px solid #e5e7eb; background: white; color: #374151; border-radius: 5px; cursor: pointer; transition: all 0.15s; text-align: center; }
.width-tune-btn.active { border-color: #3b82f6; background: #3b82f6; color: white; }
.align-tune-btn { width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 5px; border: 1px solid transparent; background: transparent; cursor: pointer; }
.align-tune-btn.active { border-color: #3b82f6; background: #eff6ff; }
</style>
@endpush

@section('content')
<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data" id="news-form">
    @csrf
    <input type="hidden" id="content-input" name="content" value="{{ old('content') }}">

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ── Left ── --}}
        <div class="xl:col-span-2 space-y-5">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <label for="title" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Tajuk Artikel <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" autofocus
                       class="w-full px-0 py-1 text-2xl font-bold border-0 border-b-2 border-gray-200 focus:border-blue-500 outline-none text-gray-900 bg-transparent transition"
                       placeholder="Tajuk artikel di sini...">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 pt-4 pb-2 border-b border-gray-100 bg-gray-50/60">
                    <p class="text-sm font-semibold text-gray-700">Kandungan Artikel <span class="text-red-500">*</span></p>
                    <p class="text-xs text-gray-400 mt-0.5">Klik <span class="font-mono bg-gray-200 px-1 rounded">+</span> di tepi blok untuk tambah Heading, Gambar, Galeri, Petikan dll. Highlight teks untuk format Bold/Italic.</p>
                </div>
                <div id="editorjs" class="px-6"></div>
                @error('content') <p class="text-red-500 text-xs px-6 pb-3">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <label for="excerpt" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Ringkasan <span class="text-gray-300 font-normal normal-case">(opsional)</span></label>
                <textarea id="excerpt" name="excerpt" rows="3" placeholder="Ringkasan pendek untuk kad senarai berita..."
                          class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-gray-700 resize-y">{{ old('excerpt') }}</textarea>
            </div>
        </div>

        {{-- ── Right ── --}}
        <div class="space-y-5">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Status</p>
                @foreach(['draft'=>['Draft','Simpan sebagai draf','text-yellow-600 bg-yellow-50'],'published'=>['Published','Tayangkan kepada awam','text-green-600 bg-green-50'],'archived'=>['Archived','Sembunyikan','text-gray-500 bg-gray-50']] as $val=>[$lbl,$desc,$cls])
                <label class="flex items-start gap-3 cursor-pointer p-2.5 rounded-lg hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                    <input type="radio" name="status" value="{{ $val }}" {{ old('status','draft')===$val?'checked':'' }} class="mt-0.5">
                    <div>
                        <p class="text-sm font-semibold {{ explode(' ',$cls)[0] }}">{{ $lbl }}</p>
                        <p class="text-xs text-gray-400">{{ $desc }}</p>
                    </div>
                </label>
                @endforeach
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <label for="category_id" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Gambar Utama (Thumbnail)</p>
                <div id="thumb-wrap" class="hidden mb-3 relative group rounded-lg overflow-hidden border border-gray-200">
                    <img id="thumb-preview" src="" class="w-full h-36 object-cover">
                    <button type="button" id="btn-rm-thumb"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm opacity-0 group-hover:opacity-100 transition">✕</button>
                </div>
                <label for="thumbnail" class="flex flex-col items-center justify-center gap-1 border-2 border-dashed border-gray-300 rounded-lg py-5 cursor-pointer text-gray-400 hover:border-blue-400 hover:text-blue-500 transition text-sm">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Klik untuk muat naik
                    <span class="text-xs text-gray-400">JPG, PNG, WEBP • maks 3MB</span>
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                </label>
            </div>

            <button type="button" id="btn-save"
                    class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 active:scale-95 transition shadow-md shadow-blue-200">
                Simpan Artikel
            </button>
        </div>
    </div>
</form>

{{-- ── CROP MODAL ── --}}
<div id="crop-modal" class="fixed inset-0 z-[400] bg-black/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b">
            <h3 class="font-bold text-gray-800">✂️ Potong Gambar</h3>
            <span id="crop-queue-info" class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full"></span>
        </div>
        <div class="bg-gray-900 flex items-center justify-center" style="height:340px;overflow:hidden;">
            <img id="crop-target" src="" alt="" style="max-height:330px;max-width:100%;">
        </div>
        <div class="px-5 py-3 bg-gray-50 border-t flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <span class="text-xs text-gray-500 font-semibold">Nisbah:</span>
                <button class="crop-ar px-2.5 py-1 text-xs font-semibold border rounded-lg bg-white hover:bg-gray-100 transition" data-ratio="NaN">Bebas</button>
                <button class="crop-ar px-2.5 py-1 text-xs font-semibold border rounded-lg bg-white hover:bg-gray-100 transition" data-ratio="1.777">16:9</button>
                <button class="crop-ar px-2.5 py-1 text-xs font-semibold border rounded-lg bg-white hover:bg-gray-100 transition" data-ratio="1.333">4:3</button>
                <button class="crop-ar px-2.5 py-1 text-xs font-semibold border rounded-lg bg-white hover:bg-gray-100 transition" data-ratio="1">1:1</button>
            </div>
            <div class="flex items-center gap-2">
                <button id="btn-crop-cancel" class="px-4 py-2 text-sm font-semibold bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition">Batal</button>
                <button id="btn-crop-skip"   class="px-4 py-2 text-sm font-semibold bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">Guna Asal</button>
                <button id="btn-crop-done"   class="px-5 py-2 text-sm font-bold bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Potong & Selesai</button>
            </div>
        </div>
    </div>
</div>

{{-- ── PREVIEW MODAL ── --}}
<div id="preview-modal" class="fixed inset-0 z-[300] bg-black/75 backdrop-blur-sm items-start justify-center overflow-y-auto p-4 py-8">
    <div class="bg-white w-full max-w-6xl rounded-2xl shadow-2xl overflow-hidden">
        {{-- Top Bar --}}
        <div class="flex items-center justify-between px-5 py-3 bg-gray-900 text-white gap-4">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
            </div>
            {{-- Device Size Switcher --}}
            <div class="flex items-center gap-1 bg-gray-800 rounded-lg p-1">
                <button class="preview-device-btn active px-3 py-1 text-xs font-semibold rounded-md transition" data-width="375">
                    📱 Mobile
                </button>
                <button class="preview-device-btn px-3 py-1 text-xs font-semibold rounded-md text-gray-400 hover:text-white transition" data-width="768">
                    📟 Tablet
                </button>
                <button class="preview-device-btn px-3 py-1 text-xs font-semibold rounded-md text-gray-400 hover:text-white transition" data-width="full">
                    🖥️ Desktop
                </button>
            </div>
            <button id="btn-close-preview" class="text-gray-400 hover:text-white text-xl leading-none">✕</button>
        </div>
        {{-- Preview Frame --}}
        <div class="bg-gray-100 p-4" style="min-height:60vh">
            <div id="preview-frame" class="bg-white mx-auto transition-all duration-300 rounded-xl shadow-sm overflow-hidden" style="max-width:375px;width:100%">
                <div class="p-6 md:p-10">
                    <div id="prev-cat" class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-lg uppercase tracking-wider mb-4">Kategori</div>
                    <h1 id="prev-title" class="text-2xl font-extrabold text-gray-900 mb-4 leading-tight">Tajuk artikel</h1>
                    <div id="prev-thumbnail-wrap" class="hidden rounded-xl overflow-hidden aspect-video mb-6">
                        <img id="prev-thumbnail" src="" class="w-full h-full object-cover">
                    </div>
                    <div id="prev-content"
                         class="prose prose-sm max-w-none prose-p:text-gray-600 prose-headings:font-bold prose-blockquote:border-yellow-400 prose-img:rounded-xl">
                        <p class="text-gray-400 italic text-sm">Kandungan akan muncul di sini...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.30.6/dist/editorjs.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@2.8.7/dist/header.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@1.4.2/dist/nested-list.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@2.7.4/dist/quote.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.10.1/dist/image.umd.min.js"></script>
<script>
const UPLOAD_URL = '{{ route("admin.news.image.upload") }}';
const CSRF_TOKEN = '{{ csrf_token() }}';

// ══════════════════════════════════════════
//  CROP HELPERS
// ══════════════════════════════════════════
let _cropper = null, _cropResolve = null, _cropReject = null;

function openCropModal(file) {
    return new Promise((res, rej) => {
        _cropResolve = res; _cropReject = rej;
        const img = document.getElementById('crop-target');
        img.onload = () => {
            if (_cropper) { _cropper.destroy(); _cropper = null; }
            _cropper = new Cropper(img, { viewMode: 1, autoCropArea: 0.85 });
        };
        img.src = URL.createObjectURL(file);
        document.getElementById('crop-modal').classList.add('open');
    });
}

function _finishCrop(blob) {
    const file = new File([blob || new Blob()], 'image.jpg', { type: 'image/jpeg' });
    if (_cropper) { _cropper.destroy(); _cropper = null; }
    document.getElementById('crop-modal').classList.remove('open');
    const res = _cropResolve; _cropResolve = null; _cropReject = null;
    if (res) res(file);
}

document.getElementById('btn-crop-done').addEventListener('click', () => {
    if (!_cropper || !_cropResolve) return;
    const btn = document.getElementById('btn-crop-done');
    btn.textContent = 'Memproses…'; btn.disabled = true;
    _cropper.getCroppedCanvas({ maxWidth: 2048 }).toBlob(blob => {
        btn.textContent = 'Potong & Selesai'; btn.disabled = false;
        _finishCrop(blob);
    }, 'image/jpeg', 0.92);
});

document.getElementById('btn-crop-skip').addEventListener('click', () => {
    fetch(document.getElementById('crop-target').src).then(r => r.blob()).then(b => _finishCrop(b));
});

// ← Cancel: reject promise so gallery loop can catch it
document.getElementById('btn-crop-cancel').addEventListener('click', () => {
    if (_cropper) { _cropper.destroy(); _cropper = null; }
    document.getElementById('crop-modal').classList.remove('open');
    const rej = _cropReject; _cropResolve = null; _cropReject = null;
    if (rej) rej(new Error('cancelled'));
});

document.querySelectorAll('.crop-ar').forEach(btn => {
    btn.addEventListener('click', () => {
        if (!_cropper) return;
        const r = parseFloat(btn.dataset.ratio);
        _cropper.setAspectRatio(isNaN(r) ? NaN : r);
        document.querySelectorAll('.crop-ar').forEach(b => b.classList.remove('bg-blue-100','text-blue-700','border-blue-500'));
        btn.classList.add('bg-blue-100','text-blue-700','border-blue-500');
    });
});

// ══════════════════════════════════════════
//  UPLOAD HELPER
// ══════════════════════════════════════════
async function uploadFile(file) {
    const fd = new FormData(); fd.append('image', file);
    const r = await fetch(UPLOAD_URL, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN, 'Accept': 'application/json' },
        body: fd,
    });
    return (await r.json()).url;
}

// ══════════════════════════════════════════
//  IMAGE WIDTH TUNE
// ══════════════════════════════════════════
class WidthTune {
    static get isTune() { return true; }
    constructor({ data, block }) { this.data = data || { width: '100' }; this.block = block; }
    render() {
        const wrap = document.createElement('div');
        wrap.innerHTML = '<div style="font-size:10px;color:#9ca3af;padding:8px 8px 4px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;">Lebar Gambar</div>';
        const row = document.createElement('div'); row.style.cssText = 'display:flex;gap:4px;padding:4px 8px 8px;';
        [{l:'25%',v:'25'},{l:'50%',v:'50'},{l:'75%',v:'75'},{l:'100%',v:'100'}].forEach(o => {
            const b = document.createElement('button'); b.type='button'; b.textContent = o.l;
            b.className = 'width-tune-btn' + (this.data.width===o.v?' active':'');
            b.addEventListener('click', () => {
                this.data.width = o.v;
                row.querySelectorAll('.width-tune-btn').forEach(x => x.classList.remove('active'));
                b.classList.add('active');
                this._apply();
            });
            row.appendChild(b);
        });
        wrap.appendChild(row); return wrap;
    }
    _apply() {
        try {
            const imgWrap = this.block.holder?.querySelector('.image-tool__image');
            if (imgWrap) { imgWrap.style.maxWidth = this.data.width==='100'?'':this.data.width+'%'; imgWrap.style.margin='0 auto'; }
        } catch(e){}
    }
    save() { return this.data; }
}

// ══════════════════════════════════════════
//  TEXT ALIGN TUNE
// ══════════════════════════════════════════
class AlignTune {
    static get isTune() { return true; }
    constructor({ data }) { this.data = data || { align: 'left' }; this._root = null; }
    render() {
        const wrap = document.createElement('div');
        wrap.innerHTML = '<div style="font-size:10px;color:#9ca3af;padding:8px 8px 4px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;">Align Teks</div>';
        const row = document.createElement('div'); row.style.cssText = 'display:flex;gap:4px;padding:4px 8px 8px;';
        const aligns = [
            {v:'left',icon:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="15" y2="12"/><line x1="3" y1="18" x2="19" y2="18"/></svg>'},
            {v:'center',icon:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="7" y1="12" x2="17" y2="12"/><line x1="5" y1="18" x2="19" y2="18"/></svg>'},
            {v:'right',icon:'<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="9" y1="12" x2="21" y2="12"/><line x1="5" y1="18" x2="21" y2="18"/></svg>'},
        ];
        aligns.forEach(a => {
            const b = document.createElement('button'); b.type='button'; b.innerHTML = a.icon;
            b.className = 'align-tune-btn' + (this.data.align===a.v?' active':'');
            b.addEventListener('click', () => {
                this.data.align = a.v;
                row.querySelectorAll('.align-tune-btn').forEach(x=>x.classList.remove('active'));
                b.classList.add('active');
                if (this._root) this._root.style.textAlign = a.v;
            });
            row.appendChild(b);
        });
        wrap.appendChild(row); return wrap;
    }
    wrap(pluginsContent) {
        this._root = pluginsContent;
        pluginsContent.style.textAlign = this.data.align || 'left';
        return pluginsContent;
    }
    save() { return this.data; }
}

// ══════════════════════════════════════════
//  GALLERY TOOL
// ══════════════════════════════════════════
class ImageGalleryTool {
    static get toolbox() {
        return { title:'Galeri Gambar', icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>' };
    }
    constructor({ data }) {
        this.data = { images: data.images||[], columns: data.columns||2, imgHeight: data.imgHeight||'180' };
        this.wrapper = null;
    }
    render() { this.wrapper = document.createElement('div'); this.wrapper.className='gallery-block'; this._rebuild(); return this.wrapper; }

    _rebuild() {
        this.wrapper.innerHTML = '';

        // ── Header row ──
        const hdr = document.createElement('div');
        hdr.style.cssText = 'display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;flex-wrap:wrap;gap:6px;';
        hdr.innerHTML = '<span style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;">Galeri Gambar</span>';
        const controls = document.createElement('div'); controls.style.cssText='display:flex;align-items:center;gap:8px;flex-wrap:wrap;';

        // Column selector
        const colWrap = document.createElement('div'); colWrap.style.cssText='display:flex;align-items:center;gap:4px;';
        colWrap.innerHTML='<span style="font-size:11px;color:#9ca3af;">Kolum:</span>';
        [1,2,3].forEach(n => {
            const b=document.createElement('button'); b.type='button'; b.textContent=n;
            b.style.cssText=`min-width:26px;height:26px;border-radius:6px;border:1px solid ${this.data.columns===n?'#3b82f6':'#e5e7eb'};background:${this.data.columns===n?'#3b82f6':'white'};color:${this.data.columns===n?'white':'#374151'};font-size:11px;font-weight:700;cursor:pointer;`;
            b.addEventListener('click', ()=>{ this.data.columns=n; this._rebuild(); });
            colWrap.appendChild(b);
        });

        // Height selector
        const hWrap = document.createElement('div'); hWrap.style.cssText='display:flex;align-items:center;gap:4px;';
        hWrap.innerHTML='<span style="font-size:11px;color:#9ca3af;">Tinggi:</span>';
        [{l:'S',v:'130'},{l:'M',v:'180'},{l:'L',v:'260'},{l:'XL',v:'340'}].forEach(o => {
            const b=document.createElement('button'); b.type='button'; b.textContent=o.l;
            b.style.cssText=`min-width:26px;height:26px;border-radius:6px;border:1px solid ${this.data.imgHeight===o.v?'#3b82f6':'#e5e7eb'};background:${this.data.imgHeight===o.v?'#3b82f6':'white'};color:${this.data.imgHeight===o.v?'white':'#374151'};font-size:11px;font-weight:700;cursor:pointer;`;
            b.addEventListener('click', ()=>{ this.data.imgHeight=o.v; this._rebuild(); });
            hWrap.appendChild(b);
        });
        controls.appendChild(colWrap); controls.appendChild(hWrap); hdr.appendChild(controls);
        this.wrapper.appendChild(hdr);

        // ── Grid ──
        if (this.data.images.length) {
            const colCls={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[this.data.columns]||'grid-cols-2';
            const grid=document.createElement('div');
            grid.className = `grid ${colCls} gap-3 mb-3`;
            this.data.images.forEach((img, i) => {
                const cell = document.createElement('div'); cell.className='gallery-img-wrap';
                // image
                const im = document.createElement('img'); im.src=img.url; im.style.height=this.data.imgHeight+'px'; im.style.objectFit='cover'; im.style.width='100%';
                // delete button — rendered outside image so no overlap
                const del = document.createElement('button'); del.type='button'; del.className='gallery-del-btn'; del.textContent='✕';
                del.setAttribute('title','Padam gambar');
                del.addEventListener('click', e => { e.stopPropagation(); this.data.images.splice(i,1); this._rebuild(); });
                // caption
                const cap = document.createElement('input'); cap.type='text'; cap.placeholder='Kapsyen (opsional)'; cap.value=img.caption||''; cap.className='gallery-caption-inp';
                cap.addEventListener('input', e => { this.data.images[i].caption=e.target.value; });
                cell.appendChild(im); cell.appendChild(del); cell.appendChild(cap);
                grid.appendChild(cell);
            });
            this.wrapper.appendChild(grid);
        }

        // ── Add images button ──
        const id='gi-'+Date.now(); const lbl=document.createElement('label'); lbl.htmlFor=id;
        lbl.style.cssText='display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:10px;border:2px dashed #d1d5db;border-radius:10px;cursor:pointer;color:#9ca3af;font-size:13px;font-weight:600;transition:all .15s;';
        lbl.innerHTML=`<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg> Tambah Gambar
            <input id="${id}" type="file" multiple accept="image/*" style="display:none;">`;
        lbl.querySelector('input').addEventListener('change', async e => {
            const files = Array.from(e.target.files); if (!files.length) return;
            lbl.style.opacity='0.5'; lbl.style.pointerEvents='none';
            let cancelled = false;
            for (const f of files) {
                if (cancelled) break;
                try {
                    const cropped = await openCropModal(f);
                    const url = await uploadFile(cropped);
                    this.data.images.push({ url, caption:'' });
                } catch(err) {
                    if (err.message === 'cancelled') { cancelled = true; }
                }
            }
            lbl.style.opacity=''; lbl.style.pointerEvents='';
            this._rebuild();
        });
        this.wrapper.appendChild(lbl);
    }
    save() {
        // Save captions from current DOM
        this.wrapper.querySelectorAll('.gallery-caption-inp').forEach((inp, i) => {
            if (this.data.images[i]) this.data.images[i].caption = inp.value;
        });
        return this.data;
    }
}

// ══════════════════════════════════════════
//  EDITOR JS INIT
// ══════════════════════════════════════════
const editor = new EditorJS({
    holder: 'editorjs',
    placeholder: 'Mula tulis kandungan di sini...',
    inlineToolbar: ['bold','italic','link'],
    tools: {
        widthTune: WidthTune,
        alignTune: AlignTune,
        header: {
            class: Header,
            config: { levels:[2,3,4], defaultLevel:2 },
            tunes: ['alignTune'],
        },
        list: { class: NestedList, inlineToolbar: true },
        quote: { class: Quote, inlineToolbar: true, config: { quotePlaceholder:'Masukkan petikan…', captionPlaceholder:'Sumber' } },
        image: {
            class: ImageTool,
            tunes: ['widthTune'],
            config: {
                uploader: {
                    async uploadByFile(file) {
                        const cropped = await openCropModal(file);
                        const url = await uploadFile(cropped);
                        return { success:1, file:{ url } };
                    },
                    async uploadByUrl(url) { return { success:1, file:{ url } }; },
                },
            },
        },
        gallery: { class: ImageGalleryTool },
        paragraph: { tunes: ['alignTune'] },
    },
});

// ══════════════════════════════════════════
//  FORM SUBMIT
// ══════════════════════════════════════════
document.getElementById('btn-save').addEventListener('click', async () => {
    const btn = document.getElementById('btn-save');
    btn.textContent = 'Menyimpan…'; btn.disabled = true;
    try {
        const output = await editor.save();
        document.getElementById('content-input').value = JSON.stringify(output);
        document.getElementById('news-form').submit();
    } catch {
        btn.textContent = 'Simpan Artikel'; btn.disabled = false;
    }
});

// ══════════════════════════════════════════
//  THUMBNAIL
// ══════════════════════════════════════════
document.getElementById('thumbnail').addEventListener('change', function() {
    const f=this.files[0]; if (!f) return;
    const r=new FileReader(); r.onload=e=>{
        document.getElementById('thumb-preview').src=e.target.result;
        document.getElementById('thumb-wrap').classList.remove('hidden');
        document.getElementById('prev-thumbnail').src=e.target.result;
        document.getElementById('prev-thumbnail-wrap').classList.remove('hidden');
    }; r.readAsDataURL(f);
});
document.getElementById('btn-rm-thumb')?.addEventListener('click', ()=>{
    document.getElementById('thumbnail').value='';
    document.getElementById('thumb-wrap').classList.add('hidden');
    document.getElementById('prev-thumbnail-wrap').classList.add('hidden');
});

// ══════════════════════════════════════════
//  PREVIEW MODAL + RESPONSIVE TOGGLE
// ══════════════════════════════════════════
function buildPreviewHtml(blocks) {
    return (blocks||[]).map(b => {
        const d=b.data;
        const align = b.tunes?.alignTune?.align || 'left';
        const aStyle = align!=='left' ? ` style="text-align:${align}"` : '';
        if (b.type==='paragraph') return `<p${aStyle}>${d.text}</p>`;
        if (b.type==='header') return `<h${d.level}${aStyle}>${d.text}</h${d.level}>`;
        if (b.type==='quote') return `<blockquote>${d.text}${d.caption?`<cite>— ${d.caption}</cite>`:''}</blockquote>`;
        if (b.type==='image') {
            const w = b.tunes?.widthTune?.width||'100';
            const wStyle = w!=='100' ? `style="max-width:${w}%;margin:0 auto;"` : '';
            return `<figure ${wStyle}><img src="${d.file?.url||d.url||''}" style="width:100%;border-radius:10px;"><figcaption>${d.caption||''}</figcaption></figure>`;
        }
        if (b.type==='gallery') {
            const cols={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[d.columns]||'grid-cols-2';
            const h=d.imgHeight||'180';
            return `<div class="grid ${cols} gap-3 my-4">${(d.images||[]).map(i=>`<figure style="margin:0"><img src="${i.url}" style="width:100%;height:${h}px;object-fit:cover;border-radius:10px;"><figcaption style="font-size:11px;color:#6b7280;text-align:center;margin-top:4px;">${i.caption||''}</figcaption></figure>`).join('')}</div>`;
        }
        if (b.type==='list') {
            const tag = d.style==='ordered'?'ol':'ul';
            return `<${tag}>${(d.items||[]).map(i=>`<li>${typeof i==='object'?i.content:i}</li>`).join('')}</${tag}>`;
        }
        return '';
    }).join('\n');
}

async function openPreview() {
    const out = await editor.save();
    document.getElementById('prev-title').textContent = document.getElementById('title').value || 'Tajuk artikel';
    document.getElementById('prev-content').innerHTML = buildPreviewHtml(out.blocks) || '<p style="color:#9ca3af;">Tiada kandungan.</p>';
    const cat=document.getElementById('category_id');
    document.getElementById('prev-cat').textContent = cat.selectedIndex>0 ? cat.options[cat.selectedIndex].text : 'Umum';
    document.getElementById('preview-modal').classList.add('open');
}

document.getElementById('btn-preview').addEventListener('click', openPreview);
document.getElementById('btn-close-preview').addEventListener('click', ()=>document.getElementById('preview-modal').classList.remove('open'));

// Device size switcher
document.querySelectorAll('.preview-device-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.preview-device-btn').forEach(b=>{ b.classList.remove('active'); b.classList.add('text-gray-400'); });
        btn.classList.add('active'); btn.classList.remove('text-gray-400');
        const frame = document.getElementById('preview-frame');
        const w = btn.dataset.width;
        if (w === 'full') { frame.style.maxWidth='100%'; }
        else { frame.style.maxWidth = w+'px'; }
    });
});
</script>
@endpush
