@extends('admin.layouts.app')

@section('title', 'Kemaskini Jawatan Kerjaya')
@section('header', 'Kemaskini Jawatan')

@section('actions')
    <a href="{{ route('admin.kerjaya.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-600 text-sm font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.kerjaya.update', $job) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Title --}}
                <div class="col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tajuk Jawatan</label>
                    <input type="text" name="title" required value="{{ old('title', $job->title) }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lokasi</label>
                    <input type="text" name="location" required value="{{ old('location', $job->location) }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jenis Pekerjaan</label>
                    <select name="type" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold appearance-none cursor-pointer">
                        <option value="full_time" {{ old('type', $job->type) == 'full_time' ? 'selected' : '' }}>Sepenuh Masa</option>
                        <option value="part_time" {{ old('type', $job->type) == 'part_time' ? 'selected' : '' }}>Sambilan</option>
                        <option value="contract" {{ old('type', $job->type) == 'contract' ? 'selected' : '' }}>Kontrak</option>
                        <option value="internship" {{ old('type', $job->type) == 'internship' ? 'selected' : '' }}>Latihan Amali</option>
                    </select>
                </div>

                {{-- Salary --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Julat Gaji (Optional)</label>
                    <input type="text" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Deadline --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tarikh Tutup Permohonan</label>
                    <input type="date" name="deadline" required value="{{ old('deadline', optional($job->deadline)->format('Y-m-d')) }}"
                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Status</label>
                    <select name="status" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold appearance-none cursor-pointer">
                        <option value="active" {{ old('status', $job->status) == 'active' ? 'selected' : '' }}>Aktif (Dipaparkan)</option>
                        <option value="draft" {{ old('status', $job->status) == 'draft' ? 'selected' : '' }}>Draf (Disembunyi)</option>
                        <option value="closed" {{ old('status', $job->status) == 'closed' ? 'selected' : '' }}>Tutup</option>
                    </select>
                </div>
            </div>

            {{-- Description --}}
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Deskripsi Kerja</label>
                <textarea name="description" rows="10" required
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">{{ old('description', $job->description) }}</textarea>
            </div>

            {{-- Requirements --}}
            <div class="col-span-2">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Keperluan / Kriteria (Optional)</label>
                <textarea name="requirements" rows="5"
                          class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">{{ old('requirements', $job->requirements) }}</textarea>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                    class="px-8 py-4 bg-blue-600 text-white font-black text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                Kemaskini Jawatan
            </button>
        </div>
    </form>
</div>
@endsection
