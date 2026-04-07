@extends('admin.layouts.app')

@section('title', 'Pengurusan Kerjaya')
@section('header', 'Pengurusan Kerjaya')

@section('actions')
    <a href="{{ route('admin.kerjaya.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Jawatan
    </a>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-xl shadow-gray-100/50 border border-gray-100 overflow-hidden transition-all duration-500">
    
    {{-- Filter Bar --}}
    <div class="p-6 border-b border-gray-50 bg-gray-50/30 flex flex-col lg:flex-row items-center gap-6">
        <div class="flex-1 w-full">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest mb-1">Cari & Tapis</h2>
            <p class="text-[10px] text-gray-400 font-medium">Urus senarai kekosongan jawatan STU</p>
        </div>

        <div class="flex flex-col sm:flex-row flex-[2] gap-3 w-full">
            <div class="relative flex-1 group">
                <input type="text" id="search-input" placeholder="Cari tajuk jawatan atau lokasi..."
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
                    <th class="px-6 py-4">Jawatan / Lokasi</th>
                    <th class="px-6 py-4">Jenis</th>
                    <th class="px-6 py-4">Tarikh Tutup</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($jobs as $job)
                <tr class="hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500 job-row" data-title="{{ strtolower($job->title) }} {{ strtolower($job->location) }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 shadow-sm border border-blue-100 transition group-hover/row:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 group-hover/row:text-blue-600 transition">{{ $job->title }}</p>
                                <p class="text-[10px] text-gray-400 font-medium tracking-wide uppercase">{{ $job->location }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $typeLabel = match($job->type) {
                                'full_time' => 'Sepenuh Masa',
                                'part_time' => 'Sambilan',
                                'contract' => 'Kontrak',
                                'internship' => 'Latihan Amali',
                                default => $job->type
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black rounded-lg border border-gray-100 bg-gray-50 text-gray-500 uppercase tracking-tighter">
                            {{ $typeLabel }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-bold text-gray-700">{{ $job->deadline->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $badge = match($job->status) {
                                'active' => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                'closed' => 'text-red-600 bg-red-50 border-red-100',
                                'draft'  => 'text-amber-600 bg-amber-50 border-amber-100',
                                default  => 'text-slate-400 bg-slate-50 border-slate-100',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black rounded-lg border {{ $badge }} uppercase tracking-tighter">
                            {{ $job->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2 px-2">
                            <a href="{{ route('admin.kerjaya.edit', $job) }}" 
                               class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-lg transition shadow-sm group/btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" onclick="confirmDelete({{ $job->id }}, '{{ addslashes($job->title) }}')" 
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
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <p class="font-bold text-gray-800">Tiada jawatan dijumpai</p>
                            <p class="text-xs text-gray-400 mt-1">Mula dengan menambah satu jawatan baru.</p>
                            <a href="{{ route('admin.kerjaya.create') }}" class="text-xs font-black text-blue-600 uppercase tracking-widest mt-4 hover:underline">+ Tambah Jawatan</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($jobs->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30">
            {{ $jobs->links() }}
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Standardized Delete Confirmation
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Padam Jawatan?',
            html: `Adakah anda pasti ingin memadam jawatan <strong>"${title}"</strong>? Tindakan ini tidak boleh dibatalkan.`,
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
                form.action = `/admin/kerjaya/${id}`;
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
        const rows = document.querySelectorAll('.job-row');
        rows.forEach(row => {
            const title = row.getAttribute('data-title');
            row.style.display = title.includes(term) ? '' : 'none';
        });
    });
</script>
@endsection
