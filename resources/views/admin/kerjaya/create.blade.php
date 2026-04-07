@extends('admin.layouts.app')

@section('title', 'Tambah Jawatan Kerjaya')
@section('header', 'Tambah Jawatan Baru')

@section('actions')
    <a href="{{ route('admin.kerjaya.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-600 text-sm font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.kerjaya.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Title --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tajuk Jawatan</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lokasi</label>
                    <input type="text" name="location" required value="{{ old('location') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold"
                           placeholder="Contoh: Kota Kinabalu">
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jenis Pekerjaan</label>
                    <select name="type" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold appearance-none cursor-pointer">
                        <option value="full_time">Sepenuh Masa</option>
                        <option value="part_time">Sambilan</option>
                        <option value="contract">Kontrak</option>
                        <option value="internship">Latihan Amali</option>
                    </select>
                </div>

                {{-- Salary --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Julat Gaji (Optional)</label>
                    <input type="text" name="salary_range" value="{{ old('salary_range') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold"
                           placeholder="Contoh: RM 2,500 - RM 3,500">
                </div>

                {{-- Deadline --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tarikh Tutup Permohonan</label>
                    <input type="date" name="deadline" required value="{{ old('deadline') }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Status</label>
                    <select name="status" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold appearance-none cursor-pointer">
                        <option value="active">Aktif (Dipaparkan)</option>
                        <option value="draft">Draf (Disembunyi)</option>
                        <option value="closed">Tutup</option>
                    </select>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Deskripsi Kerja</label>
                <textarea name="description" rows="5" required
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">{{ old('description') }}</textarea>
            </div>

            {{-- Requirements --}}
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Keperluan / Kriteria (Optional)</label>
                <textarea name="requirements" rows="5"
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">{{ old('requirements') }}</textarea>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                    class="px-8 py-4 bg-blue-600 text-white font-black text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                Simpan Jawatan
            </button>
        </div>
    </form>
</div>
@endsection
