@extends('admin.layouts.app')

@section('title', 'Profil Saya')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column: Avatar --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8 text-center animate-in fade-in slide-in-from-left duration-700">
                    <div class="relative group mx-auto w-40 h-40 mb-6">
                        <div id="avatar-preview" class="w-full h-full rounded-2xl overflow-hidden border-4 border-gray-50 shadow-inner bg-gray-50 flex items-center justify-center text-gray-300">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            @endif
                        </div>
                        <label class="absolute inset-0 flex items-center justify-center bg-black/40 text-white opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer rounded-2xl backdrop-blur-sm">
                            <input type="file" name="avatar" class="hidden" onchange="previewImage(this)">
                            <div class="flex flex-col items-center">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest">Tukar Gambar</span>
                            </div>
                        </label>
                    </div>
                    
                    <h3 class="text-lg font-black text-gray-900 leading-tight uppercase tracking-tight">{{ $user->name }}</h3>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">{{ $user->role }}</p>
                    
                    <div class="mt-6 pt-6 border-t border-gray-50">
                        <div class="flex items-center justify-center gap-2 text-xs text-gray-400 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Log Masuk Terakhir: {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Tiada data' }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Form Fields --}}
            <div class="lg:col-span-2 space-y-8 animate-in fade-in slide-in-from-right duration-700">
                {{-- Maklumat Asas --}}
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                        <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest">Maklumat Peribadi</h2>
                        <p class="text-[10px] text-gray-400 font-medium">Kemas kini maklumat akaun anda di sini.</p>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Penuh</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold @error('name') border-red-500 @enderror">
                                @error('name') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Alamat Emel</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold @error('email') border-red-500 @enderror">
                                <p class="text-[10px] text-gray-400 mt-1 font-medium">Memerlukan kata laluan semasa untuk ditukar.</p>
                                @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keselamatan --}}
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/30">
                        <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest">Keselamatan</h2>
                        <p class="text-[10px] text-gray-400 font-medium">Ubah kata laluan untuk meningkatkan keselamatan akaun.</p>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kata Laluan Semasa</label>
                            <input type="password" name="current_password"
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold @error('current_password') border-red-500 @enderror">
                            @error('current_password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Kata Laluan Baru</label>
                                <input type="password" name="new_password"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold @error('new_password') border-red-500 @enderror">
                                @error('new_password') <p class="text-red-500 text-[10px] mt-1 font-bold">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Sahkan Kata Laluan Baru</label>
                                <input type="password" name="new_password_confirmation"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-3 px-8 py-4 bg-blue-600 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 hover:-translate-y-1 active:translate-y-0 transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
