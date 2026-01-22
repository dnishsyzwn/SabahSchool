@extends('layouts.app')

@section('title', 'Hubungi Kami | Sabah Teachers Union')

@section('content')

{{-- Reuse the animation styles --}}
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

<div class="min-h-screen bg-gray-50">
    
    <div class="relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1516387938699-a93567ec168e?q=80&w=2071&auto=format&fit=crop" 
                 alt="Contact Background" 
                 class="w-full h-full object-cover opacity-30">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-black/30"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4 drop-shadow-md">
                Hubungi Kami
            </h1>
            <p class="text-lg md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow-sm font-light">
                Sebarang pertanyaan mengenai keahlian, aduan, atau cadangan boleh disalurkan kepada kami.
            </p>
        </div>
    </div>

    <div class="bg-white border-b border-gray-100 animate-fade-in-up delay-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-0 items-center">
                
    <div class="flex flex-col items-center text-center">
        <div class="flex items-center justify-center gap-3 mb-3">
            <div class="p-2 bg-primary/10 rounded-full text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-4xl font-semibold text-gray-900">Alamat Rasmi</h3>
        </div>
        <p class="text-gray-600 leading-relaxed">
            Tingkat 1, Lot No. 5, Blok F,<br>
            Kompleks Sinsuran, Peti Surat 14214,<br>
            88848 Kota Kinabalu, Sabah.
        </p>
    </div>

    <div class="flex flex-col items-center text-center md:border-l md:border-r border-gray-100">
        <div class="flex items-center justify-center gap-3 mb-3">
            <div class="p-2 bg-primary/10 rounded-full text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </div>
            <h3 class="text-4xl font-semibold text-gray-900">Telefon</h3>
        </div>
        <p class="text-gray-600 mb-1">Hubungi kami di talian:</p>
        <a href="tel:088-215768" class="text-xl font-medium text-primary hover:text-primary/80 transition-colors">
            088-215768
        </a>
    </div>

    <div class="flex flex-col items-center text-center">
        <div class="flex items-center justify-center gap-3 mb-3">
            <div class="p-2 bg-primary/10 rounded-full text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-4xl font-semibold text-gray-900">Fax</h3>
        </div>
        <p class="text-gray-600 mb-1">Nombor Fax:</p>
        <p class="text-xl font-medium text-gray-900">
            088-221768
        </p>
    </div>
</div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12">
            
            <div class="lg:col-span-5 space-y-8 animate-fade-in-up delay-200">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-[400px] lg:h-full min-h-[400px] relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3969.043534882143!2d116.07106097587895!3d5.977464994008168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x323b69904d25160f%3A0x6e3263013d314816!2sSinsuran%20Complex%2C%20Pusat%20Bandar%20Kota%20Kinabalu%2C%2088000%20Kota%20Kinabalu%2C%20Sabah!5e0!3m2!1sen!2smy!4v1706692800000!5m2!1sen!2smy" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <a href="https://maps.google.com?q=Kompleks+Sinsuran+Kota+Kinabalu" target="_blank" class="absolute bottom-4 right-4 bg-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium text-gray-900 hover:text-primary transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 animate-fade-in-up delay-300">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 lg:p-10">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Hantar Mesej</h2>
                    
                    <form class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penuh</label>
                                <input type="text" id="name" name="name" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="Nama anda">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" id="email" name="email" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="email@contoh.com">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Perkara / Tajuk</label>
                            <input type="text" id="subject" name="subject" 
                                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                   placeholder="Contoh: Pertanyaan Keahlian">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mesej Anda</label>
                            <textarea id="message" name="message" rows="6" 
                                      class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200 resize-none"
                                      placeholder="Tulis mesej anda di sini..."></textarea>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <p class="text-sm text-gray-500 hidden md:block">* Kami akan membalas dalam 3 hari bekerja.</p>
                            <button type="button" onclick="alert('Mesej anda telah diterima. Kami akan menghubungi anda semula.')" 
                                    class="w-full md:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <span>Hantar Mesej</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="mt-8 grid sm:grid-cols-2 gap-4">
                    <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg flex items-start gap-3">
                        <svg class="w-6 h-6 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <h4 class="font-bold text-blue-900 text-sm">Waktu Pejabat</h4>
                            <p class="text-sm text-blue-700 mt-1">Isnin - Jumaat: 8.00 PG - 5.00 PTG<br>Sabtu - Ahad: Tutup</p>
                        </div>
                    </div>
                    <div class="bg-green-50 border border-green-100 p-4 rounded-lg flex items-start gap-3">
                        <svg class="w-6 h-6 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <div>
                            <h4 class="font-bold text-green-900 text-sm">Unit Keahlian</h4>
                            <p class="text-sm text-green-700 mt-1">Untuk urusan pendaftaran ahli baharu, sila hubungi sambungan 104.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection