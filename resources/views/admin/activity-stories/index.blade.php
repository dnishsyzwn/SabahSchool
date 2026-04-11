@extends('admin.layouts.app')

@section('title', 'Aktiviti Kami - Pengurusan')
@section('header', 'Pengurusan Aktiviti Kami (Cerita Kejayaan)')

@section('actions')
    <a href="{{ route('admin.activity-stories.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Cerita Baru
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 w-16 text-center">Susun</th>
                    <th class="px-4 py-3 w-24">Gambar</th>
                    <th class="px-4 py-3">Tajuk / Tag</th>
                    <th class="px-4 py-3">Tarikh</th>
                    <th class="px-4 py-3 text-center">Status</th>
                    <th class="px-4 py-3 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($stories as $story)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-mono text-center text-gray-400">{{ $story->sort_order }}</td>
                    <td class="px-4 py-3">
                        @if($story->image_path)
                            <img src="{{ Storage::url($story->image_path) }}" class="w-16 h-12 object-cover rounded-lg shadow-sm border border-gray-200">
                        @else
                            <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 border border-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <p class="font-semibold text-gray-900 line-clamp-1">{{ $story->title }}</p>
                        <span class="inline-block px-1.5 py-0.5 bg-blue-50 text-blue-600 text-[10px] font-bold rounded mt-1 uppercase tracking-wider">{{ $story->tag ?? 'TIADA TAG' }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 italic">{{ $story->event_date ?? '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $story->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $story->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.activity-stories.edit', $story) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">Edit</a>
                            <form method="POST" action="{{ route('admin.activity-stories.destroy', $story) }}" onsubmit="return confirm('Padam cerita ini?')">
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
                        <p class="font-semibold text-lg">Tiada Rekod Dijumpai</p>
                        <p class="text-sm mt-1">Mula tambahkan cerita kejayaan STU anda di sini.</p>
                        <a href="{{ route('admin.activity-stories.create') }}" class="mt-4 inline-block text-blue-600 font-bold hover:underline">+ Tambah Cerita Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
