@extends('layouts.app')

@section('title', 'Aktiviti Kami | Sabah Teachers Union')

@section('content')
    {{-- Hero Header --}}
    <div class="relative bg-[#f8fafc] overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -right-24 w-64 h-64 bg-secondary rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 lg:py-36 relative z-10">
            <div class="max-w-4xl">
                {{-- Elegant Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green rounded-full mb-6 shadow-sm border border-green/10">
                    <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-widest uppercase">2020 — 2024</span>
                </div>

                {{-- Main headline --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-[#001a6e] tracking-tight leading-[1.1] mb-6">
                    Aktiviti<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green to-[#016b61]">Kami</span>
                </h1>

                {{-- Body text --}}
                <p class="text-lg md:text-xl text-gray-500 max-w-2xl leading-relaxed">
                    Dari program pembangunan profesional hingga aktiviti komuniti, kami komited dalam memartabatkan profesion keguruan di Sabah.
                </p>

                {{-- Accent bar --}}
                <div class="w-20 h-1 bg-gradient-to-r from-[#001a6e] to-green rounded-full mt-10 opacity-70"></div>
            </div>
        </div>
    </div>

    {{-- Activity Categories Filter --}}
    <div class="border-b border-gray-200 bg-white sticky top-0 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-0">
        </div>
    </div>

    {{-- Featured Activity --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-16 md:py-24">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                {{-- Content side --}}
                <div>
                    {{-- Category label --}}
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/10 text-[#001a6e] rounded-full font-mono text-xs tracking-[0.15em] uppercase mb-6 border border-secondary/20">
                        <span class="w-1.5 h-1.5 bg-secondary rounded-full"></span>
                        Featured — 2025
                    </span>

                    {{-- Headline --}}
                    <h2 class="text-4xl md:text-5xl font-extrabold text-[#001a6e] tracking-tight leading-[1.1] mb-6">
                        Manfaat Perlindungan<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green to-[#016b61]">Penyakit Kritikal</span>
                    </h2>

                    {{-- Stats --}}
                    <div class="flex gap-10 mb-8">
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">RM 80k</span>
                            <span class="text-sm text-gray-400 tracking-wide">Pampasan</span>
                        </div>
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">Telupid</span>
                            <span class="text-sm text-gray-400 tracking-wide">Daerah</span>
                        </div>
                        <div class="text-center">
                            <span class="font-mono text-3xl font-bold text-[#001a6e] block">2025</span>
                            <span class="text-sm text-gray-400 tracking-wide">Tahun</span>
                        </div>
                    </div>

                    <p class="text-gray-500 leading-relaxed mb-8 max-w-lg">
                        Penyerahan tuntutan manfaat penyakit kritikal kepada Encik Nur Arif Shah bin Ramli di SK Pekan Telupid. Bantuan ini bertujuan untuk menyokong kos rawatan dan keperluan perubatan beliau bagi mengharungi fasa pemulihan.
                    </p>

                    <a href="#" class="group relative inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#001a6e] hover:bg-[#000d36] text-white font-bold rounded-2xl shadow-[0_8px_20px_rgba(0,26,110,0.25)] hover:shadow-[0_12px_28px_rgba(0,26,110,0.35)] transition-all duration-300 transform hover:-translate-y-0.5 uppercase tracking-wider text-sm border border-white/10">
                        <span>Lihat Butiran</span>
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                {{-- Image side --}}
                <div class="relative overflow-hidden rounded-3xl aspect-[4/3] lg:aspect-square shadow-[0_20px_60px_-15px_rgba(0,26,110,0.15)] border border-gray-100">
                    <img src="{{ asset('images/activity3.png') }}"
                         alt="Manfaat Perlindungan Penyakit Kritikal"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    {{-- Accent top border --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-[#001a6e] via-secondary to-green"></div>
                    {{-- Featured badge overlay --}}
                    <span class="absolute top-4 left-4 bg-[#001a6e] text-secondary font-mono text-xs px-3 py-1.5 uppercase tracking-wider rounded-full shadow-lg">Featured</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Activity Grid --}}
    <div class="bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28">
            {{-- Section header --}}
            <div class="flex items-center gap-6 mb-14">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green rounded-lg mb-3">
                        <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                        <span class="text-xs font-bold tracking-wider uppercase">Semua Aktiviti</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Aktiviti Terkini</h2>
                </div>
                <div class="flex-1 h-px bg-gray-200 hidden md:block"></div>
                <span class="font-mono text-sm text-gray-400 hidden md:block">2024</span>
            </div>

            {{-- Grid --}}
            <div id="activity-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                {{-- Activity Card 1 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/aktiviti1.png') }}" 
                             alt="Penyerahan Pampasan Kematian Ahli KGS" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">28 NOV 2023</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Pampasan<br>Kematian Ahli KGS
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SK Karamunting, Sandakan • RM 10,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan pampasan kepada Che Farhani binti Che Jaffar, waris kepada Allahyarham Zulkifli Ahmad bin Jusoh sebagai tanda keprihatinan dan bantuan kebajikan ahli Kesatuan Guru-Guru Sabah (KGS).
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 2 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity2.png') }}" 
                             alt="Penyerahan Pampasan Kematian Anak Ahli" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">27 SEPT 2025</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Pampasan<br>Kematian Anak Ahli
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SMK Kelana Putra Lenggeng • RM 40,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan pampasan kepada Norfazila binti Md Lajin atas pemergian anakanda tercinta, Abdul Fattah bin Khairol. Sumbangan ini diharap dapat meringankan beban keluarga dalam menghadapi dugaan ini.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>



                {{-- Activity Card 4 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity4.png') }}" 
                             alt="Penyerahan Tuntutan Penyakit Kritikal" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">12 JUN 2024</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-blue-600 font-semibold mb-3 bg-blue-50 px-2 py-0.5 rounded-md w-fit font-mono">KESIHATAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Tuntutan<br>Penyakit Kritikal
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SK Kolapis, Beluran • RM 60,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Tuntutan manfaat penyakit kritikal yang berjaya diproses dan diserahkan kepada Puan Rohayu binti Kandar. Program perlindungan ini merupakan komitmen kesatuan dalam menjaga kebajikan kesihatan setiap ahli.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 5 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity5.png') }}" 
                             alt="Penyerahan Pampasan Kematian Ahli KGS" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">03 MAC 2022</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Pampasan<br>Kematian Ahli KGS
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SK Kinabutan Besar, Tawau • RM 64,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan pampasan kepada waris, Encik Muhamad Solihin bin Ishak, susulan pemergian Puan Aishah binti Sayude. Sumbangan ini merangkumi pampasan asas dan manfaat tambahan ahli.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 6 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity6.png') }}" 
                             alt="Penyampaian Faedah Skim Insurans KGS" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">28 OGOS 2018</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyampaian Faedah<br>Skim Insurans KGS
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SK Kem Tentera, Sandakan • RM 42,083.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan manfaat insurans kepada Encik Endrah bin Ahmad, suami kepada Allahyarhamah Jumrah binti Nordin. KGS sentiasa memastikan kebajikan waris ahli terbela melalui skim perlindungan yang disediakan.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 7 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity7.png') }}" 
                             alt="Penyerahan Pampasan Kematian Ahli" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">29 JUN 2021</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Pampasan<br>Kematian Ahli
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SMK Convent St. Cecilia • RM 32,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan pampasan kepada Encik Mohd Hamdan bin Salleh, waris kepada Allahyarhamah Rosnah binti Udin. Bantuan ini merupakan bentuk penghargaan dan sokongan terakhir kesatuan buat ahli dan keluarga.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 8 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity8.png') }}" 
                             alt="Manfaat Perlindungan Takaful Ahli" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">02 NOV 2021</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Manfaat Perlindungan<br>Takaful Ahli
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SMK Muhibbah, Sandakan • RM 62,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan cek pampasan kepada Puan Zaidah binti Abdul Wahab, waris kepada Allahyarham Mohd Zairi bin Mohamed Hassim. Bukti keberkesanan perlindungan takaful yang disertai oleh ahli kesatuan.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Activity Card 9 --}}
                <div class="group bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-xl hover:border-[#001a6e]/20 transition-all duration-500 flex flex-col">
                    <div class="relative h-48 mb-6 overflow-hidden rounded-2xl group-hover:shadow-lg transition-all duration-500">
                        <img src="{{ asset('images/activity9.png') }}" 
                             alt="Penyerahan Bantuan Kebajikan Ahli" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>
                    <div class="font-mono text-xs tracking-[0.15em] text-gray-400 mb-3">08 NOV 2021</div>
                    <span class="inline-block text-xs uppercase tracking-[0.1em] text-green font-semibold mb-3 bg-green-50 px-2 py-0.5 rounded-md w-fit">KEBAJIKAN</span>
                    <h3 class="text-xl font-bold text-[#001a6e] leading-tight mb-3 group-hover:text-green transition-colors duration-300">
                        Penyerahan Bantuan<br>Kebajikan Ahli
                    </h3>
                    <div class="font-mono text-xs text-gray-400 mb-3">SK Rancangan Sungai Manila • RM 32,000.00</div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                        Penyerahan manfaat pampasan kepada Encik Ramlan bin Mohammad Basir susulan pemergian Allahyarhamah Siti Norhadijah binti Musa sebagai tanda setiakawan dan bantuan buat ahli KGS.
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <button class="inline-flex items-center gap-2 text-[#001a6e] hover:text-green text-sm font-bold uppercase tracking-[0.08em] transition-colors duration-300">
                            <span>Butiran</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load More --}}
    <div id="load-more-container" class="bg-[#f8fafc] border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-14 flex justify-center">
            <button id="load-more-btn" class="group relative inline-flex items-center justify-center gap-3 px-10 py-4 bg-white hover:bg-[#001a6e] text-[#001a6e] hover:text-white font-bold rounded-2xl shadow-sm border border-[#001a6e]/20 hover:shadow-[0_8px_25px_rgba(0,26,110,0.25)] transition-all duration-300 transform hover:-translate-y-0.5 uppercase tracking-wider text-sm">
                <span>Muat Lagi Aktiviti</span>
                <svg class="w-4 h-4 rotate-90 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="relative bg-[#001a6e] overflow-hidden">
        {{-- Decorative orbs --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-secondary/5 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-green/10 rounded-full blur-[80px] translate-y-1/3 -translate-x-1/4"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 relative z-10">
            {{-- Section header --}}
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-secondary/10 text-secondary rounded-lg mb-4 border border-secondary/20">
                    <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase">Impak STU</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Kami Dalam Angka</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-8">
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-secondary tracking-tight block mb-2">48</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Tahun Berdiri</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">12k+</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Ahli Berdaftar</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">156</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Aktiviti 2024</p>
                </div>
                <div class="text-center">
                    <span class="text-5xl md:text-6xl font-bold text-white tracking-tight block mb-2">25</span>
                    <p class="text-white/50 uppercase tracking-[0.1em] text-sm">Daerah Liputan</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CTA Section --}}
    <div class="relative bg-[#f8fafc] overflow-hidden">
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-green-100/50 rounded-full blur-[100px] translate-y-1/3 translate-x-1/3"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-16 py-20 md:py-28 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green rounded-lg mb-6 border border-green/10">
                <span class="w-2 h-2 bg-green rounded-full animate-pulse"></span>
                <span class="text-xs font-bold tracking-wider uppercase">Ikuti Kami</span>
            </div>

            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#001a6e] tracking-tight mb-6 max-w-3xl mx-auto">
                Sertai Aktiviti<br>Kami Akan Datang
            </h2>
            <p class="text-gray-500 text-lg mb-10 max-w-xl mx-auto">
                Dapatkan maklumat terkini tentang program dan aktiviti STU terus ke e-mel anda.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Alamat e-mel anda"
                       class="flex-1 h-14 bg-white border border-gray-200 text-gray-900 placeholder-gray-400 px-4 rounded-2xl focus:border-[#001a6e] focus:ring-2 focus:ring-[#001a6e]/20 outline-none transition-all shadow-sm">
                <button class="h-14 px-8 bg-[#001a6e] text-white uppercase tracking-[0.08em] text-sm font-bold rounded-2xl hover:bg-[#000d36] hover:shadow-[0_8px_20px_rgba(0,26,110,0.3)] transition-all duration-300 transform hover:-translate-y-0.5 border border-white/10">
                    Hantar
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grid = document.getElementById('activity-grid');
            if (!grid) return;
            
            const cards = grid.children;
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadMoreContainer = document.getElementById('load-more-container');
            let visibleCount = 6;

            function updateCards() {
                for (let i = 0; i < cards.length; i++) {
                    if (i < visibleCount) {
                        cards[i].classList.remove('hidden');
                        // Optional: Add a simple fade-in effect
                        cards[i].style.opacity = '1';
                    } else {
                        cards[i].classList.add('hidden');
                        cards[i].style.opacity = '0';
                    }
                }
                
                // Hide the entire container if no more cards to show
                if (visibleCount >= cards.length) {
                    loadMoreBtn.classList.add('hidden');
                    loadMoreContainer.classList.add('hidden');
                }
            }

            // Initialize
            updateCards();

            loadMoreBtn.addEventListener('click', function () {
                visibleCount += 6;
                updateCards();
                
                // Slight scroll to the newly loaded content
                const firstNewCard = cards[visibleCount - 6];
                if (firstNewCard) {
                    firstNewCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            });
        });
    </script>
    @endpush
@endsection
