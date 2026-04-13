@extends('admin.layouts.app')

@section('title', 'Butiran Borang: ' . $formSubmission->subject)
@section('header', 'Butiran Borang')

@section('actions')
<a href="{{ route('admin.form-submissions.index') }}" 
   class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-600 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-gray-50 transition border border-gray-100 shadow-sm hover:shadow-md">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
    Kembali
</a>
@endsection

@section('content')
@php
    $statusOrderMap = [
        'pending' => 1,
        'reviewed' => 2,
        'approved' => 3,
        'rejected' => 3
    ];
    $currentOrder = $statusOrderMap[$formSubmission->status] ?? 0;
@endphp
<div class="grid lg:grid-cols-3 gap-8">
    
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight">Maklumat Penghantaran</h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Dihantar pada {{ $formSubmission->created_at->format('d M Y, H:i A') }}</p>
                </div>
                <div class="flex gap-2">
                    @if($formSubmission->file_path)
                    <a href="{{ asset('storage/' . $formSubmission->file_path) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-teal-50 text-teal-600 text-xs font-black uppercase tracking-widest rounded-xl hover:bg-teal-100 transition border border-teal-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        Lihat Borang
                    </a>
                    @endif
                </div>
            </div>

            <div class="p-8 grid sm:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Pengirim / ID</label>
                    <p class="text-sm font-bold text-gray-800">{{ $formSubmission->name }}</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jenis Borang</label>
                    <p class="text-sm font-bold text-gray-800">{{ $formSubmission->formType ? $formSubmission->formType->name : 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">E-mel</label>
                    <p class="text-sm font-bold text-gray-800">{{ $formSubmission->email }}</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">No. Telefon</label>
                    <p class="text-sm font-bold text-gray-800">{{ $formSubmission->phone ?: 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Subjek</label>
                    <p class="text-sm font-bold text-gray-800">{{ $formSubmission->subject }}</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Mesej / Nota Tambahan</label>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 text-sm text-gray-600 leading-relaxed font-medium">
                        {!! nl2br(e($formSubmission->message ?: 'Tiada mesej.')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar: Status Management --}}
    <div class="space-y-8">
        <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8">
            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Kemaskini Status</h3>
            
            @if($currentOrder < 3)
            <form action="{{ route('admin.form-submissions.update-status', $formSubmission->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Pilih Status</label>
                    <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all text-xs font-bold uppercase tracking-wider">
                        <option value="pending" {{ $formSubmission->status == 'pending' ? 'selected' : '' }} {{ $currentOrder > 1 ? 'disabled' : '' }}>Menunggu</option>
                        <option value="reviewed" {{ $formSubmission->status == 'reviewed' ? 'selected' : '' }} {{ $currentOrder > 2 ? 'disabled' : '' }}>Disemak</option>
                        <option value="approved" {{ $formSubmission->status == 'approved' ? 'selected' : '' }}>Selesai / Lulus</option>
                        <option value="rejected" {{ $formSubmission->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3">Nota Pentadbir</label>
                    <textarea name="admin_notes" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all text-sm font-medium" placeholder="Masukkan nota atau ulasan...">{{ $formSubmission->admin_notes }}</textarea>
                </div>

                <button type="submit" class="w-full py-4 bg-gray-900 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-lg hover:bg-gray-800 transition-all">
                    Sahkan Kemaskini
                </button>
            </form>
            @else
            <div class="flex flex-col items-center py-6 text-center">
                <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mb-4 border border-dashed border-gray-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <h4 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-1">Keputusan Muktamad</h4>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed px-4">Borang ini telah selesai diproses and statusnya adalah muktamad.</p>
                
                @if($formSubmission->admin_notes)
                <div class="mt-6 w-full text-left p-4 bg-gray-50 rounded-2xl border border-gray-100 italic text-xs text-gray-500">
                    <span class="block text-[8px] font-black text-gray-300 uppercase mb-1">Nota Terakhir:</span>
                    "{{ $formSubmission->admin_notes }}"
                </div>
                @endif
            </div>
            @endif
        </div>

        @if($formSubmission->status_changed_at)
        <div class="bg-blue-50 rounded-3xl p-6 border border-blue-100">
            <h4 class="text-[10px] font-black text-blue-900 uppercase tracking-[0.2em] mb-4">Sejarah Status</h4>
            <div class="space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-full bg-blue-200 rounded-full"></div>
                    <div>
                        <p class="text-[10px] font-bold text-blue-800">{{ $formSubmission->statusChangedBy ? $formSubmission->statusChangedBy->name : 'Sistem' }}</p>
                        <p class="text-[9px] text-blue-500 uppercase font-bold tracking-tighter">{{ $formSubmission->status_changed_at->format('d M Y, H:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
