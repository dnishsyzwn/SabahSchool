@extends('admin.layouts.app')

@section('title', 'Edit Bukti Tuntutan')
@section('header', 'Kemaskini Bukti Tuntutan')

@push('styles')
<style>
    input[type="radio"]:checked + .status-card { border-color: #3b82f6; background: #eff6ff; }
    input[type="radio"]:checked + .status-card .status-icon { background: #3b82f6; color: white; transform: scale(1.1); }
    input[type="radio"]:checked + .status-card .status-check { display: flex; }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto">
    <form action="{{ route('admin.claims.update', $claim) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Section 1: Maklumat Ahli --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Maklumat Ahli</h3>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Ahli <span class="text-red-500">*</span></label>
                        <input type="text" name="member_name" value="{{ old('member_name', $claim->member_name) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('member_name') border-red-500 @enderror">
                        @error('member_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="school" value="{{ old('school', $claim->school) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('school') border-red-500 @enderror">
                        @error('school') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Waris <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="heir_name" value="{{ old('heir_name', $claim->heir_name) }}" placeholder="Cth: CHE FARHANI BINTI CHE JAFFAR"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Hubungan Waris <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <select name="heir_relation" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            <option value="">— Pilih —</option>
                            @foreach(['ISTERI','SUAMI','ANAK','IBU/BAPA','LAIN-LAIN'] as $rel)
                                <option value="{{ $rel }}" {{ old('heir_relation', $claim->heir_relation) == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Maklumat Tuntutan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Maklumat Tuntutan</h3>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Tuntutan <span class="text-red-500">*</span></label>
                        <select name="claim_type" required class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('claim_type') border-red-500 @enderror">
                            <option value="">— Pilih —</option>
                            <option value="KEMATIAN" {{ old('claim_type', $claim->claim_type) == 'KEMATIAN' ? 'selected' : '' }}>Kematian</option>
                            <option value="PENYAKIT KRITIKAL" {{ old('claim_type', $claim->claim_type) == 'PENYAKIT KRITIKAL' ? 'selected' : '' }}>Penyakit Kritikal</option>
                        </select>
                        @error('claim_type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Penyakit / Sebab <span class="text-red-500">*</span></label>
                        <input type="text" name="disease_type" value="{{ old('disease_type', $claim->disease_type) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('disease_type') border-red-500 @enderror">
                        @error('disease_type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tarikh Sertai <span class="text-red-500">*</span></label>
                        <input type="text" name="date_joined" value="{{ old('date_joined', $claim->date_joined) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('date_joined') border-red-500 @enderror">
                        @error('date_joined') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tarikh Meninggal / Diagnosis <span class="text-red-500">*</span></label>
                        <input type="text" name="date_incident" value="{{ old('date_incident', $claim->date_incident) }}" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition @error('date_incident') border-red-500 @enderror">
                        @error('date_incident') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 3: Kewangan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Kewangan</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Caruman <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="contribution_amount" value="{{ old('contribution_amount', $claim->contribution_amount) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Pampasan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="compensation_amount" value="{{ old('compensation_amount', $claim->compensation_amount) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 4: Gambar & Media --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Gambar & Media</h3>
                    </div>
                    <div x-data="imageUpload({{ $claim->images->map(fn($img) => Storage::url($img->image_path)) }})" class="hidden" id="img-count-ref" :data-count="imageUrls.length"></div>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Had:</span>
                        <span class="text-xs font-black text-purple-700 bg-purple-50 border border-purple-100 rounded-full px-3 py-0.5">3 Gambar</span>
                    </div>
                </div>
            </div>
            <div class="p-6" x-data="imageUpload({{ $claim->images->map(fn($img) => Storage::url($img->image_path)) }})">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">
                    <template x-for="(url, index) in imageUrls" :key="index">
                        <div class="relative group aspect-[4/3] rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                            <img :src="url" class="w-full h-full object-cover">
                            <input type="hidden" name="image_urls[]" :value="url">
                            <button type="button" @click="removeImage(index)" 
                                    class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition shadow-lg hover:bg-red-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent py-2 px-3">
                                <span class="text-white text-[10px] font-bold uppercase tracking-wider" x-text="index === 0 ? '📌 UTAMA' : 'GAMBAR ' + (index+1)"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="imageUrls.length < 3">
                        <div @click="$refs.fileInput.click()"
                             class="cursor-pointer hover:border-blue-400 border-2 border-dashed border-gray-200 rounded-xl text-center transition aspect-[4/3] flex flex-col items-center justify-center bg-gray-50/50 relative overflow-hidden group">
                            <div x-show="!uploading" class="text-gray-400 group-hover:text-blue-500 transition-colors">
                                <svg class="w-8 h-8 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <p class="text-xs font-semibold">Tambah Gambar</p>
                                <p class="text-[10px] text-gray-300 mt-0.5" x-text="'(' + imageUrls.length + '/3)'"></p>
                            </div>
                            <div x-show="uploading" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                            </div>
                        </div>
                    </template>

                    <template x-if="imageUrls.length >= 3">
                        <div class="opacity-60 border-2 border-dashed border-gray-200 rounded-xl aspect-[4/3] flex flex-col items-center justify-center bg-gray-50">
                            <svg class="w-8 h-8 text-gray-300 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Had 3 Gambar</p>
                        </div>
                    </template>
                </div>
                <input type="file" x-ref="fileInput" class="hidden" accept="image/*" @change="handleUpload">
                <p class="text-[11px] text-gray-400 italic">Maksimum <strong>3 gambar</strong> dibenarkan. Gambar pertama ditetapkan sebagai gambar utama.</p>
            </div>
        </div>

        {{-- Section 5: Status & Catatan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-800">Status & Catatan</h3>
                </div>
            </div>
            <div class="p-6 space-y-5">
                {{-- Status Penerbitan --}}
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-3">Status Penerbitan</p>
                    @php
                        $availableStatuses = [
                            'published' => ['Terbit', 'emerald', 'M5 13l4 4L19 7'],
                            'archived'  => ['Arkib', 'slate', 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                        ];
                        if ($claim->status === 'draft') {
                            $availableStatuses = array_merge(
                                ['draft' => ['Draf', 'amber', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z']],
                                $availableStatuses
                            );
                        }
                    @endphp
                    <div class="grid {{ $claim->status === 'draft' ? 'grid-cols-3' : 'grid-cols-2' }} gap-2">
                        @foreach($availableStatuses as $val => [$lbl, $color, $iconPath])
                        <div class="relative">
                            <input type="radio" name="status" value="{{ $val }}" 
                                   {{ old('status', $claim->status) === $val ? 'checked' : '' }} 
                                   class="sr-only" id="st-{{ $val }}">
                            <label for="st-{{ $val }}" 
                                   class="status-card flex flex-col items-center gap-1.5 cursor-pointer p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/10 transition group relative text-center">
                                <div class="status-icon w-8 h-8 rounded-full bg-{{ $color }}-50 text-{{ $color }}-600 flex items-center justify-center transition duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path></svg>
                                </div>
                                <p class="text-[10px] font-bold text-{{ $color }}-600">{{ $lbl }}</p>
                                <div class="status-check hidden absolute top-1 right-1">
                                    <div class="w-3 h-3 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"></path></svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="h-px bg-gray-100"></div>

                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Catatan Tambahan <span class="text-gray-300 font-normal normal-case">(Opsional)</span></label>
                    <textarea name="description" rows="4"
                              placeholder="Masukkan catatan atau nota tambahan berkaitan tuntutan ini..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-700 leading-relaxed">{{ old('description', $claim->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.claims.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-600 font-semibold rounded-lg hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <button type="submit" class="px-10 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg shadow-blue-200 hover:shadow-blue-300">
                Kemaskini Bukti Tuntutan
            </button>
        </div>
    </form>

    {{-- Danger Zone --}}
    <div class="mt-12 bg-rose-50 border border-rose-100 rounded-2xl p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <div>
                <h4 class="text-sm font-black text-rose-900 uppercase tracking-widest">Zon Bahaya</h4>
                <p class="text-[10px] text-rose-600 font-medium italic">Tindakan ini tidak boleh diundur semula.</p>
            </div>
        </div>
        <button type="button" onclick="confirmDelete()" 
                class="w-full py-3 bg-white border border-rose-200 text-rose-600 text-xs font-black rounded-xl hover:bg-rose-600 hover:text-white hover:border-rose-600 transition uppercase tracking-widest shadow-sm">
            Padam Rekod Tuntutan Selamanya
        </button>
    </div>

    <form id="delete-claim-form" action="{{ route('admin.claims.destroy', $claim) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Hapus Rekod Tuntutan?',
            text: "Adakah anda pasti? Rekod ini akan dipadamkan selama-lamanya dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl px-6 py-2.5 font-bold',
                cancelButton: 'rounded-xl px-6 py-2.5 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-claim-form').submit();
            }
        });
    }

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
                fetch('{{ route("admin.claims.media.upload") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (this.imageUrls.length < 3) {
                        this.imageUrls.push(data.url);
                    } else {
                        alert('Maksimum 3 gambar sahaja dibenarkan.');
                    }
                    this.uploading = false;
                    e.target.value = '';
                })
                .catch(err => { console.error(err); this.uploading = false; alert('Gagal memuat naik gambar.'); });
            },
            removeImage(index) { this.imageUrls.splice(index, 1); }
        }
    }
</script>
@endpush
