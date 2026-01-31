@extends('layouts.app')

@section('title', 'Pegawai Pentadbiran | Sabah Teachers Union')

@section('content')

{{-- Standard Header --}}
<div class="relative bg-gray-900 overflow-hidden">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=2070&auto=format&fit=crop" 
             alt="Header Background" 
             class="w-full h-full object-cover opacity-30">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-black/60"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-md">
            Pegawai Pentadbiran
        </h1>
        <div class="flex flex-wrap justify-center gap-4 text-gray-200">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Kota Kinabalu
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Sepenuh Masa
            </span>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    {{-- Back Link --}}
    <div class="mb-8">
        <a href="/kerjaya" class="inline-flex items-center text-gray-600 hover:text-primary transition-colors font-medium">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Senarai Kerjaya
        </a>
    </div>

    <div class="space-y-12">
        
        {{-- Job Description --}}
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-1 h-6 bg-secondary rounded-full"></span>
                Deskripsi Tugas
            </h3>
            <div class="prose max-w-none text-gray-600">
                <p>
                    Kami sedang mencari Pegawai Pentadbiran yang cekap dan bermotivasi tinggi untuk menyertai pasukan kami di Ibu Pejabat Sabah Teachers Union. 
                    Calon akan bertanggungjawab memastikan kelancaran operasi harian pejabat dan memberikan sokongan pentadbiran kepada pengurusan.
                </p>
            </div>
        </div>

        {{-- Responsibilities --}}
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-1 h-6 bg-primary rounded-full"></span>
                Tanggungjawab
            </h3>
            <ul class="space-y-2 text-gray-600 list-disc list-inside ml-2">
                <li>Menguruskan operasi harian pejabat dan surat-menyurat.</li>
                <li>Menyediakan minit mesyuarat dan laporan bulanan.</li>
                <li>Menyelaras jadual temujanji bagi Ahli Majlis Tertinggi.</li>
                <li>Mengemaskini pangkalan data data keahlian.</li>
                <li>Membantu pelaksanaan acara rasmi kesatuan.</li>
            </ul>
        </div>

        {{-- Requirements --}}
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <span class="w-1 h-6 bg-secondary rounded-full"></span>
                Syarat Kelayakan
            </h3>
            <ul class="space-y-2 text-gray-600 list-disc list-inside ml-2">
                <li>Warganegara Malaysia (Keutamaan penduduk Sabah).</li>
                <li>Diploma dalam Pentadbiran/Pengurusan atau berkaitan.</li>
                <li>Minima 2 tahun pengalaman kerja berkaitan.</li>
                <li>Mahir Microsoft Office (Word, Excel, PowerPoint).</li>
                <li>Komunikasi baik dalam Bahasa Melayu & Inggeris.</li>
            </ul>
        </div>

        <hr class="border-primary">

        {{-- Application Form --}}
        <div id="mohon" class="bg-gray-50 rounded-xl p-8 border border-gray-300">
            <h3 class="text-xl font-bold text-gray-900 mb-6">Borang Permohonan</h3>
            
            <form class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Penuh</label>
                        <input type="text" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200" placeholder="Nama penuh anda">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. Telefon</label>
                        <input type="tel" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200" placeholder="Contoh: 012-3456789">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Emel</label>
                    <input type="email" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200" placeholder="email@contoh.com">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Resume (PDF)</label>
                    <input type="file" accept=".pdf" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mesej (Pilihan)</label>
                    <textarea rows="4" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200 resize-none" placeholder="Kenyataan ringkas mengenai anda..."></textarea>
                </div>

                <div class="pt-2">
                    <button type="button" onclick="alert('Permohonan dihantar!')" class="w-full md:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                        <span>Hantar Permohonan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-xs text-gray-500 mt-4">
                        Dokumen anda adalah sulit dan privasi anda terjamin.
                    </p>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
