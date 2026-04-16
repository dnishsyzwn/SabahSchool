<div class="overflow-x-auto relative min-h-[400px]">
    {{-- Loading Overlay --}}
    <div id="table-loader" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-blue-600/20 border-t-blue-600 rounded-full animate-spin"></div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Memuatkan...</span>
        </div>
    </div>

    <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-50/80 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black border-b border-gray-100">
            <tr>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('name')" class="flex items-center gap-2 hover:text-blue-600 transition group uppercase">
                        Pengirim
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ request('sort') == 'name' && request('direction') == 'asc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ request('sort') == 'name' && request('direction') == 'desc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('school')" class="flex items-center gap-2 hover:text-blue-600 transition group uppercase text-left">
                        Sekolah / Organisasi
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ request('sort') == 'school' && request('direction') == 'asc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ request('sort') == 'school' && request('direction') == 'desc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('is_read')" class="flex items-center gap-2 hover:text-blue-600 transition group uppercase text-left">
                        Status
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ request('sort') == 'is_read' && request('direction') == 'asc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ request('sort') == 'is_read' && request('direction') == 'desc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('created_at')" class="flex items-center gap-2 hover:text-blue-600 transition group uppercase">
                        Tarikh
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ (request('sort','created_at') == 'created_at' && request('direction') == 'asc') ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ (request('sort','created_at') == 'created_at' && request('direction') == 'desc') ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4 text-right">Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($messages as $message)
            <tr class="hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500 {{ !$message->is_read ? 'bg-blue-50/10' : '' }}">
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
                           class="w-11 h-11 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-xl transition shadow-sm group/btn">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                        <button type="button" onclick="confirmDelete({{ $message->id }}, '{{ addslashes($message->name) }}')" 
                                class="w-11 h-11 flex items-center justify-center bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-xl transition shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
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
                        <p class="text-xs text-gray-400 mt-1 text-center max-w-xs">Tiada sebarang mesej yang memenuhi kriteria carian anda buat masa ini.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($messages->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30 flex flex-col lg:flex-row items-center justify-between gap-4 table-pagination">
            <div class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
                {{ $messages->firstItem() }} - {{ $messages->lastItem() }} Dari {{ $messages->total() }} Mesej
            </div>
            <div class="paging-links">
                {{ $messages->links() }}
            </div>
        </div>
    @endif
</div>
