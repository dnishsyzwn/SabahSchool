<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 bg-[#001456] overflow-hidden">
    <!-- Seamless Top Divider Wave (Inverted to mask background blurs) -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none z-10 pointer-events-none transform -translate-y-[1px]">
        <svg class="relative block w-full h-[60px] md:h-[100px] lg:h-[140px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path fill="#f8fafc" d="M0,0 C320,120 420,120 720,60 C1020,0 1120,0 1440,60 L1440,0 L0,0 Z"></path>
        </svg>
    </div>

    <!-- Subtle Background Element for Dark Theme -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
        <div class="absolute top-0 right-0 -translate-y-1/3 translate-x-1/4 w-[800px] h-[800px] bg-green-500 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[600px] h-[600px] bg-blue-500 rounded-full blur-[100px]"></div>
        <!-- Simple grid pattern -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.05)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.05)_1px,transparent_1px)] bg-[size:40px_40px]"></div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 max-w-7xl">
        
        <!-- Header Section -->
        <div class="mb-16 md:mb-24 flex flex-col items-center justify-center text-center relative z-20">
            <!-- Decorative Glow Behind Header -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[100px] bg-green-400/20 blur-[60px] rounded-full pointer-events-none"></div>
            
            <!-- Main Title with Glowing Text Animation -->
            <style>
                @keyframes text-glow-pulse {
                    0%, 100% {
                        text-shadow: 0 0 12px rgba(255, 255, 255, 0.3), 0 0 24px rgba(0, 186, 81, 0.2);
                        color: #ffffff;
                    }
                    50% {
                        text-shadow: 0 0 5px rgba(255, 255, 255, 0.1), 0 0 10px rgba(0, 186, 81, 0.1);
                        color: rgba(255, 255, 255, 0.85);
                    }
                }
                .animate-text-glow {
                    animation: text-glow-pulse 4s ease-in-out infinite alternate;
                }
            </style>
            <div class="relative mb-6 inline-block">
                <h2 class="relative text-4xl sm:text-5xl md:text-6xl font-extrabold leading-tight tracking-tight z-10 animate-text-glow">
                    SUMBANGAN & PERJUANGAN
                </h2>
            </div>
            
            <!-- Subtitle/Description -->
            <p class="max-w-4xl text-gray-300 text-base sm:text-lg md:text-xl leading-relaxed font-light drop-shadow-md">
                Satu rekod cemerlang yang membuktikan komitmen berterusan <span class="font-semibold text-white drop-shadow-[0_0_8px_rgba(255,255,255,0.4)]">Sabah Teacher's Union</span> dalam memartabatkan profesion perguruan serta membela nasib para pendidik di seluruh negeri Sabah. Sejak penubuhannya, STU telah menjadi suara utama dalam rundingan bersama pihak kerajaan untuk memastikan kebajikan guru sentiasa terpelihara.
            </p>
            <p class="max-w-3xl text-gray-400 text-sm md:text-base mt-4 font-light leading-relaxed">
                Kami percaya bahawa pendidikan yang berkualiti bermula dengan guru yang dihargai. Oleh itu, setiap pencapaian dalam senarai ini adalah hasil kesatuan dan sokongan padu daripada ahli-ahli kami di peringkat akar umbi.
            </p>
            
            <!-- Separator Line -->
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-green to-transparent mt-10 opacity-70"></div>
        </div>

        <!-- Professional List Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            
            @php
                $perjuangan = [
                    "Mendapat gaji yang sama bagi guru siswazah seperti siswazah dalam perkhidmatan lain",
                    "Menambah peluang kenaikan pangkat untuk guru siswazah dan bukan siswazah",
                    "Imbuhan tetap perumahan",
                    "Imbuhan tetap keraian",
                    "Kenaikan pangkat mengikut masa (time based)",
                    "Menambah baik PTK",
                    "Hadiah pergerakan Gaji Guru Pakar / Cemerlang",
                    "Penempatan dan status guru pendidikan jarak jauh",
                    "Peningkatan Sijil Perguruan Asas Bertaraf Diploma",
                    "Memendekkan tempoh kursus Induksi",
                    "Mewujudkan jawatan kaunselor di sekolah-sekolah dan lain-lain lagi"
                ]
            @endphp

            <style>
                .group:hover .neon-glow-text {
                    text-shadow: 0 0 15px rgba(0, 186, 81, 0.5), 0 0 30px rgba(0, 186, 81, 0.3);
                    color: #ffffff;
                }
                .group:hover .neon-glow-number {
                    text-shadow: 0 0 10px rgba(0, 186, 81, 0.4), 0 0 20px rgba(0, 186, 81, 0.2);
                    color: #00ba51;
                    transform: scale(1.1);
                }
                .glass-card-bg {
                    background: linear-gradient(145deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%);
                }
            </style>

            @foreach($perjuangan as $index => $item)
            <div class="group relative glass-card-bg backdrop-blur-md rounded-2xl border border-white/5 hover:border-green/40 hover:bg-green/5 transition-all duration-500 overflow-hidden hover:-translate-y-1 hover:shadow-[0_15px_40px_-10px_rgba(0,186,81,0.25)] flex h-full p-[1px]">
                
                <!-- Inner Card Content (to support thin gradient borders if we want, currently simple background) -->
                <div class="relative w-full h-full bg-[#001456]/50 rounded-[15px] p-6 sm:p-8 flex items-start gap-5">
                    
                    <!-- Decorative Large Watermark Number (Background) -->
                    <div class="absolute -bottom-4 right-2 text-7xl font-black text-white/[0.02] group-hover:text-green/[0.05] transition-colors duration-500 select-none pointer-events-none">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>

                    <!-- Glowing Top Line (Hover) -->
                    <div class="absolute top-0 inset-x-0 h-[2px] bg-gradient-to-r from-transparent via-green to-transparent scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-center drop-shadow-[0_0_8px_rgba(0,186,81,0.8)] opacity-0 group-hover:opacity-100 rounded-t-[15px]"></div>
                    
                    <!-- Number Badge -->
                    <div class="shrink-0 flex items-center justify-center mt-0.5">
                        <span class="text-xl font-bold text-gray-400/50 group-hover:text-green neon-glow-number transition-all duration-500">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}.
                        </span>
                    </div>
                    
                    <!-- Text Content -->
                    <div class="flex-1 relative z-10 w-full">
                        <h3 class="text-gray-300 font-medium text-base sm:text-lg leading-relaxed group-hover:text-white neon-glow-text transition-all duration-500 max-w-[95%]">
                            {{ $item }}
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
