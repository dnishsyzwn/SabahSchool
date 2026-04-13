<div class="overflow-x-auto relative min-h-[400px]">
    {{-- Skeleton/Loading Overlay --}}
    <div id="table-loader" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-blue-600/20 border-t-blue-600 rounded-full animate-spin"></div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Memuatkan...</span>
        </div>
    </div>

    <table class="min-w-full block md:table text-left text-sm">
        <thead class="hidden md:table-header-group bg-gray-50/80 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black border-b border-gray-100">
            <tr class="md:table-row">
                <th class="px-6 py-4 w-10 text-center text-gray-300">#</th>
                <th class="px-6 py-4 w-16 text-center">Susun</th>
                <th class="px-6 py-4 w-20">Gambar</th>
                <th class="px-6 py-4">Tajuk / Tag</th>
                <th class="px-6 py-4 w-32">Tarikh</th>
                <th class="px-6 py-4 w-32 text-center">Status</th>
                <th class="px-6 py-4 text-right">Tindakan</th>
            </tr>
        </thead>
        <tbody class="block md:table-row-group divide-y divide-gray-50">
            @forelse($stories as $story)
            <tr class="block md:table-row bg-white hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500 mb-4 md:mb-0 border border-gray-100 md:border-none rounded-2xl md:rounded-none overflow-hidden">
                {{-- Mobile Number Indicator --}}
                <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-center align-start">
                    <span class="text-[10px] font-black text-gray-300">{{ $stories->firstItem() + $loop->index }}</span>
                </td>

                {{-- Sort Order --}}
                <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-center font-mono text-gray-400">
                    {{ $story->sort_order }}
                </td>

                {{-- Header / Thumb + Title --}}
                <td class="block md:table-cell px-6 pt-6 pb-2 md:py-4">
                    <div class="flex items-center gap-4">
                        <div class="md:hidden flex flex-col gap-1 items-center">
                             <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-md">#{{ $stories->firstItem() + $loop->index }}</span>
                             <span class="text-[10px] font-mono text-gray-400">S:{{ $story->sort_order }}</span>
                        </div>
                        @if($story->image_path)
                            <div class="relative w-16 h-16 md:w-14 md:h-14 rounded-xl overflow-hidden shadow-sm border border-gray-100 group-hover/row:scale-105 transition duration-300">
                                <img src="{{ Storage::url($story->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-16 h-16 md:w-14 md:h-14 bg-gray-50 rounded-xl flex items-center justify-center text-gray-300 border border-dashed border-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="flex-1 md:hidden">
                            <p class="font-bold text-gray-800 line-clamp-2 leading-tight">{{ $story->title }}</p>
                            <span class="inline-block px-1.5 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-black rounded mt-1 uppercase tracking-widest">{{ $story->tag ?? 'CERITA' }}</span>
                        </div>
                    </div>
                </td>

                {{-- Desktop Title Cell --}}
                <td class="hidden md:table-cell px-6 py-4 text-xs font-semibold text-gray-700">
                    <p class="font-bold text-gray-800 line-clamp-1 truncate">{{ $story->title }}</p>
                    <span class="inline-block px-1.5 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-black rounded mt-1 uppercase tracking-widest">{{ $story->tag ?? 'CERITA' }}</span>
                </td>

                {{-- Tarikh --}}
                <td class="block md:table-cell px-6 py-2 md:py-4 border-t border-gray-50 md:border-none text-xs text-gray-500 italic">
                    <div class="flex items-center gap-2">
                        <span class="md:hidden text-[9px] font-black text-gray-400 uppercase tracking-widest">Tarikh Aktiviti:</span>
                        <span>{{ $story->event_date ?? '—' }}</span>
                    </div>
                </td>

                {{-- Status --}}
                <td class="block md:table-cell px-6 py-2 md:py-4 border-t border-gray-50 md:border-none text-center">
                    <div class="flex flex-col md:items-center">
                        <span class="md:hidden text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Aktiviti</span>
                        <div>
                            <span class="inline-flex items-center px-2.5 py-1 text-[9px] font-black rounded-lg border {{ $story->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-red-50 text-red-600 border-red-100' }} uppercase tracking-widest">
                                {{ $story->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </td>

                {{-- Actions --}}
                <td class="block md:table-cell px-6 py-4 bg-gray-50/50 md:bg-transparent border-t border-gray-100 md:border-none">
                    <div class="flex items-center justify-start md:justify-end gap-2">
                        <a href="{{ route('admin.activity-stories.edit', $story) }}" 
                           class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 md:px-3 py-2 md:py-1.5 bg-white text-gray-600 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-xl md:rounded-lg transition shadow-sm group/btn">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">Edit</span>
                        </a>
                        <button type="button" onclick="confirmDelete({{ $story->id }}, '{{ addslashes($story->title) }}')" 
                                class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-4 md:px-3 py-2 md:py-1.5 bg-white text-gray-500 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-xl md:rounded-lg transition shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
                            <span class="text-[10px] font-black uppercase tracking-widest">Padam</span>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr class="block md:table-row">
                <td colspan="7" class="block md:table-cell px-6 py-24 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 mb-4 border border-dashed border-gray-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <p class="font-bold text-gray-800">Tiada cerita dijumpai</p>
                        <p class="text-xs text-gray-400 mt-1 max-w-[200px]">Carian anda tidak padan dengan mana-mana rekod.</p>
                        <a href="{{ route('admin.activity-stories.create') }}" class="text-xs font-black text-blue-600 uppercase tracking-widest mt-4 hover:underline">+ Tambah Cerita Baru</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($stories->hasPages())
    <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30 flex flex-col md:flex-row items-center justify-between gap-4 table-pagination">
        <div class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">
            Menunjukkan <span class="text-blue-600">{{ $stories->firstItem() }}</span> ke <span class="text-blue-600">{{ $stories->lastItem() }}</span> daripada <span class="text-blue-600">{{ $stories->total() }}</span> rekod
        </div>
        <div class="paging-links">
            {{ $stories->links() }}
        </div>
    </div>
@endif
