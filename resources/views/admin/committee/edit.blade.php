@extends('admin.layouts.app')

@section('title', 'Kemaskini Pemimpin')
@section('header', 'Kemaskini Pemimpin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden transition-all duration-500">
        <form action="{{ route('admin.committee.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row gap-12">
                {{-- Image Profile --}}
                <div class="flex-shrink-0 w-full md:w-1/3">
                    <label class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-4">Gambar Profil</label>
                    <div class="relative group">
                        <div class="w-full aspect-square rounded-[2rem] bg-gray-50 border-4 border-dashed border-gray-100 flex flex-col items-center justify-center overflow-hidden group-hover:border-blue-400 transition-colors">
                            <img id="image-preview" src="{{ $member->image_path ? Storage::url($member->image_path) : asset('images/lelaki-pending.png') }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-blue-600/60 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-all cursor-pointer">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                        </div>
                        <input type="file" name="image_path" id="image-input" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)">
                    </div>
                    @error('image_path')
                        <p class="mt-2 text-[10px] text-red-500 font-bold uppercase tracking-widest">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Basic Information --}}
                <div class="flex-grow space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-1.5 ml-1">Nama Penuh</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required
                               class="w-full px-4 py-3 text-sm bg-gray-50 border-0 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300">
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-1.5 ml-1">Jawatan</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $member->position) }}" required
                               placeholder="Cth: PRESIDEN"
                               class="w-full px-4 py-3 text-sm bg-gray-50 border-0 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="type" class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-1.5 ml-1">Kategori</label>
                            <select name="type" id="type" required
                                    class="w-full px-4 py-3 text-sm bg-gray-50 border-0 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300">
                                <option value="TOP" {{ old('type', $member->type) === 'TOP' ? 'selected' : '' }}>Ahli Tertinggi</option>
                                <option value="EXCO" {{ old('type', $member->type) === 'EXCO' ? 'selected' : '' }}>Exco Bahagian</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_order" class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-1.5 ml-1">Susunan (Prioriti)</label>
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $member->sort_order) }}"
                                   class="w-full px-4 py-3 text-sm bg-gray-50 border-0 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="division" class="block text-sm font-black text-gray-800 uppercase tracking-widest mb-1.5 ml-1">Bahagian (Pilihan)</label>
                        <input type="text" name="division" id="division" value="{{ old('division', $member->division) }}"
                               placeholder="Cth: Bahagian Pantai Barat"
                               class="w-full px-4 py-3 text-sm bg-gray-50 border-0 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 outline-none transition-all duration-300">
                    </div>

                    <div class="flex items-center gap-3 py-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $member->is_active ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Aktif / Tunjuk di Portal</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-8 border-t border-gray-100">
                <a href="{{ route('admin.committee.index') }}" class="px-6 py-3 text-xs font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">Batal</a>
                <button type="submit" class="px-10 py-3 bg-blue-600 text-white text-xs font-black rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-500/20 active:scale-95 uppercase tracking-widest">Kemaskini Pemimpin</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('image-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
