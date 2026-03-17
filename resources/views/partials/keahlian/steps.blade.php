{{-- Cara Sertai STU --}}
<div class="mt-14 anim-up d4">
    <div class="bg-white rounded-3xl border-2 border-gray-200 shadow-lg p-8 md:p-12">

        {{-- Header --}}
        <div class="text-center mb-10">
            <span class="inline-block text-xs font-bold tracking-widest text-primary uppercase bg-primary/10 px-4 py-2 rounded-full mb-4">Mudah &amp; Pantas</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Cara Sertai STU</h2>
            <p class="text-gray-500 mt-2 text-base max-w-xl mx-auto">Ikuti 4 langkah mudah ini untuk menjadi ahli STU dan mula menikmati perlindungan penuh.</p>
        </div>

        {{-- Steps grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            {{-- Step 1: Muat Turun --}}
            <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between mb-5">
                    <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">1</span>
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Muat Turun Borang</h3>
                <p class="text-gray-500 text-sm leading-relaxed flex-1">Dapatkan borang keahlian STU secara dalam talian atau ambil terus di pejabat STU.</p>
                <a href="{{ url('/borang/muat-turun') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary/70 transition-colors">
                    Muat turun sekarang
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Step 2: Isi Borang --}}
            <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between mb-5">
                    <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">2</span>
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Isi Borang</h3>
                <p class="text-gray-500 text-sm leading-relaxed flex-1">Lengkapkan semua maklumat dengan tepat — nombor kad pengenalan, sekolah, dan maklumat peribadi.</p>
                <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-gray-400 select-none">
                    Pastikan maklumat tepat
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
            </div>

            {{-- Step 3: Serahkan Borang --}}
            <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between mb-5">
                    <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">3</span>
                    <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Serahkan Borang</h3>
                <p class="text-gray-500 text-sm leading-relaxed flex-1">Serahkan borang yang lengkap kepada wakil STU di sekolah anda atau hantar terus melalui portal.</p>
                <a href="{{ url('/borang/hantar') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary/70 transition-colors">
                    Hantar dalam talian
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

            {{-- Step 4: Potongan Gaji --}}
            <div class="group flex flex-col bg-gray-50 hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="flex items-center justify-between mb-5">
                    <span class="w-8 h-8 rounded-full bg-emerald-500 text-white text-sm font-bold flex items-center justify-center">4</span>
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="font-bold text-gray-900 text-base mb-2">Potongan Gaji Bermula</h3>
                <p class="text-gray-500 text-sm leading-relaxed flex-1">Setelah diproses, potongan RM14.00 sebulan akan bermula melalui BPA secara automatik.</p>
                <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600">
                    Selesai — anda kini ahli STU
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
            </div>

        </div>

        {{-- Footer: Hubungi Kami --}}
        <div class="border-t border-gray-100 pt-7 flex flex-col sm:flex-row items-center justify-between gap-5">
            <div>
                <p class="text-sm font-semibold text-gray-800 mb-1">Tidak pasti cara mendaftar sendiri?</p>
                <p class="text-sm text-gray-400">Tiada masalah — anda boleh daftar melalui kami. Pasukan STU akan uruskan semua proses pendaftaran untuk anda.</p>
            </div>
            <a href="{{ url('/hubungi') }}" class="flex-shrink-0 inline-flex items-center gap-3 bg-gray-900 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Daftar Melalui Kami
            </a>
        </div>

    </div>
</div>
