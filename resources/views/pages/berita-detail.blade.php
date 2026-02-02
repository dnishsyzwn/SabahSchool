@extends('layouts.app')

@section('title', 'Berita Detail | STU')

@section('content')
    <!-- Hero Header -->
    <section class="relative min-h-[40vh] flex items-center bg-primary overflow-hidden pt-20">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/berita-hero.png') }}" alt="Berita Detail" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-primary/20 to-primary/20"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-12">
            <div class="max-w-3xl">
                <a href="{{ url('/berita') }}" class="inline-flex items-center gap-2 text-secondary hover:text-white transition-colors mb-8 group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-bold text-sm tracking-wide uppercase">Kembali ke Senarai Berita</span>
                </a>
                
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/20 text-secondary rounded-lg mb-6 border border-secondary/30 backdrop-blur-sm">
                    <span class="text-xs font-bold tracking-wider uppercase">Pendidikan</span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
                    Program Transformasi Digital Pendidikan Sabah 2026 Dilancarkan
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-gray-300 text-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>02 Februari 2026</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Oleh: Admin STU</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>1,234 Paparan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Article Content (Wider: 75%) -->
                <div class="w-full lg:w-3/4">
                    <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-sm border border-gray-100">
                        <!-- Featured Image -->
                        <div class="relative rounded-3xl overflow-hidden mb-12 aspect-video gallery-trigger shadow-lg ring-1 ring-black/5">
                            <img src="{{ asset('images/berita-hero.png') }}" alt="Featured Image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>

                        <!-- Content Body -->
                        <div class="prose prose-lg max-w-none prose-p:text-gray-600 prose-headings:text-primary prose-headings:font-bold prose-strong:text-primary">
                            <p class="text-xl font-medium text-gray-700 leading-relaxed mb-8">
                                KOTA KINABALU – Kesatuan Guru-Guru Kerajaan Sabah (STU) hari ini secara rasmi melancarkan Inisiatif Transformasi Digital Pendidikan Sabah 2026, sebuah program komprehensif yang bertujuan membekalkan guru-guru di seluruh negeri dengan kemahiran teknologi masa hadapan.
                            </p>
                            
                            <h2>Memartabatkan Profesion Perguruan di Era Digital</h2>
                            <p>
                                Dalam satu majlis yang dihadiri oleh lebih 500 orang pendidik dari segenap pelosok negeri, Presiden STU menekankan kepentingan menguasai teknologi kecerdasan buatan (AI) dan alat kolaborasi digital dalam proses pengajaran dan pembelajaran (PdP) harian.
                            </p>
                            
                            <blockquote>
                                "Kita tidak boleh lagi berpaling ke belakang. Teknologi bukan pengganti guru, tetapi teknologi di tangan guru yang hebat akan mengubah masa depan anak bangsa kita."
                            </blockquote>
                            
                            <p>
                                Program ini akan dilaksanakan secara berperingkat bermula bulan hadapan, merangkumi siri latihan intensif, penyediaan sumber digital secara atas talian, dan penubuhan komuniti praktis digital di setiap cawangan STU.
                            </p>

                            <!-- Multi-Image Gallery Example -->
                            <div class="my-12">
                                <h4 class="text-primary font-bold mb-6 flex items-center gap-2 text-sm uppercase tracking-wider">
                                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Galeri Foto Program
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-4">
                                        <div class="group relative aspect-video rounded-3xl overflow-hidden shadow-md gallery-trigger">
                                            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop" alt="Gallery 1" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                                <p class="text-white text-xs font-medium">Sesi latihan intensif guru-guru di KK.</p>
                                            </div>
                                        </div>
                                        <div class="group relative aspect-video rounded-3xl overflow-hidden shadow-md gallery-trigger">
                                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop" alt="Gallery 2" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                                <p class="text-white text-xs font-medium">Kolaborasi antara ahli cawangan.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group relative h-full aspect-[4/5] md:aspect-auto rounded-3xl overflow-hidden shadow-md gallery-trigger">
                                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2070&auto=format&fit=crop" alt="Gallery 3" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                            <div>
                                                <span class="px-2 py-1 bg-secondary text-primary text-[10px] font-bold rounded mb-2 inline-block uppercase italic">Gambar Utama</span>
                                                <p class="text-white text-sm font-semibold">Suasana dewan yang penuh dengan semangat pembelajaran.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-4 text-center text-xs text-gray-400 italic font-medium">Klik pada gambar untuk paparan penuh galeri program.</p>
                            </div>

                            <div class="my-10 p-8 bg-primary/5 rounded-3xl border border-primary/10">
                                <h4 class="text-primary font-bold mb-4">Objektif Utama Inisiatif:</h4>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-secondary mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">Meningkatkan literasi digital di kalangan guru sekolah luar bandar.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-secondary mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">Menyediakan platform perkongsian bahan bantu mengajar digital.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-secondary mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span class="text-gray-700">Membina rangkaian sokongan teknikal sesama ahli kesatuan.</span>
                                    </li>
                                </ul>
                            </div>

                            <h2>Kolaborasi Strategik</h2>
                            <p>
                                STU juga mengumumkan kolaborasi strategik dengan beberapa syarikat teknologi terkemuka dunia untuk memastikan modul latihan yang diberikan adalah selari dengan standard industri global. Inisiatif ini dijangka akan memberi manfaat kepada lebih 20,000 orang ahli STU di seluruh Sabah.
                            </p>
                        </div>

                        <!-- Article Footer / Tags -->
                        <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap items-center justify-between gap-6">
                            <div class="flex items-center gap-3">
                                <span class="text-sm font-bold text-gray-500 uppercase">Tags:</span>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg hover:bg-secondary/20 hover:text-secondary transition-colors cursor-pointer uppercase tracking-wider">Pendidikan</span>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg hover:bg-secondary/20 hover:text-secondary transition-colors cursor-pointer uppercase tracking-wider">Digital</span>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg hover:bg-secondary/20 hover:text-secondary transition-colors cursor-pointer uppercase tracking-wider">STU</span>
                                </div>
                            </div>
                            
                            <!-- Share Buttons -->
                            <div class="flex items-center gap-4">
                                <span class="text-sm font-bold text-gray-500 uppercase">Kongsi:</span>
                                <div class="flex gap-2">
                                    <button class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </button>
                                    <button class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                    </button>
                                    <button class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Narrower: 25%) -->
                <div class="w-full lg:w-1/4">
                    <div class="sticky top-24 space-y-8">
                        <!-- Category Widget -->
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-secondary rounded-full"></span>
                                Kategori
                            </h3>
                            <div class="space-y-3">
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-primary hover:text-white transition-all group">
                                    <span class="font-bold">Berita Pendidikan</span>
                                    <span class="px-2 py-1 bg-white text-primary text-xs font-bold rounded-lg group-hover:bg-secondary/20 group-hover:text-secondary tracking-wider">12</span>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-primary hover:text-white transition-all group">
                                    <span class="font-bold">Aktiviti STU</span>
                                    <span class="px-2 py-1 bg-white text-primary text-xs font-bold rounded-lg group-hover:bg-secondary/20 group-hover:text-secondary tracking-wider">8</span>
                                </a>
                                <a href="#" class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-primary hover:text-white transition-all group">
                                    <span class="font-bold">Pengumuman</span>
                                    <span class="px-2 py-1 bg-white text-primary text-xs font-bold rounded-lg group-hover:bg-secondary/20 group-hover:text-secondary tracking-wider">5</span>
                                </a>
                            </div>
                        </div>

                        <!-- Recent News Widget -->
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                            <h3 class="text-xl font-bold text-primary mb-6 flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-secondary rounded-full"></span>
                                Berita Terkini
                            </h3>
                            <div class="space-y-6">
                                <a href="#" class="flex gap-4 group">
                                    <div class="w-24 aspect-video rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('images/berita-hero.png') }}" alt="News" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="text-[10px] font-bold text-secondary mb-1">28 Jan 2026</span>
                                        <h4 class="text-xs font-bold text-primary group-hover:text-secondary transition-colors line-clamp-2 leading-snug">Mesyuarat Agung Tahunan STU Cawangan Tawau</h4>
                                    </div>
                                </a>
                                <a href="#" class="flex gap-4 group">
                                    <div class="w-24 aspect-video rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('images/berita-hero.png') }}" alt="News" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="text-[10px] font-bold text-secondary mb-1">25 Jan 2026</span>
                                        <h4 class="text-xs font-bold text-primary group-hover:text-secondary transition-colors line-clamp-2 leading-snug">Kebajikan Ahli STU Keutamaan Kami</h4>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related News Section -->
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-primary mb-12">Berita Berkaitan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for ($i = 0; $i < 3; $i++)
                    <div class="group bg-gray-50 rounded-[2.5rem] p-6 border border-gray-100 hover:bg-white hover:shadow-xl hover:shadow-primary/5 transition-all duration-500 hover:-translate-y-2">
                        <div class="relative rounded-3xl overflow-hidden mb-6 aspect-video">
                            <img src="{{ asset('images/berita-hero.png') }}" alt="News Image" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xs font-bold text-secondary uppercase tracking-wider">Aktiviti</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span class="text-xs font-medium text-gray-500">20 Jan 2026</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-4 line-clamp-2 group-hover:text-secondary transition-colors leading-snug">
                            Lawatan Penanda Aras STU ke Universiti Malaysia Sabah
                        </h3>
                        <a href="#" class="inline-flex items-center gap-2 text-primary font-bold text-sm group/btn">
                            Baca Penuh
                            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-primary/95 backdrop-blur-xl flex items-center justify-center opacity-0 pointer-events-none transition-all duration-500 overflow-hidden">
        <!-- Close Button -->
        <button id="close-lightbox" class="absolute top-8 right-8 text-white/50 hover:text-secondary hover:rotate-90 transition-all duration-300 z-[110]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Navigation Buttons -->
        <button id="prev-btn" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 p-4 bg-white/5 text-white/50 hover:text-secondary hover:bg-white/10 rounded-full transition-all duration-300 z-[110] backdrop-blur-md">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="next-btn" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 p-4 bg-white/5 text-white/50 hover:text-secondary hover:bg-white/10 rounded-full transition-all duration-300 z-[110] backdrop-blur-md">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Image Container -->
        <div class="relative w-full max-w-6xl aspect-video px-4 md:px-0 flex flex-col items-center gap-6">
            <div class="relative w-full h-full rounded-3xl overflow-hidden shadow-2xl border border-white/10">
                <img id="lightbox-img" src="" alt="Full View" class="w-full h-full object-cover transition-all duration-500 scale-95 opacity-0">
                
                <!-- Caption Area -->
                <div class="absolute bottom-0 inset-x-0 p-8 pt-20 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                    <p id="lightbox-caption" class="text-white text-lg font-medium text-center"></p>
                </div>
            </div>
            
            <!-- Index Indicator -->
            <div id="lightbox-index" class="px-4 py-1.5 bg-white/10 text-white/70 text-xs font-bold rounded-full backdrop-blur-md border border-white/10">
                1 / 3
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const lightboxIndex = document.getElementById('lightbox-index');
            const closeBtn = document.getElementById('close-lightbox');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            let currentIndex = 0;
            let galleryItems = [];

            // Dynamically build gallery from triggers
            const triggers = document.querySelectorAll('.gallery-trigger');
            triggers.forEach((el, index) => {
                const img = el.querySelector('img');
                const caption = el.querySelector('p')?.textContent || img?.alt || 'Imej Berita STU';
                
                galleryItems.push({
                    src: img.src,
                    caption: caption
                });

                el.style.cursor = 'pointer';
                el.addEventListener('click', () => openLightbox(index));
            });

            function openLightbox(index) {
                currentIndex = index;
                updateLightbox();
                lightbox.classList.remove('opacity-0', 'pointer-events-none');
                document.body.style.overflow = 'hidden'; 
                
                setTimeout(() => {
                    lightboxImg.classList.remove('scale-95', 'opacity-0');
                    lightboxImg.classList.add('scale-100', 'opacity-100');
                }, 50);
            }

            function closeLightbox() {
                lightboxImg.classList.add('scale-95', 'opacity-0');
                lightboxImg.classList.remove('scale-100', 'opacity-100');
                
                setTimeout(() => {
                    lightbox.classList.add('opacity-0', 'pointer-events-none');
                    document.body.style.overflow = ''; 
                }, 300);
            }

            function updateLightbox() {
                const item = galleryItems[currentIndex];
                
                lightboxImg.style.opacity = '0';
                lightboxImg.style.transform = 'scale(0.98)';
                
                setTimeout(() => {
                    lightboxImg.src = item.src;
                    lightboxCaption.textContent = item.caption;
                    lightboxIndex.textContent = `${currentIndex + 1} / ${galleryItems.length}`;
                    lightboxImg.style.opacity = '1';
                    lightboxImg.style.transform = 'scale(1)';
                }, 200);
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % galleryItems.length;
                updateLightbox();
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
                updateLightbox();
            }

            closeBtn.addEventListener('click', closeLightbox);
            nextBtn.addEventListener('click', nextImage);
            prevBtn.addEventListener('click', prevImage);
            
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });

            document.addEventListener('keydown', (e) => {
                if (lightbox.classList.contains('opacity-0')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'ArrowLeft') prevImage();
            });
        });
    </script>
    @endpush
@endsection
