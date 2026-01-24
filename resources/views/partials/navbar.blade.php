<!-- Top Bar  - Static, scrolls away -->
<div id="top-bar" class="bg-green/60 h-26 flex items-center justify-between px-4 sm:px-6 lg:px-8">
    <div class="flex-1"></div>
    
    <!-- Logo -->
    <div class="flex-shrink-0 flex items-center justify-center">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/stu-logo.png') }}" alt="STU Logo" class="h-20 w-auto" onerror="this.src='https://via.placeholder.com/60?text=LOGO'">
        </a>
    </div>

     <div class="flex-1"></div>
</div>

<!-- Bottom Bar Wrapper (Sticky Section) -->
<div id="sticky-wrapper" class="sticky-wrapper">
    <div id="bottom-bar" class="bg-primary h-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto w-full flex justify-center items-center relative">
            <!-- Navigation Links (Desktop) -->
            <div class="hidden sm:flex space-x-8">
                <x-navbar.nav-link :href="url('/')" :active="Request::is('/')">HOME</x-navbar.nav-link>
                
                <!-- PROFIL STU Dropdown -->
                <x-navbar.nav-dropdown title="PROFIL STU">
                    <x-navbar.nav-dropdown-link :href="url('/mengenai-stu')">MENGENAI STU</x-navbar.nav-dropdown-link>
                    <x-navbar.nav-dropdown-link :href="url('/ahli-tertinggi-exco')" :bordered="true">AHLI TERTINGGI & EXCO</x-navbar.nav-dropdown-link>
                    <x-navbar.nav-dropdown-link :href="url('/pengurusan')" :bordered="true">PENGURUSAN</x-navbar.nav-dropdown-link>
                </x-navbar.nav-dropdown>
                
                <x-navbar.nav-link :href="url('/galeri')" :active="Request::is('galeri')">GALERI</x-navbar.nav-link>
                
                <!-- BORANG Dropdown -->
                <x-navbar.nav-dropdown title="BORANG">
                    <x-navbar.nav-dropdown-link :href="url('/borang/muat-turun')">MUAT TURUN BORANG</x-navbar.nav-dropdown-link>
                    <x-navbar.nav-dropdown-link :href="url('/borang/hantar')" :bordered="true">HANTAR BORANG</x-navbar.nav-dropdown-link>
                </x-navbar.nav-dropdown>
                
                <!-- KONTAK Dropdown -->
                <x-navbar.nav-dropdown title="KONTAK">
                    <x-navbar.nav-dropdown-link :href="url('/hubungi')">HUBUNGI KAMI</x-navbar.nav-dropdown-link>
                    <x-navbar.nav-dropdown-link :href="url('/kerjaya')" :bordered="true">KERJAYA</x-navbar.nav-dropdown-link>
                </x-navbar.nav-dropdown>
            </div>

            <!-- Mobile & Tablet Menu -->
            <div class="sm:hidden absolute left-0 flex items-center">
                <button id="mobile-menu-toggle" class="text-white p-2 focus:outline-none">
                    <svg id="mobile-menu-icon" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="mobile-close-icon" class="h-6 w-6 hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-50 hidden"></div>

<!-- Mobile Menu Panel -->
<div id="mobile-menu-panel" class="fixed top-0 left-0 h-full w-80 bg-primary z-[60] transform -translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-6">
        <!-- Close Button -->
        <div class="flex justify-end mb-8">
            <button id="mobile-menu-close" class="text-white p-2">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Logo -->
        <div class="mb-8 flex justify-center">
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/stu-logo.png') }}" alt="STU Logo" class="h-16 w-auto" onerror="this.src='https://via.placeholder.com/60?text=LOGO'">
            </a>
        </div>

        <!-- Mobile Navigation -->
        <nav class="space-y-4">
            <x-navbar.mobile-nav-link :href="url('/')" :active="Request::is('/')">HOME</x-navbar.mobile-nav-link>

            <x-navbar.mobile-nav-accordion title="PROFIL STU">
                <x-navbar.mobile-nav-accordion-link :href="url('/mengenai-stu')">MENGENAI STU</x-navbar.mobile-nav-accordion-link>
                <x-navbar.mobile-nav-accordion-link :href="url('/ahli-tertinggi-exco')">AHLI TERTINGGI & EXCO</x-navbar.mobile-nav-accordion-link>
                <x-navbar.mobile-nav-accordion-link :href="url('/pengurusan')">PENGURUSAN</x-navbar.mobile-nav-accordion-link>
            </x-navbar.mobile-nav-accordion>

            <x-navbar.mobile-nav-link :href="url('/galeri')" :active="Request::is('galeri')">GALERI</x-navbar.mobile-nav-link>

            <x-navbar.mobile-nav-accordion title="BORANG">
                <x-navbar.mobile-nav-accordion-link :href="url('/borang/muat-turun')">MUAT TURUN BORANG</x-navbar.mobile-nav-accordion-link>
                <x-navbar.mobile-nav-accordion-link :href="url('/borang/hantar')">HANTAR BORANG</x-navbar.mobile-nav-accordion-link>
            </x-navbar.mobile-nav-accordion>

            <x-navbar.mobile-nav-accordion title="KONTAK">
                <x-navbar.mobile-nav-accordion-link :href="url('/hubungi')">HUBUNGI KAMI</x-navbar.mobile-nav-accordion-link>
                <x-navbar.mobile-nav-accordion-link :href="url('/kerjaya')">KERJAYA</x-navbar.mobile-nav-accordion-link>
            </x-navbar.mobile-nav-accordion>
        </nav>

        <!-- Contact Info for Mobile -->
        <div class="mt-12 pt-6 border-t border-white/10">
            <h3 class="text-white uppercase font-bold text-sm tracking-wider mb-4">MAKLUMAT HUBUNGAN</h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-secondary mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-white text-sm">info@stu.org</span>
                </div>
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-secondary mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span class="text-white text-sm">+603-1234 5678</span>
                </div>
            </div>
        </div>
    </div>
</div>