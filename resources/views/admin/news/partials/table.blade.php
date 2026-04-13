<div class="overflow-x-auto relative min-h-[400px]">
    {{-- Skeleton/Loading Overlay --}}
    <div id="table-loader" class="absolute inset-0 bg-white/50 backdrop-blur-[1px] z-10 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-blue-600/20 border-t-blue-600 rounded-full animate-spin"></div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Memuatkan...</span>
        </div>
    </div>

    <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-50/80 text-[10px] text-gray-400 uppercase tracking-[0.2em] font-black border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 w-10 text-center text-gray-300">#</th>
                <th class="px-6 py-4 w-20">Gambar</th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('title')" class="flex items-center gap-2 hover:text-blue-600 transition group">
                        Tajuk / Kategori
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ request('sort') == 'title' && request('direction') == 'asc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ request('sort') == 'title' && request('direction') == 'desc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4">Penulis</th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('status')" class="flex items-center gap-2 hover:text-blue-600 transition group">
                        Status
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ request('sort') == 'status' && request('direction') == 'asc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ request('sort') == 'status' && request('direction') == 'desc' ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4">
                    <button type="button" onclick="sort('created_at')" class="flex items-center gap-2 hover:text-blue-600 transition group">
                        Tarikh
                        <span class="inline-flex flex-col">
                            <svg class="w-2.5 h-2.5 {{ (request('sort','created_at') == 'created_at' && request('direction','desc') == 'asc') ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"/></svg>
                            <svg class="w-2.5 h-2.5 -mt-1 {{ (request('sort','created_at') == 'created_at' && request('direction','desc') == 'desc') ? 'text-blue-600' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                        </span>
                    </button>
                </th>
                <th class="px-6 py-4 text-right">Tindakan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($posts as $post)
            <tr class="hover:bg-blue-50/30 transition group/row animate-in fade-in duration-500">
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <span class="text-[10px] font-black text-gray-300">{{ $posts->firstItem() + $loop->index }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($post->thumbnail)
                        <div class="relative w-14 h-14 rounded-xl overflow-hidden shadow-sm border border-gray-100 group-hover/row:scale-105 transition duration-300">
                            <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-14 h-14 bg-gray-50 rounded-xl flex items-center justify-center text-gray-300 border border-dashed border-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="max-w-xs">
                        <p class="font-bold text-gray-800 line-clamp-1 group-hover/row:text-blue-600 transition">{{ $post->title }}</p>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $post->category?->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-[10px] font-black uppercase">
                            {{ substr($post->author?->name ?? '?', 0, 2) }}
                        </div>
                        <p class="text-xs font-semibold text-gray-600">{{ $post->author?->name ?? '—' }}</p>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @php
                        $badge = match($post->status) {
                            'published' => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                            'draft'     => 'text-amber-600 bg-amber-50 border-amber-100',
                            'archived'  => 'text-slate-500 bg-slate-50 border-slate-100',
                            default     => 'text-slate-400 bg-slate-50 border-slate-100',
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-black rounded-lg border {{ $badge }} uppercase tracking-tighter">
                        {{ $post->status }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-gray-700">{{ $post->created_at->format('d M Y') }}</span>
                        <span class="text-[10px] text-gray-400 font-medium">{{ $post->created_at->format('H:i A') }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2 px-2">
                        <a href="{{ route('admin.news.edit', $post) }}" 
                           class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-lg transition shadow-sm group/btn">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <button type="button" onclick="confirmDelete({{ $post->id }}, '{{ addslashes($post->title) }}')" 
                                class="w-8 h-8 flex items-center justify-center bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-lg transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4-6h4"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-24 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center text-gray-200 mb-4 border border-dashed border-gray-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <p class="font-bold text-gray-800">Tiada artikel dijumpai</p>
                        <p class="text-xs text-gray-400 mt-1 max-w-[200px]">Carian anda tidak padan dengan mana-mana rekod.</p>
                        <a href="{{ route('admin.news.create') }}" class="text-xs font-black text-blue-600 uppercase tracking-widest mt-4 hover:underline">+ Tambah Artikel Baru</a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($posts->hasPages())
    <div class="px-6 py-4 border-t border-gray-50 bg-gray-50/30 table-pagination">
        {{ $posts->links() }}
    </div>
@endif
