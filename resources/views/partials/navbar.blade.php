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
    <div id="bottom-bar" class="bg-primary h-12 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto w-full flex justify-center items-center relative">
            <!-- Navigation Links -->
            <div class="hidden sm:flex space-x-8">
                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'text-secondary' : 'text-white' }} uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">HOME</a>
                <a href="#" class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">PROFIL KGKS</a>
                <a href="{{ url('/galeri') }}" class="{{ Request::is('galeri') ? 'text-secondary' : 'text-white' }} uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">GALERI</a>
                <a href="#" class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">MUAT TURUN</a>
                <a href="#" class="text-white uppercase font-bold text-[14px] tracking-widest hover:text-secondary transition duration-150">HUBUNGI KAMI</a>
            </div>

            <!-- Icons & Scrolled Flags -->
            <div class="absolute right-0 flex items-center space-x-4">
                

                <button class="text-white hover:text-secondary">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="sm:hidden absolute left-0 flex items-center">
                <button class="text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const stickyWrapper = document.getElementById('sticky-wrapper');
        const bottomBar = document.getElementById('bottom-bar');
        const stickyFlags = document.getElementById('sticky-flags');
        const stickyOffset = stickyWrapper.offsetTop;

        window.addEventListener('scroll', function() {
            if (window.pageYOffset >= stickyOffset) {
                bottomBar.classList.add('is-sticky');
                stickyFlags.classList.remove('hidden');
            } else {
                bottomBar.classList.remove('is-sticky');
                stickyFlags.classList.add('hidden');
            }
        });
    })();
</script>
