@extends('admin.layouts.app')

@section('title', 'Pengurusan Berita')
@section('header', 'Pengurusan Berita')

@section('actions')
    <a href="{{ route('admin.news.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Artikel
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    
    {{-- Filter / Search Bar --}}
    <div class="p-4 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row items-center gap-3">
        <form method="GET" action="{{ route('admin.news.index') }}" class="flex flex-1 gap-3 w-full">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel..."
                   class="flex-1 px-4 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            <select name="status" class="px-4 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
                <option value="archived"  {{ request('status') === 'archived'  ? 'selected' : '' }}>Archived</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">Cari</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition">Reset</a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 w-16">Gambar</th>
                    <th class="px-4 py-3">Tajuk / Kategori</th>
                    <th class="px-4 py-3">Penulis</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Tarikh</th>
                    <th class="px-4 py-3 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($posts as $post)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" class="w-14 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                        @else
                            <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 max-w-xs">
                        <p class="font-semibold text-gray-900 line-clamp-2">{{ $post->title }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $post->category?->name ?? '—' }}</p>
                    </td>
                    <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $post->author?->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @php
                            $badge = match($post->status) {
                                'published' => 'bg-green-100 text-green-700',
                                'draft'     => 'bg-yellow-100 text-yellow-700',
                                'archived'  => 'bg-gray-100 text-gray-600',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $badge }} capitalize">
                            {{ $post->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap text-xs">
                        {{ $post->created_at->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.news.edit', $post) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">Edit</a>
                            <form method="POST" action="{{ route('admin.news.destroy', $post) }}" onsubmit="return confirm('Padam artikel ini? Tindakan ini tidak boleh dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-100 transition">Padam</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-16 text-center text-gray-500">
                        <svg class="w-14 h-14 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <p class="font-semibold">Tiada artikel dijumpai</p>
                        <a href="{{ route('admin.news.create') }}" class="text-sm text-blue-500 hover:text-blue-700 mt-1 inline-block">+ Tambah artikel pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $posts->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
