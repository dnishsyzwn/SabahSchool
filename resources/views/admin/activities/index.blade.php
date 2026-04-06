@extends('admin.layouts.app')

@section('title', 'Pengurusan Aktiviti')
@section('header', 'Pengurusan Aktiviti')

@section('actions')
    <a href="{{ route('admin.activities.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Aktiviti
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 w-16">Gambar</th>
                    <th class="px-4 py-3">Tajuk / Kategori</th>
                    <th class="px-4 py-3">Lokasi / Tarikh</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Featured</th>
                    <th class="px-4 py-3 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($activities as $activity)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        @if($activity->featured_image)
                            <img src="{{ Storage::url($activity->featured_image) }}" class="w-14 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                        @else
                            <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 max-w-xs">
                        <p class="font-semibold text-gray-900 line-clamp-1">{{ $activity->title }}</p>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-wider">{{ $activity->category ?? '—' }}</p>
                    </td>
                    <td class="px-4 py-3">
                        <p class="text-gray-900 text-xs">{{ $activity->location ?? '—' }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $activity->event_date ? $activity->event_date->format('d M Y') : '—' }}</p>
                    </td>
                    <td class="px-4 py-3">
                        @php
                            $badge = match($activity->status) {
                                'published' => 'bg-green-100 text-green-700',
                                'draft'     => 'bg-yellow-100 text-yellow-700',
                                'archived'  => 'bg-gray-100 text-gray-600',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $badge }} capitalize">
                            {{ $activity->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($activity->is_featured)
                            <span class="inline-flex items-center justify-center p-1 bg-blue-100 text-blue-600 rounded-full">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </span>
                        @else
                            <span class="text-gray-200">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.activities.edit', $activity) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">Edit</a>
                            <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Padam aktiviti ini?')">
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
                        <p class="font-semibold">Tiada aktiviti dijumpai</p>
                        <a href="{{ route('admin.activities.create') }}" class="text-sm text-blue-500 hover:text-blue-700 mt-1 inline-block">+ Tambah aktiviti pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($activities->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $activities->links() }}
        </div>
    @endif
</div>
@endsection
