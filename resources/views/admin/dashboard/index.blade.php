@extends('admin.layouts.app')

@section('title', 'Dashboard Utama')
@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Widget: Borang Terkini -->
    <a href="{{ route('admin.form-submissions.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition hover:shadow-md group">
        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Borang Masuk</p>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingForms }}</p>
            <p class="text-xs text-blue-500 mt-1 font-medium">Pending Kelulusan</p>
        </div>
    </a>

    <!-- Widget: Permohonan Kerjaya -->
    <a href="{{ route('admin.kerjaya.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition hover:shadow-md group">
        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Permohonan Kerjaya</p>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingJobs }}</p>
            <p class="text-xs text-indigo-500 mt-1 font-medium">Calon Baru Menunggu</p>
        </div>
    </a>

    <!-- Widget: Mesej Hubungi Belum Baca -->
    <a href="{{ route('admin.contact-messages.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center transition hover:shadow-md group">
        <div class="p-3 bg-red-50 text-red-600 rounded-lg group-hover:bg-red-600 group-hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Mesej Baru</p>
            <p class="text-3xl font-bold text-gray-900">{{ $unreadMessages }}</p>
            <p class="text-xs text-red-500 mt-1 font-medium">Belum Dibaca</p>
        </div>
    </a>

    <!-- Widget: Akses Pantas -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center">
        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Akses Pantas</p>
        <div class="flex gap-2">
            <a href="#" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded hover:bg-blue-100 transition">Tambah Berita</a>
            <a href="#" class="px-3 py-1.5 bg-green-50 text-green-700 text-xs font-semibold rounded hover:bg-green-100 transition">Tambah Aktiviti</a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Terbaru: Senarai Berita -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-gray-800">Berita Terkini</h3>
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
        </div>
        <div class="divide-y divide-gray-100">
            @forelse($latestNews as $news)
                <div class="p-4 hover:bg-gray-50 transition flex items-start gap-4">
                    @if($news->thumbnail)
                        <img src="{{ Storage::url($news->thumbnail) }}" class="w-16 h-16 rounded object-cover shadow-sm bg-gray-100">
                    @else
                        <div class="w-16 h-16 rounded bg-gray-100 flex items-center justify-center text-gray-400 shadow-sm border border-gray-200">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $news->title }}</p>
                        <p class="text-xs flex items-center gap-1 mt-1 font-medium {{ $news->status === 'published' ? 'text-green-600' : 'text-gray-500' }}">
                            <span class="w-2 h-2 rounded-full {{ $news->status === 'published' ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                            {{ ucfirst($news->status) }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">{{ $news->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Belum ada artikel berita.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Sistem Maklumat Overview -->
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl shadow-lg border border-gray-700 p-6 text-white relative overflow-hidden">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-500/20 rounded-full blur-[80px]"></div>
        
        <div class="relative z-10">
            <h3 class="text-lg font-bold mb-2">Maklumat Sistem</h3>
            <p class="text-gray-300 text-sm mb-6 leading-relaxed">
                Anda sedang log masuk sebagai <strong class="text-white">{{ auth()->user()->role }}</strong>. Anda mempunyai akses untuk menguruskan data mengikut tahap kebenaran peranan anda.
            </p>

            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Tarikh Hari Ini</p>
                        <p class="text-sm font-semibold">{{ now()->translatedFormat('d F Y') }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-medium">Log Masuk Terakhir</p>
                        <p class="text-sm font-semibold">{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->diffForHumans() : 'Kini' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
