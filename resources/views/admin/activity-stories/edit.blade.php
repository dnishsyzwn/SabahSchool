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
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="font-bold text-gray-800">Galeri Gambar <span class="text-red-500">*</span></h3>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Had:</span>
                            <span class="text-xs font-black text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-full px-3 py-0.5">Maks 3</span>
                        </div>
                    </div>
                </div>
                <div class="p-6" x-data="imageUpload({{ json_encode(array_map(fn($p) => Storage::url($p), $story->images ?? ($story->image_path ? [$story->image_path] : []))) }})">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        <template x-for="(url, index) in imageUrls" :key="index">
                            <div class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100 shadow-sm animate-in fade-in zoom-in duration-300">
                                <img :src="url" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                <input type="hidden" name="image_urls[]" :value="url">
                                <button type="button" @click="removeImage(index)" 
                                        class="absolute top-3 right-3 bg-red-500/90 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-red-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent py-3 px-4">
                                    <span class="text-white text-[9px] font-black uppercase tracking-[0.2em]" x-text="index === 0 ? '📌 Muka Depan' : 'GAMBAR ' + (index+1)"></span>
                                </div>
                            </div>
                        </template>

                        <template x-if="imageUrls.length < 3">
                            <div @click="$refs.fileInput.click()"
                                 class="cursor-pointer group hover:border-blue-400 border-2 border-dashed border-gray-100 rounded-2xl text-center transition aspect-square flex flex-col items-center justify-center bg-gray-50/30 relative overflow-hidden">
                                <div x-show="!uploading" class="text-gray-300 group-hover:text-blue-500 transition-colors duration-300 flex flex-col items-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-sm mb-3 border border-gray-100 group-hover:scale-110 transition duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-blue-600">Tambah Gambar</p>
                                    <p class="text-[9px] text-gray-300 mt-1 font-bold" x-text="imageUrls.length + ' / 3'"></p>
                                </div>
                                <div x-show="uploading" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-8 h-8 border-3 border-blue-600/20 border-t-blue-600 rounded-full animate-spin"></div>
                                        <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Memuatkan...</span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <input type="file" x-ref="fileInput" class="hidden" accept="image/*" @change="handleUpload">
                    <p class="text-[10px] text-gray-400 italic font-medium flex items-center gap-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Maksimum 3 gambar. Gambar pertama akan menjadi thumbnail di halaman utama.
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
            async handleUpload(e) {
                const initialFile = e.target.files[0];
                if (!initialFile) return;

                if (this.imageUrls.length >= 3) {
                    Swal.fire({ icon: 'warning', title: 'Had Maksimum', text: 'Maksimum 3 gambar sahaja dibenarkan.' });
                    e.target.value = '';
                    return;
                }

                try {
                    const croppedFile = await openCropModal(initialFile, NaN);
                    this.uploading = true;
                    const formData = new FormData();
                    formData.append('image', croppedFile);

                    const response = await fetch('{{ route("admin.activity-stories.media.upload") }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: formData
                    });

                    if (!response.ok) throw new Error('Upload failed');
                    const data = await response.json();
                    this.imageUrls.push(data.url);
                    this.uploading = false;
                    e.target.value = '';
                } catch (err) {
                    if (err.message !== 'cancelled') {
                        console.error(err);
                        Swal.fire({ icon: 'error', title: 'Ralat', text: 'Gagal memuat naik gambar.' });
                    }
                    this.uploading = false;
                    e.target.value = '';
                }
            },
            removeImage(index) { this.imageUrls.splice(index, 1); }
        }
    }
</script>
@endpush
