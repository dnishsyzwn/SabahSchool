@extends('layouts.app')

@section('title', 'Kerjaya | Sabah Teachers Union')

@section('content')

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate3d(0, 40px, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>

<div class="min-h-screen bg-gray-50/50">
    
    {{-- Hero Header (Similar to Hubungi Kami) --}}
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1522071823991-b9671f9d7f1f?q=80&w=2070&auto=format&fit=crop" 
                 alt="Careers Background" 
                 class="w-full h-full object-cover opacity-40">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/50"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-md">
                Sertai Pasukan Kami
            </h1>
            <p class="text-lg md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow-sm font-light">
                Bina kerjaya anda bersama Sabah Teachers Union dan menyumbang kepada komuniti pendidikan di Sabah.
            </p>
        </div>
    </div>

    {{-- Stats/Intro Section --}}
    <div class="max-w-7xl mt-8 mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 p-8 md:p-12 border border-gray-100">
            <div class="grid md:grid-cols-3 gap-12 items-center">
                <div class="space-y-3 text-center md:text-left">
                    <h2 class="text-3xl font-bold text-gray-900">Peluang Kini Dibuka</h2>
                    <p class="text-gray-500 leading-relaxed">Kami mencari individu yang berdedikasi, inovatif dan mempunyai semangat untuk berkhidmat dalam memperkasakan pendidikan Sabah.</p>
                </div>
                <div class="flex flex-col items-center justify-center p-8 bg-primary/5 rounded-2xl border border-primary/10 group transition-all duration-300 hover:bg-primary/10">
                    <div class="flex items-baseline gap-1">
                        <span id="counter-members" class="text-5xl font-black text-primary mb-1" data-target="20000">0</span>
                        <span class="text-3xl font-bold text-primary">+</span>
                    </div>
                    <span class="text-gray-600 font-semibold text-sm uppercase tracking-wider">Ahli Aktif</span>
                </div>
                <div class="flex flex-col items-center justify-center p-8 bg-primary/5 rounded-2xl border border-primary/10 group transition-all duration-300 hover:bg-primary/10">
                    <span id="counter-branches" class="text-5xl font-black text-primary mb-1" data-target="11">0</span>
                    <span class="text-gray-600 font-semibold text-sm uppercase tracking-wider">Cawangan Bahagian</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Jobs Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Kekosongan Jawatan</h3>
                <p class="text-gray-600 text-lg italic">Klik pada jawatan untuk maklumat lanjut permohonan.</p>
            </div>
            <div class="flex items-center gap-2 text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-full border border-gray-200">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                Kemas kini: {{ date('d M Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $jobs = [
                    [
                        'title' => 'Pegawai Pentadbiran',
                        'location' => 'Kota Kinabalu (Ibu Pejabat)',
                        'type' => 'Sepenuh Masa',
                        'salary' => 'RM 2,500 - RM 3,500',
                        'deadline' => '15 Feb 2026',
                        'icon_bg' => 'bg-blue-100 text-blue-600',
                        'desc' => 'Menguruskan operasi harian pejabat, dokumentasi kesatuan, dan penyelarasan program ahli.'
                    ],
                    [
                        'title' => 'Kerani Kewangan',
                        'location' => 'Kota Kinabalu',
                        'type' => 'Sepenuh Masa',
                        'salary' => 'RM 1,800 - RM 2,400',
                        'deadline' => '20 Feb 2026',
                        'icon_bg' => 'bg-blue-100 text-blue-600',
                        'desc' => 'Mengendalikan transaksi kewangan, tuntutan keahlian, dan penyediaan laporan bulanan.'
                    ],
                    [
                        'title' => 'Pembantu Operasi',
                        'location' => 'Sandakan (Pejabat Cawangan)',
                        'type' => 'Kontrak',
                        'salary' => 'RM 1,500 - RM 1,900',
                        'deadline' => '10 Feb 2026',
                        'icon_bg' => 'bg-blue-100 text-blue-600',
                        'desc' => 'Menyokong aktiviti cawangan, pengedaran borang, dan urusan logistik acara kesatuan.'
                    ],
                    [
                        'title' => 'Eksekutif Komunikasi & Media',
                        'location' => 'Kota Kinabalu',
                        'type' => 'Sepenuh Masa',
                        'salary' => 'RM 2,800 - RM 4,000',
                        'deadline' => '28 Feb 2026',
                        'icon_bg' => 'bg-blue-100 text-blue-600',
                        'desc' => 'Menguruskan media sosial STU, bulletin bulanan, dan hubungan media luar.'
                    ],
                    [
                        'title' => 'Penyelaras Pendidikan',
                        'location' => 'Tawau',
                        'type' => 'Sepenuh Masa',
                        'salary' => 'RM 2,800 - RM 4,000',
                        'deadline' => '05 Mac 2026',
                        'icon_bg' => 'bg-blue-100 text-blue-600',
                        'desc' => 'Merangka program pembangunan profesional untuk guru-guru ahli di kawasan pantai timur.'
                    ],
                ];
            @endphp

            @foreach($jobs as $index => $job)
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden animate-fade-in-up" style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                    <div class="p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-12 h-12 {{ $job['icon_bg'] }} rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full uppercase tracking-wider">
                                {{ $job['type'] }}
                            </span>
                        </div>

                        <h4 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-primary transition-colors italic">
                            {{ $job['title'] }}
                        </h4>

                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $job['location'] }}
                        </div>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ $job['desc'] }}
                        </p>

                        <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">Gaji Tawaran</p>
                                <p class="text-sm font-bold text-gray-900">{{ $job['salary'] }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">Tarikh Tutup</p>
                                <p class="text-sm font-medium text-red-500">{{ $job['deadline'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="/kerjaya/detail" 
                            class="w-full py-4 bg-gray-50 hover:bg-primary hover:text-white text-gray-600 font-bold text-sm transition-all duration-300 border-t border-gray-100 flex items-center justify-center gap-2">
                        Mohon Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                </div>
            @endforeach
        </div>

        {{-- Application Info --}}
        <div class="mt-20 bg-primary/5 rounded-3xl p-8 md:p-12 border border-primary/10 animate-fade-in-up delay-400">
            <div class="max-w-3xl">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 italic">Prosedur Permohonan</h2>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <p>Calon yang berminat dinasihatkan untuk menghantar dokumen-dokumen berikut melalui email ke <span class="font-bold text-primary underline">info@stu.org</span>:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Resume / Curriculum Vitae (CV) yang terkini.</li>
                        <li>Salinan Sijil Akademik (SPM/Diploma/Ijazah).</li>
                        <li>Salinan Kad Pengenalan.</li>
                        <li>Gambar bersaiz passport (Softcopy).</li>
                    </ul>
                    <p class="mt-6 p-4 bg-white/50 rounded-lg text-sm border-2 border-secondary">
                        Hanya calon yang disenarai pendek (shortlisted) sahaja akan dipanggil untuk sesi temuduga di Ibu Pejabat STU, Kota Kinabalu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function animateCounter(id, target, duration) {
        let startTimestamp = null;
        const element = document.getElementById(id);
        
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const currentCount = Math.floor(progress * target);
            
            // Format number with commas for the large membership count
            element.innerText = currentCount.toLocaleString();
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        
        window.requestAnimationFrame(step);
    }

    // Intersection Observer to start animation when visible
    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const membersElem = document.getElementById('counter-members');
                const branchesElem = document.getElementById('counter-branches');
                
                animateCounter('counter-members', membersElem.getAttribute('data-target'), 2000);
                animateCounter('counter-branches', branchesElem.getAttribute('data-target'), 1500);
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const statsSection = document.querySelector('.bg-white.rounded-2xl.shadow-xl');
    if (statsSection) {
        observer.observe(statsSection);
    }
</script>
@endpush

@endsection
