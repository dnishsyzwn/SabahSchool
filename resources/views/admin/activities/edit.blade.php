@extends('admin.layouts.app')

@section('title', 'Edit Aktiviti')
@section('header', 'Edit Aktiviti')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.activities.update', $activity) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Left Side: Details --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tajuk Aktiviti</label>
                        <input type="text" name="title" value="{{ old('title', $activity->title) }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-red-500 @enderror">
                        @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                            <input type="text" name="category" value="{{ old('category', $activity->category) }}" placeholder="Contoh: KEBAJIKAN" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tarikh</label>
                            <input type="date" name="event_date" value="{{ old('event_date', $activity->event_date?->format('Y-m-d')) }}" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $activity->location) }}" placeholder="Contoh: SK Karamunting, Sandakan"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah / Pampasan (Opsional)</label>
                        <input type="text" name="amount" value="{{ old('amount', $activity->amount) }}" placeholder="Contoh: RM 10,000.00"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                {{-- Right Side: Image & Meta --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Utama</label>
                        <div x-data="imageUpload({{ $activity->images->map(fn($img) => Storage::url($img->image_path)) }})" class="space-y-3">
                            <div class="grid grid-cols-2 gap-3" id="image-preview-grid">
                                <template x-for="(url, index) in imageUrls" :key="index">
                                    <div class="relative group aspect-video rounded-xl overflow-hidden border border-gray-200">
                                        <img :src="url" class="w-full h-full object-cover">
                                        <input type="hidden" name="image_urls[]" :value="url">
                                        <button type="button" @click="removeImage(index)" 
                                                class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-[10px] py-1 text-center font-mono" x-text="index === 0 ? 'UTAMA' : 'TAMBAHAN'"></div>
                                    </div>
                                </template>

                                {{-- Upload Button --}}
                                <div @click="$refs.fileInput.click()" 
                                     class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-blue-400 transition cursor-pointer aspect-video flex flex-col items-center justify-center bg-gray-50 relative overflow-hidden">
                                    
                                    <div x-show="!uploading" class="text-gray-400">
                                        <svg class="w-8 h-8 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        <p class="text-xs">Tambah Gambar</p>
                                    </div>

                                    <div x-show="uploading" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" x-ref="fileInput" class="hidden" accept="image/*" @change="handleUpload">
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Gambar pertama akan digunakan sebagai gambar utama.</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="draft" {{ old('status', $activity->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $activity->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $activity->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <input type="checkbox" name="is_featured" value="1" id="is_featured" {{ old('is_featured', $activity->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
                        <label for="is_featured" class="text-sm font-semibold text-blue-800">Set sebagai Aktiviti Utama (Featured)</label>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan / Deskripsi</label>
                <textarea name="description" rows="5" required
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('description') border-red-500 @enderror">{{ old('description', $activity->description) }}</textarea>
                @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.activities.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-8 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-md shadow-blue-200">Kemaskini Aktiviti</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function imageUpload(initialUrls) {
        return {
            imageUrls: initialUrls || [],
            uploading: false,
            handleUpload(e) {
                const file = e.target.files[0];
                if (!file) return;

                this.uploading = true;
                const formData = new FormData();
                formData.append('image', file);

                fetch('{{ route("admin.activities.image.upload") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.imageUrls.push(data.url);
                    this.uploading = false;
                    e.target.value = ''; // Reset input
                })
                .catch(err => {
                    console.error(err);
                    this.uploading = false;
                    alert('Gagal memuat naik gambar.');
                });
            },
            removeImage(index) {
                this.imageUrls.splice(index, 1);
            }
        }
    }
</script>
@endpush
