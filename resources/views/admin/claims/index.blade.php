@extends('admin.layouts.app')

@section('title', 'Pengurusan Bukti Tuntutan')
@section('header', 'Pengurusan Bukti Tuntutan')

@section('actions')
    <a href="{{ route('admin.claims.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Bukti Tuntutan
    </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 w-16">Gambar</th>
                    <th class="px-4 py-3">Nama Ahli / Sekolah</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Pampasan</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($claims as $claim)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">
                        @if($claim->featured_image)
                            <img src="{{ Storage::url($claim->featured_image) }}" class="w-14 h-14 object-cover rounded-lg shadow-sm border border-gray-200">
                        @else
                            <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-gray-300 border border-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-4 py-3 max-w-xs">
                        <p class="font-semibold text-gray-900 line-clamp-1">{{ $claim->member_name ?? $claim->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $claim->school ?? $claim->location ?? '—' }}</p>
                    </td>
                    <td class="px-4 py-3">
                        @if($claim->claim_type)
                            <span class="inline-block px-2 py-0.5 text-[10px] font-bold rounded-full uppercase tracking-wider {{ $claim->claim_type === 'KEMATIAN' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $claim->claim_type }}
                            </span>
                        @else
                            <span class="text-gray-300">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="font-bold text-gray-900">{{ $claim->compensation_amount ?? $claim->amount ?? '—' }}</span>
                    </td>
                    <td class="px-4 py-3">
                        @php
                            $badge = match($claim->status) {
                                'published' => 'bg-green-100 text-green-700',
                                'draft'     => 'bg-yellow-100 text-yellow-700',
                                'archived'  => 'bg-gray-100 text-gray-600',
                                default     => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full {{ $badge }} capitalize">
                            {{ $claim->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.claims.edit', $claim) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">Edit</a>
                            <form method="POST" action="{{ route('admin.claims.destroy', $claim) }}" onsubmit="return confirm('Padam bukti tuntutan ini?')">
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
                        <p class="font-semibold">Tiada bukti tuntutan dijumpai</p>
                        <a href="{{ route('admin.claims.create') }}" class="text-sm text-blue-500 hover:text-blue-700 mt-1 inline-block">+ Tambah bukti tuntutan pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($claims->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $claims->links() }}
        </div>
    @endif
</div>
@endsection
