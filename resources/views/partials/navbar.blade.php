<!-- Top Bar  - Static, scrolls away -->
<div id="top-bar" class="bg-green/60 h-26 flex items-center justify-between px-4 sm:px-6 lg:px-8">
    <div class="flex-1"></div>
    
    <!-- Logo -->
    <div class="flex-shrink-0 flex items-center justify-center">
        <a href="{{ url('/') }}">
            <img src="{{ Vite::asset('resources/images/stu-logo.png') }}" alt="STU Logo" class="h-20 w-auto" onerror="this.src='https://via.placeholder.com/60?text=LOGO'">
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
                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'text-secondary' : 'text-white' }} uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">HOME</a>
                
                <!-- PROFIL STU Dropdown -->
                <div class="relative group h-full flex items-center">
                    <button class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150 flex items-center gap-1 focus:outline-none cursor-default">
                        PROFIL STU
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full mt-6 left-1/2 -translate-x-1/2 w-72 bg-primary border-t-2 border-secondary shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-[60]">
                        <div>
                            <a href="{{ url('/mengenai-stu') }}" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors">
                                MENGENAI STU
                            </a>
                            <a href="#" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors border-t border-white/5 uppercase">
                                AHLI TERTINGGI & EXCO
                            </a>
                            <a href="#" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors border-t border-white/5 uppercase">
                                PENGURUSAN
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ url('/galeri') }}" class="{{ Request::is('galeri') ? 'text-secondary' : 'text-white' }} uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">GALERI</a>
                
                <!-- BORANG Dropdown -->
                <div class="relative group h-full flex items-center">
                    <button class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150 flex items-center gap-1 focus:outline-none cursor-default">
                        BORANG
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full mt-6 left-1/2 -translate-x-1/2 w-72 bg-primary border-t-2 border-secondary shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-[60]">
                        <div >
                            <a href="{{ url('/borang/muat-turun') }}" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors uppercase">
                                MUAT TURUN BORANG
                            </a>
                            <a href="{{ url('/borang/hantar') }}" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors border-t border-white/5 uppercase">
                                HANTAR BORANG
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- KONTAK Dropdown -->
                <div class="relative group h-full flex items-center">
                    <button class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150 flex items-center gap-1 focus:outline-none cursor-default">
                        KONTAK
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute top-full mt-6 left-1/2 -translate-x-1/2 w-72 bg-primary border-t-2 border-secondary shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-[60]">
                        <div >
                            <a href="{{ url('/hubungi') }}" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors uppercase">
                                HUBUNGI KAMI
                            </a>
                            <a href="{{ url('/kerjaya') }}" class="block px-6 py-3 text-white text-[13px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors border-t border-white/5 uppercase">
                                KERJAYA
                            </a>
                        </div>
                    </div>
                </div>
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
                <img src="{{ Vite::asset('resources/images/stu-logo.png') }}" alt="STU Logo" class="h-16 w-auto" onerror="this.src='https://via.placeholder.com/60?text=LOGO'">
            </a>
        </div>

        <!-- Mobile Navigation -->
        <nav class="space-y-4">
            <!-- HOME -->
            <a href="{{ url('/') }}" class="block py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg {{ Request::is('/') ? 'bg-secondary text-primary' : '' }}">
                HOME
            </a>

            <!-- PROFIL STU (Accordion) -->
            <div class="border-b border-white/10 pb-2">
                <button class="mobile-accordion-toggle w-full flex items-center justify-between py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:text-secondary transition-colors">
                    <span>PROFIL STU</span>
                    <svg class="accordion-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="mobile-accordion-content pl-6 pr-4 hidden space-y-2 mt-2">
                    <a href="{{ url('/mengenai-stu') }}" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg">
                        MENGENAI STU
                    </a>
                    <a href="#" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        AHLI TERTINGGI & EXCO
                    </a>
                    <a href="#" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        PENGURUSAN
                    </a>
                </div>
            </div>

            <!-- GALERI -->
            <a href="{{ url('/galeri') }}" class="block py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg {{ Request::is('galeri') ? 'bg-secondary text-primary' : '' }}">
                GALERI
            </a>

            <!-- BORANG (Accordion) -->
            <div class="border-b border-white/10 pb-2">
                <button class="mobile-accordion-toggle w-full flex items-center justify-between py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:text-secondary transition-colors">
                    <span>BORANG</span>
                    <svg class="accordion-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="mobile-accordion-content pl-6 pr-4 hidden space-y-2 mt-2">
                    <a href="{{ url('/borang/muat-turun') }}" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        MUAT TURUN BORANG
                    </a>
                    <a href="{{ url('/borang/hantar') }}" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        HANTAR BORANG
                    </a>
                </div>
            </div>

            <!-- KONTAK (Accordion) -->
            <div class="border-b border-white/10 pb-2">
                <button class="mobile-accordion-toggle w-full flex items-center justify-between py-3 px-4 text-white uppercase font-bold text-[16px] tracking-wider hover:text-secondary transition-colors">
                    <span>KONTAK</span>
                    <svg class="accordion-icon w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="mobile-accordion-content pl-6 pr-4 hidden space-y-2 mt-2">
                    <a href="{{ url('/hubungi') }}" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        HUBUNGI KAMI
                    </a>
                    <a href="{{ url('/kerjaya') }}" class="block py-2 px-4 text-white text-[14px] font-bold tracking-wider hover:bg-secondary hover:text-primary transition-colors rounded-lg uppercase">
                        KERJAYA
                    </a>
                </div>
            </div>
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

<script>
    (function() {
        // Desktop Sticky Navbar
        const stickyWrapper = document.getElementById('sticky-wrapper');
        const bottomBar = document.getElementById('bottom-bar');
        const stickyFlags = document.getElementById('sticky-flags');
        
        // Initial offset calculation
        let stickyOffset = stickyWrapper.offsetTop;

        window.addEventListener('scroll', function() {
            // Re-calculate offset in case of layout shifts, but use a threshold for performance
            if (window.scrollY > stickyOffset) {
                bottomBar.classList.add('is-sticky');
                if (stickyFlags) stickyFlags.classList.remove('hidden');
            } else {
                bottomBar.classList.remove('is-sticky');
                if (stickyFlags) stickyFlags.classList.add('hidden');
            }
        }, { passive: true });

        // Update offset on resize
        window.addEventListener('resize', function() {
            stickyOffset = stickyWrapper.offsetTop;
        });

        // Mobile Menu Functionality
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenuPanel = document.getElementById('mobile-menu-panel');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        const mobileCloseIcon = document.getElementById('mobile-close-icon');
        const accordionToggles = document.querySelectorAll('.mobile-accordion-toggle');

        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const isOpen = mobileMenuPanel.classList.contains('translate-x-0');
            
            if (isOpen) {
                mobileMenuPanel.classList.remove('translate-x-0');
                mobileMenuPanel.classList.add('-translate-x-full');
                mobileMenuOverlay.classList.add('hidden');
                mobileMenuIcon.classList.remove('hidden');
                mobileCloseIcon.classList.add('hidden');
                document.body.style.overflow = 'auto';
            } else {
                mobileMenuPanel.classList.remove('-translate-x-full');
                mobileMenuPanel.classList.add('translate-x-0');
                mobileMenuOverlay.classList.remove('hidden');
                mobileMenuIcon.classList.add('hidden');
                mobileCloseIcon.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        // Toggle Accordion
        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.accordion-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Event Listeners
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        mobileMenuClose.addEventListener('click', toggleMobileMenu);
        mobileMenuOverlay.addEventListener('click', toggleMobileMenu);

        // Accordion Event Listeners
        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', () => toggleAccordion(toggle));
        });

        // Close menu when clicking on links (optional)
        const mobileLinks = document.querySelectorAll('#mobile-menu-panel a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', toggleMobileMenu);
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !mobileMenuPanel.classList.contains('-translate-x-full')) {
                toggleMobileMenu();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 640) { // sm breakpoint
                if (!mobileMenuPanel.classList.contains('-translate-x-full')) {
                    toggleMobileMenu();
                }
            }
        });
    })();
</script>

<style>
    /* Additional Styles for Mobile Menu */
    #mobile-menu-panel {
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
    }
    
    #mobile-menu-overlay {
        backdrop-filter: blur(2px);
    }
    
    .mobile-accordion-content {
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Ensure proper stacking */
    #sticky-wrapper {
        z-index: 40;
    }
    
    #bottom-bar.is-sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 40;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>