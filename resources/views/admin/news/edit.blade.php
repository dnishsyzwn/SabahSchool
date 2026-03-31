@extends('admin.layouts.app')
@section('title', 'Edit Artikel')
@section('header', Str::limit($news->title, 55))

@section('actions')
<div class="flex gap-2">
    <button type="button" id="btn-preview"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
        Preview
    </button>
    @if($news->status === 'published')
    <a href="{{ route('berita.show', $news->slug) }}" target="_blank"
       class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 text-sm font-semibold rounded-lg hover:bg-green-100 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        Laman Awam
    </a>
    @endif
    <a href="{{ route('admin.news.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
<style>
    #editorjs { min-height: 450px; }
    .codex-editor__redactor { padding-bottom: 100px !important; }
    .ce-block__content, .ce-toolbar__content { max-width: 100% !important; margin: 0 !important; }
    .ce-toolbar__actions { right: 0; }
    .ce-paragraph { line-height: 1.75; color: #374151; }
    .ce-header { font-weight: 800; color: #1e3a5f; }
    .image-tool__image-picture { border-radius: 12px; }
    .gallery-block { border: 2px dashed #e5e7eb; border-radius: 12px; padding: 16px; margin: 8px 0; }
    #crop-modal { display:none; } #crop-modal.open { display:flex; }
    #preview-modal { display:none; } #preview-modal.open { display:flex; }
</style>
@endpush

@section('content')
@php
    $contentJson = null;
    if ($news->content) {
        $trimmed = trim($news->content);
        if (str_starts_with($trimmed, '{')) {
            $decoded = json_decode($trimmed, true);
            if (json_last_error() === JSON_ERROR_NONE) $contentJson = $trimmed;
        }
    }
@endphp

<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" id="news-form">
    @csrf @method('PUT')
    <input type="hidden" id="content-input" name="content" value="{{ old('content', $news->content) }}">

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="xl:col-span-2 space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <label for="title" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Tajuk Artikel <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                       class="w-full px-0 py-1 text-2xl font-bold border-0 border-b-2 border-gray-200 focus:border-blue-500 outline-none text-gray-900 bg-transparent transition">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-3 border-b border-gray-100 bg-gray-50/60">
                    <p class="text-sm font-semibold text-gray-700">Kandungan Artikel <span class="text-red-500">*</span></p>
                    <p class="text-xs text-gray-400 mt-0.5">Tekan <kbd class="px-1 bg-gray-100 rounded border text-xs">/</kbd> untuk blok baharu • Klik <span class="font-mono">+</span> untuk gambar, galeri, petikan</p>
                </div>
                <div id="editorjs" class="px-6 py-4"></div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <label for="excerpt" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Ringkasan <span class="text-gray-400 font-normal normal-case">(opsional)</span></label>
                <textarea id="excerpt" name="excerpt" rows="3"
                          class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-gray-700 resize-y">{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Status</p>
                @foreach(['draft'=>['Draft','Tidak ditayangkan','text-yellow-600'],'published'=>['Published','Tayangkan sekarang','text-green-600'],'archived'=>['Archived','Sembunyikan','text-gray-500']] as $val=>[$lbl,$desc,$cls])
                <label class="flex items-start gap-3 cursor-pointer p-2.5 rounded-lg hover:bg-gray-50 transition">
                    <input type="radio" name="status" value="{{ $val }}" {{ old('status',$news->status)===$val?'checked':'' }} class="mt-0.5">
                    <div><p class="text-sm font-semibold {{ $cls }}">{{ $lbl }}</p><p class="text-xs text-gray-400">{{ $desc }}</p></div>
                </label>
                @endforeach
                @if($news->published_at)
                    <p class="text-xs text-gray-400 mt-2 pt-2 border-t border-gray-100">Diterbit: {{ $news->published_at->format('d M Y, H:i') }}</p>
                @endif
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <label for="category_id" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">— Pilih —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id',$news->category_id)==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Gambar Utama</p>
                <div id="thumb-wrap" class="{{ $news->thumbnail ? '' : 'hidden' }} mb-3 relative group rounded-lg overflow-hidden">
                    <img id="thumb-preview" src="{{ $news->thumbnail ? Storage::url($news->thumbnail) : '' }}" class="w-full h-36 object-cover">
                    <button type="button" id="btn-rm-thumb"
                            class="absolute top-1.5 right-1.5 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition">✕</button>
                </div>
                <label for="thumbnail" class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg py-5 cursor-pointer text-gray-400 hover:border-blue-400 hover:text-blue-500 transition text-sm">
                    <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $news->thumbnail ? 'Tukar gambar' : 'Muat naik gambar' }}
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                </label>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <p class="text-xs font-bold text-red-700 mb-2 uppercase tracking-wider">Zon Bahaya</p>
                <form method="POST" action="{{ route('admin.news.destroy', $news) }}"
                      onsubmit="return confirm('Artikel ini akan dipadam secara kekal. Teruskan?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">Padam Artikel</button>
                </form>
            </div>

            <button type="button" id="btn-save"
                    class="w-full py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 active:scale-95 transition shadow-md">
                Kemaskini Artikel
            </button>
        </div>
    </div>
</form>

{{-- CROP MODAL --}}
<div id="crop-modal" class="fixed inset-0 z-[400] bg-black/80 backdrop-blur-sm items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b">
            <h3 class="font-bold text-gray-800">Potong Gambar</h3>
            <span id="crop-queue-label" class="text-xs text-gray-500"></span>
        </div>
        <div class="bg-gray-900 flex items-center justify-center" style="height:350px">
            <img id="crop-target" src="" alt="" style="max-height:340px;max-width:100%;display:block;">
        </div>
        <div class="px-5 py-3 border-t border-gray-100 flex flex-wrap items-center justify-between gap-3">
            <div class="flex gap-2">
                <span class="text-xs text-gray-500 font-medium self-center">Nisbah:</span>
                <button class="crop-ar px-2 py-0.5 text-xs font-semibold border rounded-lg hover:bg-gray-50" data-ratio="NaN">Bebas</button>
                <button class="crop-ar px-2 py-0.5 text-xs font-semibold border rounded-lg hover:bg-gray-50" data-ratio="1.777">16:9</button>
                <button class="crop-ar px-2 py-0.5 text-xs font-semibold border rounded-lg hover:bg-gray-50" data-ratio="1.333">4:3</button>
                <button class="crop-ar px-2 py-0.5 text-xs font-semibold border rounded-lg hover:bg-gray-50" data-ratio="1">1:1</button>
            </div>
            <div class="flex gap-2">
                <button id="btn-crop-skip" class="px-4 py-2 text-sm font-semibold bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Guna Asal</button>
                <button id="btn-crop-done" class="px-5 py-2 text-sm font-bold bg-blue-600 text-white rounded-lg hover:bg-blue-700">Potong & Selesai</button>
            </div>
        </div>
    </div>
</div>

{{-- PREVIEW MODAL --}}
<div id="preview-modal" class="fixed inset-0 z-[300] bg-black/70 backdrop-blur-sm items-start justify-center overflow-y-auto p-4 py-10">
    <div class="bg-white max-w-4xl w-full rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex items-center justify-between px-5 py-3 bg-gray-900 text-white">
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 bg-red-500 rounded-full"></span><span class="w-3 h-3 bg-yellow-400 rounded-full"></span><span class="w-3 h-3 bg-green-400 rounded-full"></span>
                <span class="ml-3 text-xs font-mono text-gray-400">Preview • stu.test/berita/{{ $news->slug }}</span>
            </div>
            <button id="btn-close-preview" class="text-gray-400 hover:text-white text-xl">✕</button>
        </div>
        <div class="overflow-y-auto max-h-[82vh] p-8 md:p-12">
            <div id="prev-cat" class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-lg uppercase tracking-wider mb-4">{{ $news->category?->name ?? 'Umum' }}</div>
            <h1 id="prev-title" class="text-3xl font-extrabold text-gray-900 mb-5">{{ $news->title }}</h1>
            <div id="prev-thumbnail-wrap" class="{{ $news->thumbnail ? '' : 'hidden' }} rounded-2xl overflow-hidden aspect-video mb-8">
                <img id="prev-thumbnail" src="{{ $news->thumbnail ? Storage::url($news->thumbnail) : '' }}" class="w-full h-full object-cover">
            </div>
            <div id="prev-content"
                 class="prose prose-lg max-w-none prose-p:text-gray-600 prose-headings:font-bold prose-blockquote:border-yellow-400 prose-img:rounded-2xl">
                {!! \App\Helpers\ContentRenderer::render($news->content) !!}
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

// ── Crop ──
let _cropper = null, _cropResolve = null, _cropReject = null;
function openCropModal(file) {
    return new Promise((res, rej) => {
        _cropResolve = res; _cropReject = rej;
        const img = document.getElementById('crop-target');
        img.onload = () => { if (_cropper) { _cropper.destroy(); _cropper = null; } _cropper = new Cropper(img, { viewMode: 1, autoCropArea: 0.85 }); };
        img.src = URL.createObjectURL(file);
        document.getElementById('crop-modal').classList.add('open');
    });
}
function resolveCrop(blob) {
    const f = new File([blob], 'image.jpg', { type: 'image/jpeg' });
    if (_cropper) { _cropper.destroy(); _cropper = null; }
    document.getElementById('crop-modal').classList.remove('open');
    const res = _cropResolve; _cropResolve = null; _cropReject = null; res(f);
}
document.getElementById('btn-crop-done').addEventListener('click', () => {
    if (!_cropper || !_cropResolve) return;
    const btn = document.getElementById('btn-crop-done');
    btn.textContent = 'Memproses…'; btn.disabled = true;
    _cropper.getCroppedCanvas({ maxWidth: 2048 }).toBlob(blob => {
        btn.textContent = 'Potong & Selesai'; btn.disabled = false; resolveCrop(blob);
    }, 'image/jpeg', 0.92);
});
document.getElementById('btn-crop-skip').addEventListener('click', () => {
    fetch(document.getElementById('crop-target').src).then(r => r.blob()).then(b => resolveCrop(b));
});
document.querySelectorAll('.crop-ar').forEach(btn => {
    btn.addEventListener('click', () => {
        if (!_cropper) return;
        _cropper.setAspectRatio(parseFloat(btn.dataset.ratio));
        document.querySelectorAll('.crop-ar').forEach(b => b.classList.remove('bg-blue-100','text-blue-700'));
        btn.classList.add('bg-blue-100','text-blue-700');
    });
});

// ── Upload ──
async function uploadFile(file) {
    const fd = new FormData(); fd.append('image', file);
    const r = await fetch(UPLOAD_URL, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF_TOKEN,'Accept':'application/json'}, body:fd });
    return (await r.json()).url;
}

// ── Gallery Tool ──
class ImageGalleryTool {
    static get toolbox() { return { title:'Galeri Gambar', icon:'<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>' }; }
    constructor({ data }) { this.data = { images: data.images||[], columns: data.columns||2 }; this.wrapper = null; }
    render() { this.wrapper = document.createElement('div'); this.wrapper.className='gallery-block'; this._build(); return this.wrapper; }
    _build() {
        this.wrapper.innerHTML = '';
        const hdr = document.createElement('div'); hdr.className='flex items-center justify-between mb-3';
        hdr.innerHTML='<span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Galeri Gambar</span>';
        const cols = document.createElement('div'); cols.className='flex items-center gap-1.5';
        cols.innerHTML='<span class="text-xs text-gray-400">Susun:</span>';
        [1,2,3].forEach(n => {
            const b = document.createElement('button'); b.type='button'; b.textContent=n+' kolum';
            b.className='px-2 py-0.5 text-xs rounded border transition '+(this.data.columns===n?'bg-blue-600 text-white border-blue-600':'bg-white text-gray-500 border-gray-300 hover:bg-gray-50');
            b.addEventListener('click', () => { this.data.columns=n; this._build(); });
            cols.appendChild(b);
        });
        hdr.appendChild(cols); this.wrapper.appendChild(hdr);
        if (this.data.images.length) {
            const colCls={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[this.data.columns]||'grid-cols-2';
            const grid=document.createElement('div'); grid.className=`grid ${colCls} gap-3 mb-3`;
            this.data.images.forEach((img,i) => {
                const fig=document.createElement('div'); fig.className='relative group rounded-xl overflow-hidden border border-gray-200 bg-gray-50';
                fig.innerHTML=`<img src="${img.url}" class="w-full h-36 object-cover">
                    <button type="button" data-idx="${i}" class="btn-del-img absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition">✕</button>
                    <input type="text" data-idx="${i}" value="${img.caption||''}" placeholder="Kapsyen" class="w-full px-2 py-1 text-xs border-t border-gray-200 bg-white outline-none focus:bg-blue-50 caption-inp">`;
                fig.querySelector('.btn-del-img').addEventListener('click', e => { this.data.images.splice(+e.currentTarget.dataset.idx,1); this._build(); });
                fig.querySelector('.caption-inp').addEventListener('input', e => { this.data.images[+e.target.dataset.idx].caption=e.target.value; });
                grid.appendChild(fig);
            });
            this.wrapper.appendChild(grid);
        }
        const id='gfi-'+Date.now(), lbl=document.createElement('label');
        lbl.htmlFor=id; lbl.className='flex items-center justify-center gap-2 w-full py-3 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer text-gray-400 hover:text-blue-500 hover:border-blue-400 transition text-sm font-medium';
        lbl.innerHTML=`<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Tambah Gambar<input type="file" id="${id}" multiple accept="image/*" class="hidden">`;
        lbl.querySelector('input').addEventListener('change', async e => {
            const files=Array.from(e.target.files); if (!files.length) return;
            lbl.classList.add('opacity-50','pointer-events-none');
            for (const f of files) { try { const cropped=await openCropModal(f); const url=await uploadFile(cropped); this.data.images.push({url,caption:''}); } catch {} }
            lbl.classList.remove('opacity-50','pointer-events-none'); this._build();
        });
        this.wrapper.appendChild(lbl);
    }
    save() { return this.data; }
}

// ── Editor Init ──
const INITIAL_DATA = {!! $contentJson ? $contentJson : 'null' !!};
const editor = new EditorJS({
    holder: 'editorjs',
    placeholder: 'Mula tulis kandungan di sini…',
    inlineToolbar: ['bold','italic','link'],
    data: INITIAL_DATA || undefined,
    tools: {
        header:  { class: Header, config: { levels:[2,3,4], defaultLevel:2 } },
        list:    { class: NestedList, inlineToolbar:true },
        quote:   { class: Quote, inlineToolbar:true, config:{ quotePlaceholder:'Masukkan petikan…', captionPlaceholder:'Sumber' } },
        image:   { class: ImageTool, config: { uploader: { async uploadByFile(file) { const c=await openCropModal(file); const url=await uploadFile(c); return {success:1,file:{url}}; }, async uploadByUrl(url) { return {success:1,file:{url}}; } } } },
        gallery: { class: ImageGalleryTool },
    },
});

// ── Submit ──
document.getElementById('btn-save').addEventListener('click', async () => {
    const btn=document.getElementById('btn-save'); btn.textContent='Menyimpan…'; btn.disabled=true;
    try { const out=await editor.save(); document.getElementById('content-input').value=JSON.stringify(out); document.getElementById('news-form').submit(); }
    catch { btn.textContent='Kemaskini Artikel'; btn.disabled=false; }
});

// ── Thumbnail ──
document.getElementById('thumbnail').addEventListener('change', function() {
    const f=this.files[0]; if (!f) return;
    const r=new FileReader(); r.onload=e=>{
        document.getElementById('thumb-preview').src=e.target.result;
        document.getElementById('thumb-wrap').classList.remove('hidden');
        document.getElementById('prev-thumbnail').src=e.target.result;
        document.getElementById('prev-thumbnail-wrap').classList.remove('hidden');
    }; r.readAsDataURL(f);
});
document.getElementById('btn-rm-thumb')?.addEventListener('click', () => {
    document.getElementById('thumbnail').value='';
    document.getElementById('thumb-wrap').classList.add('hidden');
    document.getElementById('prev-thumbnail-wrap').classList.add('hidden');
});

// ── Preview ──
async function openPreview() {
    const out=await editor.save(); let html='';
    (out.blocks||[]).forEach(b => {
        const d=b.data;
        if (b.type==='paragraph') html+=`<p>${d.text}</p>`;
        else if (b.type==='header') html+=`<h${d.level}>${d.text}</h${d.level}>`;
        else if (b.type==='quote') html+=`<blockquote>${d.text}${d.caption?`<footer>— ${d.caption}</footer>`:''}</blockquote>`;
        else if (b.type==='image') html+=`<figure><img src="${d.file?.url||d.url||''}" alt="${d.caption||''}"><figcaption>${d.caption||''}</figcaption></figure>`;
        else if (b.type==='gallery') {
            const cc={1:'grid-cols-1',2:'grid-cols-2',3:'grid-cols-3'}[d.columns]||'grid-cols-2';
            html+=`<div class="grid ${cc} gap-4 my-6">${(d.images||[]).map(i=>`<img src="${i.url}" class="w-full h-40 object-cover rounded-xl">`).join('')}</div>`;
        }
    });
    document.getElementById('prev-title').textContent=document.getElementById('title').value;
    document.getElementById('prev-content').innerHTML=html||'<p class="text-gray-400 italic">Tiada kandungan.</p>';
    document.getElementById('preview-modal').classList.add('open');
}
document.getElementById('btn-preview').addEventListener('click', openPreview);
document.getElementById('btn-close-preview').addEventListener('click', () => document.getElementById('preview-modal').classList.remove('open'));
</script>
@endpush
