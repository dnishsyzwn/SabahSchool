<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | STU Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- EditorJS Toolbar Fix --}}
    <style>
        .ce-inline-toolbar { z-index: 9999 !important; }
        .ce-toolbar__content, .ce-toolbar__actions { z-index: 9999 !important; }
        .ce-block--selected .ce-block__content { background: rgba(59, 130, 246, 0.05); }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
        
        <!-- Backdrop Overlay -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm xl:hidden transition-opacity duration-300"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 text-white transition-transform duration-300 -translate-x-full xl:translate-x-0 xl:static xl:inset-0 flex flex-col">
            <div class="flex items-center justify-between p-6 border-b border-gray-800">
                <span class="text-2xl font-bold font-serif whitespace-nowrap">STU Admin</span>
                <!-- Close Button (Mobile only) -->
                <button @click="sidebarOpen = false" class="xl:hidden text-gray-400 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2">Kandungan</div>
                
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.news.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita
                </a>
                
                <a href="{{ route('admin.activity-stories.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.activity-stories.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Aktiviti Kami
                </a>

                <a href="{{ route('admin.claims.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.claims.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Bukti Tuntutan
                </a>

                <a href="{{ route('admin.committee.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.committee.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    AJK & Exco
                </a>



                <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mt-6 mb-2">Interaksi</div>

                <a href="{{ route('admin.borang-pintar.index') }}" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.borang-pintar.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Borang Pintar
                </a>

                <a href="{{ route('admin.form-submissions.index') }}" class="flex items-center justify-between px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.form-submissions.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Borang Masuk
                    </div>
                    @php $pendingSubmissions = \App\Models\FormSubmission::where('status', 'pending')->count() @endphp
                    @if($pendingSubmissions > 0)
                        <span class="bg-teal-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-lg shadow-teal-500/30">{{ $pendingSubmissions }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.kerjaya.index') }}" class="flex items-center justify-between px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.kerjaya.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Kerjaya
                    </div>
                    @php $pendingApps = \App\Models\JobApplication::where('status', 'pending')->count() @endphp
                    @if($pendingApps > 0)
                        <span class="bg-indigo-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-lg shadow-indigo-500/30">{{ $pendingApps }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center justify-between px-4 py-2 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800 text-blue-400' : 'text-gray-300' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Hubungi
                    </div>
                    @php $unread = \App\Models\ContactMessage::where('is_read', false)->count() @endphp
                    @if($unread > 0)
                        <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full shadow-lg shadow-red-500/30">{{ $unread }}</span>
                    @endif
                </a>

                @if(auth()->user()->role === 'superadmin')
                
                @endif
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Navbar -->
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 shadow-sm z-10 w-full">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 xl:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                
                <div class="flex items-center gap-4 ml-auto relative" x-data="{ dropdownOpen: false }">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    
                    <button @click="dropdownOpen = !dropdownOpen" class="w-10 h-10 rounded-full border-2 border-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 overflow-hidden bg-gray-100 flex items-center justify-center text-gray-400">
                        @if(auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        @endif
                    </button>

                    <!-- Dropdown -->
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 top-12 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1" style="display: none;">
                        <span class="block px-4 py-2 text-sm text-gray-700 font-semibold border-b sm:hidden">{{ auth()->user()->name }}</span>
                        <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Log Keluar</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 px-6 py-10 sm:px-10 xl:px-12">
                <!-- Page Title -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-2xl font-bold text-gray-900 leading-tight">
                        @yield('header')
                    </h2>
                    <div class="md:mt-0">
                        @yield('actions')
                    </div>
                </div>

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg flex items-center gap-3 shadow-sm border border-green-200 animate-fade-in-up">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-lg flex items-center gap-3 shadow-sm border border-red-200 animate-fade-in-up">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Content Area -->
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
