@extends('admin.layouts.app')

@section('title', 'Borang Pintar')
@section('header', 'Borang Pintar')

@section('actions')
    <button onclick="toggleModal('uploadModal')" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Muat Naik Borang
    </button>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden transition-all duration-500">
    
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex-1 w-full">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-1">Pengurusan Dokumen</h2>
            <p class="text-[10px] text-gray-400 font-medium">Urus dan muat naik borang digital untuk ahli STU</p>
        </div>

        <div class="flex flex-col sm:flex-row flex-[2] gap-3 w-full">
            <div class="relative flex-1 group">
                <input type="text" id="search-input" placeholder="Cari tajuk borang..."
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
                    <th class="px-6 py-4">Borang</th>
                    <th class="px-6 py-4">Saiz Fail</th>
                    <th class="px-6 py-4">Tarikh Muat Naik</th>
                    <th class="px-6 py-4 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($borangs as $borang)
                <tr class="hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500 borang-row" data-title="{{ strtolower($borang->title) }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-red-500 shadow-sm border border-red-100 transition group-hover/row:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 group-hover/row:text-blue-600 transition">{{ $borang->title }}</p>
                                <p class="text-[10px] text-gray-400 font-medium line-clamp-1 max-w-xs">{{ $borang->description ?: 'Tiada deskripsi' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black rounded-lg border border-slate-100 bg-slate-50 text-slate-500 uppercase tracking-tighter">
                            {{ $borang->file_size }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-700">{{ $borang->created_at->format('d M Y') }}</span>
                            <span class="text-[10px] text-gray-400 font-medium">{{ $borang->created_at->format('H:i A') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 px-2">
                            <a href="{{ asset('storage/' . $borang->file_path) }}" target="_blank" 
                               class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-lg transition shadow-sm group/btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            <button type="button" onclick="confirmDelete({{ $borang->id }}, '{{ addslashes($borang->title) }}')" 
                                    class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-lg transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-24 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 mb-4 border border-dashed border-gray-200">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <p class="font-bold text-gray-800">Tiada borang dijumpai</p>
                            <p class="text-xs text-gray-400 mt-1 max-w-[200px]">Mula dengan memuat naik borang pertama anda.</p>
                            <button onclick="toggleModal('uploadModal')" class="text-xs font-black text-blue-600 uppercase tracking-widest mt-4 hover:underline">+ Muat Naik Borang</button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($borangs->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
            {{ $borangs->links() }}
        </div>
    @endif
</div>

{{-- Upload Modal (Redesigned for consistency) --}}
<div id="uploadModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="toggleModal('uploadModal')"></div>
        
        <div class="relative bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl animate-in zoom-in duration-300">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-xl font-black text-gray-900 uppercase tracking-tight">Muat Naik Borang</h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Sertakan dokumen PDF, DOC, atau XLS</p>
                </div>
                <button onclick="toggleModal('uploadModal')" class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-400 hover:text-gray-600 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form action="{{ route('admin.borang-pintar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tajuk Borang</label>
                        <input type="text" name="title" required placeholder="Contoh: Borang Keahlian STU"
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Deskripsi Ringkas</label>
                        <textarea name="description" rows="3" placeholder="Terangkan sedikit tentang kegunaan borang ini..."
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 outline-none transition-all duration-300 text-sm font-semibold"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Pilih Fail</label>
                        <div class="relative group">
                            <input type="file" name="file" required 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                   onchange="updateFileName(this)">
                            <div class="w-full px-4 py-10 bg-gray-50 border-2 border-dashed border-gray-100 rounded-2xl flex flex-col items-center justify-center group-hover:border-blue-500 group-hover:bg-blue-50/30 transition-all duration-300">
                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-gray-400 group-hover:text-blue-500 mb-3 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <span id="file-name-display" class="text-xs font-bold text-gray-400 group-hover:text-blue-600 transition-colors uppercase tracking-widest">Klik atau seret fail</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button type="submit" class="w-full py-4 bg-blue-600 text-white font-black text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                        Sahkan & Muat Naik
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    function updateFileName(input) {
        const display = document.getElementById('file-name-display');
        if (input.files && input.files[0]) {
            display.textContent = input.files[0].name;
            display.classList.remove('text-gray-400');
            display.classList.add('text-blue-600');
        }
    }

    // Standardized Delete Confirmation
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Padam Borang?',
            html: `Adakah anda pasti ingin memadam borang <strong>"${title}"</strong>? Tindakan ini tidak boleh dibatalkan.`,
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
                form.action = `/admin/borang-pintar/${id}`;
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
        const rows = document.querySelectorAll('.borang-row');
        rows.forEach(row => {
            const title = row.getAttribute('data-title');
            row.style.display = title.includes(term) ? '' : 'none';
        });
    });
</script>
@endsection
