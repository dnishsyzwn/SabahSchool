@extends('layouts.app')

@section('title', 'Bukti Tuntutan – Sabah Teachers Union')

@section('content')
    <section class="relative bg-slate-900 py-32 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-20 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 -right-24 w-64 h-64 bg-secondary rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center text-white">
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-gray-400">
                    <li><a href="/" class="hover:text-white transition-colors">Utama</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-secondary font-semibold">Bukti Tuntutan</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight">
                Jejak <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">Kejayaan</span> Kami
            </h1>
            <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Visualisasi komitmen Sabah Teachers' Union dalam memperjuangkan kebajikan ahli dan masyarakat setempat melalui tindakan nyata.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-4">

            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 h-[90%] w-0.5 bg-gradient-to-b from-primary/20 via-primary/10 to-transparent mt-10"></div>

            <div class="space-y-16 lg:space-y-32">
                @php
                    $items = [
                        [
                            'title' => 'Sumbangan Makanan Semasa Banjir',
                            'tag' => 'Bencana',
                            'desc' => '100 keluarga menerima pek bantuan makanan asas ketika banjir besar di Pantai Barat.',
                            'img' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c',
                            'date' => '15 Feb 2026'
                        ],
                        [
                            'title' => 'Alat Tulis Untuk Murid',
                            'tag' => 'Pendidikan',
                            'desc' => '300 murid mendapat set alat tulis lengkap untuk sesi persekolahan 2026.',
                            'img' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b',
                            'date' => '10 Jan 2026'
                        ],
                        [
                            'title' => 'Dana Perubatan Guru',
                            'tag' => 'Kebajikan',
                            'desc' => 'Tabung khas dibuka untuk membiayai rawatan guru yang menghidap sakit kronik.',
                            'img' => 'https://images.unsplash.com/photo-1505751172107-573967a4f22a',
                            'date' => '05 Mar 2026'
                        ],
                        [
                            'title' => 'Bantuan COVID-19',
                            'tag' => 'Kesihatan',
                            'desc' => '1,420 pek kebersihan diagihkan kepada komuniti sekolah di kawasan zon merah.',
                            'img' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a',
                            'date' => '20 Jul 2025'
                        ],
                    ];
                @endphp

                @foreach($items as $index => $it)
                @php $isEven = $index % 2 === 0; @endphp

                <div class="relative flex flex-col lg:flex-row items-center group @if($index >= 5) hidden extra-item @endif">
                    <div class="hidden lg:flex absolute left-1/2 transform -translate-x-1/2 w-10 h-10 rounded-full bg-white border-4 border-primary z-10 items-center justify-center group-hover:scale-125 transition-transform duration-300">
                        <div class="w-2 h-2 bg-primary rounded-full"></div>
                    </div>

                    <div class="w-full lg:w-1/2 {{ $isEven ? 'lg:pr-24 text-right' : 'lg:pl-24 lg:order-last text-left' }}">
                        <div class="transition-all duration-500 transform group-hover:translate-y-[-5px]">
                            <span class="inline-block px-4 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-4">
                                {{ $it['tag'] }}
                            </span>
                            <p class="text-sm font-medium text-gray-400 mb-2">{{ $it['date'] }}</p>
                            <h3 class="text-3xl font-bold text-slate-900 mb-4 group-hover:text-primary transition-colors">
                                {{ $it['title'] }}
                            </h3>
                            <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                {{ $it['desc'] }}
                            </p>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 mt-8 lg:mt-0 {{ $isEven ? 'lg:pl-24' : 'lg:pr-24' }}">
                        <div class="relative overflow-hidden rounded-[2rem] shadow-2xl group-hover:shadow-primary/20 transition-all duration-500">
                            <div class="absolute inset-0 bg-primary/5 group-hover:bg-transparent transition-colors duration-300 z-10"></div>
                            <img src="{{ $it['img'] }}?auto=format&fit=crop&w=1000&q=80"
                                 alt="{{ $it['title'] }}"
                                 class="w-full h-[400px] object-cover scale-105 group-hover:scale-100 transition-transform duration-700">

                            <div class="absolute bottom-6 left-6 z-20 bg-white/95 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center space-x-2">
                                <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                <p class="text-slate-900 font-bold text-sm">Projek Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @if(count($items) > 5)
                    <div class="flex justify-center mt-6">
                        <button id="show-more" class="px-6 py-2 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition">
                            Tunjukkan lebih lagi
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div class="max-w-xl">
                    <h2 class="text-3xl font-bold text-slate-900 mb-4">Sumbangan Aktiviti Komuniti</h2>
                    <p class="text-gray-600">Inisiatif harian dan bantuan segera yang disalurkan oleh cawangan STU di seluruh negeri Sabah.</p>
                </div>
                <div class="mt-6 md:mt-0">
                    <span class="inline-flex items-center px-4 py-2 rounded-xl bg-white text-primary text-sm font-bold shadow-sm border border-gray-100">
                        <span class="w-2 h-2 bg-primary rounded-full animate-ping mr-3"></span>
                        Kemaskini Terkini
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    // In your final app, this array would be replaced by:
                    // $smallItems = \App\Models\Contribution::where('is_active', true)->latest()->get();
                    $smallItems = [
                        ['title' => 'Bakul Makanan Bersasar', 'location' => 'Kota Belud', 'img' => 'https://images.unsplash.com/photo-1593113598332-cd288d649433', 'label' => 'Kebajikan'],
                        ['title' => 'Voucher Alat Tulis', 'location' => 'Sandakan', 'img' => 'https://images.unsplash.com/photo-1454165833767-027ffea3e678', 'label' => 'Pendidikan'],
                        ['title' => 'Ziarah Kasih Pesara', 'location' => 'Kudat', 'img' => 'https://images.unsplash.com/photo-1516307361474-3324182441d8', 'label' => 'Ziarah'],
                        ['title' => 'Bantuan Kecemasan Kilat', 'location' => 'Beaufort', 'img' => 'https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7', 'label' => 'Kesihatan'],
                    ];
                @endphp

                @foreach($smallItems as $item)
                <div class="group relative bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $item['img'] }}?auto=format&fit=crop&w=600&q=80"
                             alt="{{ $item['title'] }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-70 group-hover:opacity-85 transition-opacity"></div>

                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-secondary mb-2 block">
                            {{ $item['label'] }}
                        </span>
                        <h4 class="text-white font-bold text-lg leading-tight mb-1">
                            {{ $item['title'] }}
                        </h4>
                        <div class="flex items-center text-gray-300 text-xs">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $item['location'] }}
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- add contribution placeholder after items --}}
                <div class="border-2 border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center p-8 min-h-[250px] group hover:border-primary/50 transition-colors cursor-pointer bg-white/50">
                    <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mb-4 group-hover:bg-primary/10 transition-colors">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <p class="text-gray-400 font-bold text-sm text-center uppercase tracking-wider">Tambah Rekod<br>Sumbangan</p>
                </div>
            </div>
                </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-br from-primary via-primary to-blue-800 rounded-[3rem] p-12 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-bold mb-6 tracking-tight">Perlukan maklumat lanjut?</h2>
                    <p class="text-blue-100 mb-10 max-w-xl mx-auto text-lg opacity-90">
                        Sumbangan dan maklum balas anda sangat penting bagi kami untuk terus membela nasib warga pendidik di Sabah.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ url('/hubungi') }}" class="bg-secondary text-primary px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white transition-transform transition-colors duration-300 transform hover:scale-105 shadow-lg">
                            Hubungi Kami
                        </a>
                        <a href="{{ url('/mengenai-stu') }}" class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white/20 transition-transform transition-colors duration-300 transform hover:scale-105">
                            Lihat Profil STU
                        </a>
                    </div>
                </div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -top-12 -right-12 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });

        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('show-more');
            if (!btn) return;
            btn.addEventListener('click', function () {
                // reveal next batch of up to 5 hidden extras
                const hiddenItems = Array.from(document.querySelectorAll('.extra-item.hidden'));
                hiddenItems.slice(0, 5).forEach(el => el.classList.remove('hidden'));

                // if no more remain, remove the button
                if (hiddenItems.length <= 5) {
                    btn.remove();
                }
            });
        });
    </script>
@endpush
