@extends('admin.layouts.app')

@section('title', 'Edit Cerita')
@section('header', 'Kemaskini Cerita Aktiviti Kami')

@push('styles')
{{-- Flatpickr & Cropper Styles --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css">
<style>
    input[type="radio"]:checked + .status-card { border-color: #3b82f6; background: #eff6ff; }
    input[type="radio"]:checked + .status-card .status-icon { background: #3b82f6; color: white; transform: scale(1.1); }
    input[type="radio"]:checked + .status-card .status-check { display: flex; }
    
    .flatpickr-calendar {
        border-radius: 1rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        border: 1px solid #f3f4f6;
    }
</style>
@endpush

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.activity-stories.update', $story) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf
        @method('PUT')

        {{-- Left Column: Main Content (8 Columns) --}}
        <div class="lg:col-span-8 space-y-6">
            
            {{-- Section 1: Content Details --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Butiran Aktiviti</h3>
                    </div>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tajuk Cerita <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $story->title) }}" required placeholder="Masukkan tajuk aktiviti..."
                               class="w-full px-4 py-3 border border-gray-100 bg-gray-50/30 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-bold text-gray-800 @error('title') border-red-500 @enderror">
                        @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tag / Kategori <span class="text-red-500">*</span></label>
                            <input type="text" name="tag" value="{{ old('tag', $story->tag) }}" required placeholder="Cth: Kebajikan, Bantuan"
                                   class="w-full px-4 py-3 border border-gray-100 bg-gray-50/30 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-semibold text-gray-700">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tarikh Aktiviti <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="event_date" id="event_date" value="{{ old('event_date', $story->event_date?->format('Y-m-d')) }}" required placeholder="Pilih Tarikh..."
                                       class="w-full px-4 py-3 border border-gray-100 bg-gray-50/30 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition font-semibold text-gray-700 bg-white cursor-pointer">
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Penerangan <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="6" required placeholder="Ceritakan sedikit tentang aktiviti yang telah dijalankan..."
                                  class="w-full px-4 py-3 border border-gray-100 bg-gray-50/30 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm text-gray-700 leading-relaxed">{{ old('description', $story->description) }}</textarea>
                        @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Image Gallery --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Galeri Gambar <span class="text-red-500">*</span></h3>
                    </div>
                </div>
                <div class="p-6" x-data="imageUpload({{ json_encode(array_map(fn($p) => Storage::url($p), $story->images ?? ($story->image_path ? [$story->image_path] : []))) }})" x-init="initSortable()">
                    <div id="image-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-4">
                        <template x-for="(url, index) in imageUrls" :key="url">
                            <div class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-in fade-in zoom-in duration-300 cursor-move">
                                <img :src="url" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <input type="hidden" name="image_urls[]" :value="url">
                                
                                {{-- Drag Handle Indicator --}}
                                <div class="absolute top-2 left-2 bg-white/80 backdrop-blur-sm text-gray-600 p-1 rounded-md opacity-100 shadow-sm z-10 pointer-events-none">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                                </div>

                                {{-- Action Overlay --}}
                                <div class="absolute inset-0 bg-black/30 lg:bg-black/40 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity flex flex-wrap items-center justify-center gap-2 p-2">
                                    {{-- Arrange Buttons (Mobile focused) --}}
                                    <div class="flex w-full justify-center gap-1.5 mb-1">
                                        <button type="button" @click="moveImage(index, -1)" x-show="index > 0"
                                                class="bg-white/90 text-gray-700 p-2 rounded-lg hover:bg-white transition shadow-lg active:scale-90" title="Alih ke Depan">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button type="button" @click="moveImage(index, 1)" x-show="index < imageUrls.length - 1"
                                                class="bg-white/90 text-gray-700 p-2 rounded-lg hover:bg-white transition shadow-lg active:scale-90" title="Alih ke Belakang">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>
                                    </div>

                                    <div class="flex gap-2">
                                        <button type="button" @click="manualCrop(index)" 
                                                class="bg-blue-600 text-white p-2.5 rounded-lg hover:bg-blue-700 transition shadow-lg active:scale-95" title="Potong Gambar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7 7m-7-14l-4 4m0 0l-4 4m4-4l4 4m4-4l4 4"></path></svg>
                                        </button>
                                        <button type="button" @click="removeImage(index)" 
                                                class="bg-red-500 text-white p-2.5 rounded-lg hover:bg-red-600 transition shadow-lg active:scale-95" title="Padam">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent py-2 px-3 pointer-events-none">
                                    <span class="text-white text-[8px] font-black uppercase tracking-[0.2em]" x-text="index === 0 ? '📌 Thumbnail' : 'Gambar ' + (index+1)"></span>
                                </div>
                            </div>
                        </template>

                        <div @click="$refs.fileInput.click()"
                             @dragover.prevent="dragOver = true"
                             @dragleave.prevent="dragOver = false"
                             @drop.prevent="handleDrop"
                             :class="dragOver ? 'border-blue-500 bg-blue-50/50 scale-[0.98]' : 'border-gray-100 bg-gray-50/30'"
                             class="cursor-pointer group hover:border-blue-400 border-2 border-dashed rounded-2xl text-center transition aspect-square flex flex-col items-center justify-center relative overflow-hidden min-h-[150px]">
                            
                            <div x-show="!uploading" class="text-gray-300 group-hover:text-blue-500 transition-colors duration-300 flex flex-col items-center p-4">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm mb-2 border border-gray-100 group-hover:scale-110 transition duration-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 group-hover:text-blue-600">Tambah Gambar</p>
                                <p class="text-[8px] text-gray-300 mt-1 font-bold">Klik atau Drag & Drop</p>
                                <p class="text-[8px] text-blue-500 mt-2 font-black" x-text="imageUrls.length + ' Imej'"></p>
                            </div>

                            <div x-show="uploading" class="absolute inset-0 bg-white/80 flex items-center justify-center z-20">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-8 h-8 border-3 border-blue-600/20 border-t-blue-600 rounded-full animate-spin"></div>
                                    <span class="text-[8px] font-black text-blue-600 uppercase tracking-widest" x-text="uploadProgress"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" x-ref="fileInput" class="hidden" accept="image/*" multiple @change="handleUpload">
                    <p class="text-[10px] text-gray-400 italic font-medium flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Susunan gambar boleh diubah dengan mengheret (drag). Gambar pertama akan menjadi thumbnail.
                    </p>
                </div>
            </div>
        </div>

        {{-- Right Column: Settings & Sidebar (4 Columns) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Section 3: Status & Visibility --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Status & Privasi</h3>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Status & Visibiliti</p>
                        @php
                            $availableStatuses = [
                                'draft'     => ['Draf', 'amber', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                                'published' => ['Penerbitan', 'emerald', 'M5 13l4 4L19 7'],
                                'archived'  => ['Simpanan', 'slate', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                            ];
                        @endphp
                        <div class="space-y-3">
                            @foreach($availableStatuses as $val => [$lbl, $color, $iconPath])
                                @php
                                    $shouldHide = false;
                                    if ($story->status === 'archived' && $val === 'draft') $shouldHide = true;
                                    if ($story->status === 'draft' && $val === 'archived') $shouldHide = true;
                                    if ($story->status === 'published' && $val === 'draft') $shouldHide = true;
                                @endphp
                                @if($shouldHide) @continue @endif
                                <div class="relative">
                                    <input type="radio" name="status" value="{{ $val }}" 
                                           {{ old('status', $story->status ?? 'draft') === $val ? 'checked' : '' }} 
                                           class="sr-only" id="st-{{ $val }}">
                                    <label for="st-{{ $val }}" 
                                           class="status-card flex items-center justify-between cursor-pointer p-4 rounded-xl border border-gray-100 hover:border-blue-200 transition group relative">
                                        <div class="flex items-center gap-3">
                                            <div class="status-icon w-10 h-10 rounded-xl bg-{{ $color }}-50 text-{{ $color }}-600 flex items-center justify-center transition duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-black uppercase tracking-tight text-gray-800">{{ $lbl }}</p>
                                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $val }}</p>
                                            </div>
                                        </div>
                                        <div class="status-check hidden">
                                            <div class="w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center shadow-lg animate-in zoom-in duration-300">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="h-px bg-gray-50"></div>

                    <div class="pt-4 border-t border-gray-50 space-y-3">
                        <button type="submit" class="w-full py-4 bg-blue-600 text-white font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-blue-700 transition shadow-xl shadow-blue-100 hover:shadow-blue-200 hover:-translate-y-0.5 transition-all duration-300 font-bold">
                            Kemaskini Cerita Aktiviti
                        </button>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" @click="confirmDelete('{{ $story->id }}', '{{ addslashes($story->title) }}')" 
                                    class="flex items-center justify-center py-4 bg-red-50 text-red-600 font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-red-100 transition border border-red-100">
                                Padam
                            </button>
                            <a href="{{ route('admin.activity-stories.index') }}" class="flex items-center justify-center py-4 bg-gray-50 text-gray-400 font-black text-[11px] uppercase tracking-[0.2em] rounded-xl hover:bg-gray-100 transition border border-gray-100">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<form id="delete-form" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@include('admin.partials.crop-modal')
@endsection

@push('scripts')
<script>
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Padam Cerita Aktiviti?',
            html: `Adakah anda pasti ingin memadam cerita <strong>"${title}"</strong>? Semua gambar berkaitan juga akan dipadamkan daripada pelayan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl',
                confirmButton: 'rounded-lg px-6 py-2.5 text-xs font-black uppercase tracking-widest',
                cancelButton: 'rounded-lg px-6 py-2.5 text-xs font-black uppercase tracking-widest'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form');
                form.action = `/admin/activity-stories/${id}`;
                form.submit();
            }
        });
    }
</script>
{{-- Flatpickr Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- Cropping & HEIC Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/heic2any@0.0.4/dist/heic2any.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#event_date", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d F Y",
            allowInput: true,
        });
    });

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

    function imageUpload(existingUrls = []) {
        return {
            imageUrls: existingUrls,
            uploading: false,
            dragOver: false,
            uploadProgress: 'Memuatkan...',
            
            initSortable() {
                this.$nextTick(() => {
                    const el = document.getElementById('image-grid');
                    Sortable.create(el, {
                        animation: 150,
                        delay: 150, // Added delay for mobile to allow scrolling
                        delayOnTouchOnly: true,
                        ghostClass: 'opacity-50',
                        draggable: '.cursor-move',
                        onEnd: (evt) => {
                            const newOrder = Array.from(el.querySelectorAll('input[name="image_urls[]"]')).map(input => input.value);
                            this.imageUrls = newOrder;
                        }
                    });
                });
            },

            async handleDrop(e) {
                this.dragOver = false;
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    await this.processFiles(files);
                }
            },

            async handleUpload(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    await this.processFiles(files);
                    e.target.value = '';
                }
            },

            async processFiles(files) {
                this.uploading = true;
                const total = files.length;
                
                for (let i = 0; i < total; i++) {
                    const file = files[i];
                    this.uploadProgress = `Memproses ${i + 1}/${total}...`;
                    
                    try {
                        let uploadFile = file;
                        if (file.name.toLowerCase().endsWith('.heic') || file.type.includes('heic')) {
                            const blob = await heic2any({ blob: file, toType: 'image/jpeg', quality: 0.8 });
                            uploadFile = Array.isArray(blob) ? blob[0] : blob;
                        }

                        const formData = new FormData();
                        formData.append('image', uploadFile);

                        const response = await fetch('{{ route("admin.activity-stories.media.upload") }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: formData
                        });

                        if (!response.ok) throw new Error('Upload failed');
                        const data = await response.json();
                        this.imageUrls.push(data.url);
                    } catch (err) {
                        console.error(err);
                        Swal.fire({ icon: 'error', title: 'Ralat', text: `Gagal memuat naik imej: ${file.name}` });
                    }
                }
                
                this.uploading = false;
                this.initSortable();
            },

            async manualCrop(index) {
                const url = this.imageUrls[index];
                try {
                    const response = await fetch(url);
                    const blob = await response.blob();
                    const file = new File([blob], 'image.jpg', { type: 'image/jpeg' });

                    const croppedFile = await openCropModal(file, NaN);
                    
                    this.uploading = true;
                    this.uploadProgress = 'Mengemaskini...';
                    const formData = new FormData();
                    formData.append('image', croppedFile);

                    const uploadRes = await fetch('{{ route("admin.activity-stories.media.upload") }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: formData
                    });

                    if (!uploadRes.ok) throw new Error('Update failed');
                    const data = await uploadRes.json();
                    
                    this.imageUrls[index] = data.url;
                    this.uploading = false;
                } catch (err) {
                    if (err.message !== 'cancelled') {
                        console.error(err);
                        Swal.fire({ icon: 'error', title: 'Ralat', text: 'Gagal memotong imej.' });
                    }
                    this.uploading = false;
                }
            },

            moveImage(index, direction) {
                const newIndex = index + direction;
                if (newIndex < 0 || newIndex >= this.imageUrls.length) return;
                
                const current = this.imageUrls[index];
                this.imageUrls.splice(index, 1);
                this.imageUrls.splice(newIndex, 0, current);
                this.initSortable();
            },

            removeImage(index) {
                this.imageUrls.splice(index, 1);
                this.initSortable();
            }
        }
    }
</script>
@endpush
