@extends('admin.layouts.app')

@section('title', 'Butiran Mesej')
@section('header', 'Butiran Mesej')

@section('actions')
    <a href="{{ route('admin.contact-messages.index') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali
    </a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- Main Message Content --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-black text-gray-800 uppercase tracking-tight">Kandungan Mesej</h2>
                    <span class="text-xs font-bold text-gray-400">{{ $contactMessage->created_at->format('d M Y, H:i A') }}</span>
                </div>

                <div class="prose max-w-none">
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 text-gray-700 leading-relaxed whitespace-pre-wrap">
                        {{ $contactMessage->message }}
                    </div>
                </div>

                <div class="mt-10 pt-8 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 border border-blue-100">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1 text-[10px]">Alamat Emel</p>
                            <a href="mailto:{{ $contactMessage->email }}" class="font-bold text-blue-600 hover:text-blue-700 transition">{{ $contactMessage->email }}</a>
                        </div>
                    </div>
                    
                    <button type="button" onclick="confirmDelete()" 
                            class="flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 rounded-xl transition text-xs font-black uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"></path></svg>
                        Padam Mesej
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Sender Info Sidebar --}}
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8">
            <h3 class="text-xs font-black text-gray-800 uppercase tracking-widest mb-6 border-b border-gray-50 pb-4">Maklumat Pengirim</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Nama Penuh</label>
                    <p class="font-bold text-gray-800">{{ $contactMessage->name }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">No. Kad Pengenalan</label>
                    <p class="font-bold text-gray-800">{{ $contactMessage->ic ?: 'Tiada' }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">No. Telefon</label>
                    <p class="font-bold text-gray-800">{{ $contactMessage->phone ?: 'Tiada' }}</p>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">Sekolah / Organisasi</label>
                    <p class="font-bold text-gray-800">{{ $contactMessage->school ?: 'Tiada' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-900 rounded-2xl shadow-xl shadow-gray-900/10 p-8 text-white">
            <h3 class="text-xs font-black uppercase tracking-widest mb-6 border-b border-gray-800 pb-4">Status Mesej</h3>
            
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Status Bacaan</span>
                    @if($contactMessage->is_read)
                        <span class="bg-blue-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg shadow-blue-500/30">Dibaca</span>
                    @else
                        <span class="bg-orange-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg shadow-orange-500/30">Belum Dibaca</span>
                    @endif
                </div>

                @if($contactMessage->readBy)
                <div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-1">Dibaca Oleh</label>
                    <p class="text-sm font-bold">{{ $contactMessage->readBy->name }}</p>
                    <p class="text-[10px] text-gray-500 mt-0.5">{{ $contactMessage->read_at->format('d M Y, H:i A') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<form id="delete-form" action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Padam Mesej?',
            text: 'Adakah anda pasti ingin memadam mesej ini? Tindakan ini tidak boleh dibatalkan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl shadow-2xl',
                confirmButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest',
                cancelButton: 'rounded-lg px-6 py-2.5 text-xs uppercase font-black tracking-widest'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endpush
@endsection
