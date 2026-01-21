@extends('layouts.app')

@section('title', 'Galeri | Sabah Teachers Union')

@section('content')
    <!-- Gallery Header -->
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">Galeri STU</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Momen-momen bermakna dan aktiviti terkini Sabah Teachers Union dalam memajukan pendidikan di Negeri Sabah.
            </p>
        </div>
    </div>

    <!-- Grid Gallery Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            <!-- Item 1 -->
            <div class="gallery-item animate-fade-in-up delay-100 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(0)">
                <img src="https://images.unsplash.com/photo-1571210862729-78a52d3779a2?q=80&w=2070&auto=format&fit=crop" 
                     alt="Sabah Nature" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 2 -->
            <div class="gallery-item animate-fade-in-up delay-200 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(1)">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2104&auto=format&fit=crop" 
                     alt="Classroom" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 3 -->
            <div class="gallery-item animate-fade-in-up delay-300 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(2)">
                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop" 
                     alt="Meeting" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 4 -->
            <div class="gallery-item animate-fade-in-up delay-400 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(3)">
                <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop" 
                     alt="Students" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 5 -->
            <div class="gallery-item animate-fade-in-up delay-500 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(4)">
                <img src="https://images.unsplash.com/photo-1544531585-9847b68c8c86?q=80&w=2070&auto=format&fit=crop" 
                     alt="Mount Kinabalu" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 6 -->
            <div class="gallery-item animate-fade-in-up delay-600 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(5)">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format&fit=crop" 
                     alt="Teacher" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 7 -->
            <div class="gallery-item animate-fade-in-up delay-700 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(6)">
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=2070&auto=format&fit=crop" 
                     alt="Community" 
                     class="w-full h-full object-cover">
            </div>

            <!-- Item 8 -->
            <div class="gallery-item animate-fade-in-up delay-800 relative overflow-hidden rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 aspect-square cursor-pointer" onclick="openLightbox(7)">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" 
                     alt="Workshop" 
                     class="w-full h-full object-cover">
            </div>

        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-6 right-8 text-white/70 hover:text-white text-4xl font-light transition-colors duration-200 z-[110]">&times;</button>
        
        <!-- Navigation Arrows -->
        <button onclick="changeImage(-1)" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-4 transition-all duration-200 z-[110]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </button>
        <button onclick="changeImage(1)" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 text-white/50 hover:text-white p-4 transition-all duration-200 z-[110]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </button>

        <!-- Main Image Container -->
        <div class="max-w-[90vw] max-h-[85vh] relative flex items-center justify-center" onclick="event.stopPropagation()">
            <img id="lightbox-img" src="" alt="Detailed View" class="max-w-full max-h-[80vh] md:max-h-[85vh] object-contain rounded-lg shadow-2xl transition-all duration-300">
        </div>
    </div>

    @push('scripts')
    <script>
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const images = Array.from(document.querySelectorAll('.gallery-item img')).map(img => img.src);
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            updateLightboxContent();
            lightbox.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeLightbox() {
            lightbox.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = ''; // Re-enable scrolling
        }

        function changeImage(step) {
            currentIndex = (currentIndex + step + images.length) % images.length;
            updateLightboxContent();
        }

        function updateLightboxContent() {
            // Smooth transition effect
            lightboxImg.classList.add('opacity-0', 'scale-95');
            
            setTimeout(() => {
                lightboxImg.src = images[currentIndex];
                lightboxImg.onload = () => {
                    lightboxImg.classList.remove('opacity-0', 'scale-95');
                };
            }, 150);
        }

        // Close on click outside, ESC key, or arrows key
        lightbox.onclick = (e) => {
            if (e.target === lightbox) closeLightbox();
        };

        window.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('pointer-events-none')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') changeImage(1);
            if (e.key === 'ArrowLeft') changeImage(-1);
        });
    </script>
    @endpush
@endsection
