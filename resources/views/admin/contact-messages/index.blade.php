@extends('admin.layouts.app')

@section('title', 'Mesej Hubungi Kami')
@section('header', 'Mesej Hubungi Kami')

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden transition-all duration-500">
    
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex-1 w-full">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-1">Pengurusan Mesej</h2>
            <p class="text-[10px] text-gray-400 font-medium">Lihat dan urus pertanyaan daripada pelawat laman web</p>
        </div>

        <div class="flex flex-col sm:flex-row flex-[2] gap-3 w-full">
            <div class="relative flex-1 group">
                <input type="text" id="search-input" placeholder="Cari nama atau email..."
                       class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-100 bg-white rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300">
                <svg class="absolute left-3.5 top-3 w-4 h-4 text-gray-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="overflow-x-auto relative">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50/80 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Pengirim</th>
                    <th class="px-6 py-4">Sekolah / Organisasi</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tarikh</th>
                    <th class="px-6 py-4 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($messages as $message)
                <tr class="hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500 message-row {{ !$message->is_read ? 'bg-blue-50/10' : '' }}" 
                    data-search="{{ strtolower($message->name . ' ' . $message->email) }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 {{ !$message->is_read ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-400' }} rounded-xl flex items-center justify-center shadow-sm border border-gray-100 transition group-hover/row:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 {{ !$message->is_read ? 'text-blue-700' : '' }} group-hover/row:text-blue-600 transition">{{ $message->name }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $message->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs font-semibold text-gray-700">{{ $message->school ?: '-' }}</p>
                        <p class="text-[10px] text-gray-400">{{ $message->phone ?: '-' }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if(!$message->is_read)
                            <span class="inline-flex items-center px-2 py-0.5 text-[8px] font-black rounded-full bg-blue-100 text-blue-600 uppercase tracking-widest border border-blue-200">
                                Baru
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 text-[8px] font-black rounded-full bg-gray-100 text-gray-400 uppercase tracking-widest border border-gray-200">
                                Dibaca
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-700">{{ $message->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] text-gray-400 font-medium">{{ $message->created_at->format('H:i A') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 px-2">
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" 
                               class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-lg transition shadow-sm group/btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            <button type="button" onclick="confirmDelete({{ $message->id }}, '{{ addslashes($message->name) }}')" 
                                    class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 mb-4 border border-dashed border-gray-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <p class="font-bold text-gray-800">Tiada mesej dijumpai</p>
                            <p class="text-xs text-gray-400 mt-1">Belum ada sebarang mesej yang diterima daripada borang Hubungi Kami.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
            {{ $messages->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Standardized Delete Confirmation
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Padam Mesej?',
            html: `Adakah anda pasti ingin memadam mesej daripada <strong>"${name}"</strong>? Tindakan ini tidak boleh dibatalkan.`,
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
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/contact-messages/${id}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Simple Client-side Search
    document.getElementById('search-input').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.message-row');
        rows.forEach(row => {
            const searchText = row.getAttribute('data-search');
            row.style.display = searchText.includes(term) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection
