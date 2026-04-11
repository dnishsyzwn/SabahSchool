@extends('admin.layouts.app')

@section('title', 'Edit Cerita')
@section('header', 'Kemaskini Cerita Aktiviti Kami')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.activity-stories.update', $story) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Left Side: Details --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tajuk Cerita</label>
                        <input type="text" name="title" value="{{ old('title', $story->title) }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('title') border-red-500 @enderror">
                        @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tag (Kategori Kecil)</label>
                            <input type="text" name="tag" value="{{ old('tag', $story->tag) }}" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Tarikh (Teks)</label>
                            <input type="text" name="event_date" value="{{ old('event_date', $story->event_date) }}" 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Susunan (Nombor)</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $story->sort_order) }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                {{-- Right Side: Image --}}
                <div class="space-y-4">
                    <div x-data="imageUpload('{{ $story->image_path ? Storage::url($story->image_path) : '' }}')" class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Cerita</label>
                        
                        <div @click="$refs.fileInput.click()" 
                             class="group relative aspect-video rounded-xl overflow-hidden border-2 border-dashed border-gray-200 bg-gray-50 flex items-center justify-center cursor-pointer hover:border-blue-400 transition-all duration-300">
                            
                            <template x-if="imageUrl">
                                <img :src="imageUrl" class="w-full h-full object-cover">
                            </template>

                            <div x-show="!imageUrl && !uploading" class="text-center">
                                <svg class="w-10 h-10 mx-auto text-gray-300 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-xs text-gray-400 uppercase tracking-widest">Pilih Gambar</p>
                            </div>

                            <div x-show="uploading" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                            </div>
                            
                            <div x-show="imageUrl" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xs font-bold uppercase border border-white/30 backdrop-blur-sm px-4 py-2 rounded-lg">
                                Tukar Gambar
                            </div>
                        </div>

                        <input type="file" x-ref="fileInput" class="hidden" accept="image/*" @change="handleUpload">
                        <input type="hidden" name="image_path" :value="imageUrl">
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <input type="checkbox" name="is_active" value="1" id="is_active" {{ $story->is_active ? 'checked' : '' }} class="w-4 h-4 text-blue-600 rounded">
                        <label for="is_active" class="text-sm font-semibold text-blue-800">Paparkan di laman web</label>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Penerangan Ringkas</label>
                <textarea name="description" rows="4" required
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('description') border-red-500 @enderror">{{ old('description', $story->description) }}</textarea>
                @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.activity-stories.index') }}" class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">Batal</a>
            <button type="submit" class="px-8 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-md shadow-blue-200">Kemaskini Cerita</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function imageUpload(initialUrl) {
        return {
            imageUrl: initialUrl || '',
            uploading: false,
            handleUpload(e) {
                const file = e.target.files[0];
                if (!file) return;

                this.uploading = true;
                const formData = new FormData();
                formData.append('image', file);

                fetch('{{ route("admin.claims.media.upload") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    this.imageUrl = data.url;
                    this.uploading = false;
                })
                .catch(err => {
                    console.error(err);
                    this.uploading = false;
                    alert('Gagal memuat naik gambar.');
                });
            }
        }
    }
</script>
@endpush
