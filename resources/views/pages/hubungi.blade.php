@extends('layouts.app')

@section('title', 'Hubungi Kami | Sabah Teachers Union (STU)')
@section('meta_description', 'Hubungi Sabah Teachers Union (STU) untuk sebarang pertanyaan mengenai keahlian, aduan, atau cadangan. Kami sedia membantu para guru di Sabah.')
@section('meta_keywords', 'Hubungi STU, Alamat STU, Email STU, Lokasi Sabah Teachers Union')

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

<div class="min-h-screen bg-gray-50/50">

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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-0 items-center">

                <div class="flex flex-col items-center text-center">
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <div class="p-2 bg-primary/10 rounded-full text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Alamat Rasmi</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        1ST FLOOR, LOT 5, BLOCK 25,<br>
                        BANDAR INDAH, JALAN UTARA,<br>
                        90000 SANDAKAN SABAH.
                    </p>
                </div>

                <div class="flex flex-col items-center text-center md:border-l border-gray-100">
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <div class="p-2 bg-primary/10 rounded-full text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Telefon</h3>
                    </div>
                    <p class="text-gray-600 mb-1 text-sm">Hubungi kami di talian:</p>
                    <a href="tel:+60196204438" class="text-lg font-bold text-primary hover:text-primary/80 transition-colors">
                        +60 19-620 4438
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12">

            <div class="lg:col-span-5 space-y-8 animate-fade-in-up delay-200">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden h-[400px] lg:h-full min-h-[400px] relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15876.495712165584!2d118.068361!3d5.8385611!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3238d6896f6004b7%3A0x6739f506082490cc!2sBandar%20Indah%2C%2090000%20Sandakan%2C%20Sabah!5e0!3m2!1sen!2smy!4v1713715200000!5m2!1sen!2smy"
                        class="w-full h-full border-0"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <a href="https://www.google.com/maps/search/1ST+FLOOR,+LOT+5,+BLOCK+25,+BANDAR+INDAH,+JALAN+UTARA,+90000+SANDAKAN+SABAH" target="_blank" class="absolute bottom-4 right-4 bg-white px-4 py-2 rounded-lg shadow-lg text-sm font-medium text-gray-900 hover:text-primary transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Buka di Google Maps
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7 animate-fade-in-up delay-300">
                <div class="bg-white rounded-3xl border border-gray-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 md:p-10 lg:p-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Hantar Mesej</h2>

                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-3 animate-fade-in-up">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('hubungi.store') }}" method="POST" class="space-y-6" novalidate>
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Penuh <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="Nama anda" value="{{ old('name') }}">
                                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="ic" class="block text-sm font-medium text-gray-700 mb-2">No. IC <span class="text-red-500">*</span></label>
                                <input type="text" id="ic" name="ic"
                                       class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('ic') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="123456-78-9012" value="{{ old('ic') }}">
                                @error('ic') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. HP <span class="text-red-500">*</span></label>
                                <input type="text" id="phone" name="phone"
                                       class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('phone') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="012-3456789" value="{{ old('phone') }}">
                                @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="school" class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah / Organisasi <span class="text-red-500">*</span></label>
                                <input type="text" id="school" name="school"
                                       class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('school') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                       placeholder="Contoh: SMK Contoh" value="{{ old('school') }}">
                                @error('school') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="text" id="email" name="email"
                                   class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                                   placeholder="email@contoh.com" value="{{ old('email') }}">
                            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Mesej Anda <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="6"
                                      class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('message') ? 'border-red-400' : 'border-gray-200' }} rounded-lg focus:bg-white focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200 resize-none"
                                      placeholder="Tulis mesej anda di sini...">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-theme="light"></div>
                            @error('cf-turnstile-response')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <p class="text-sm text-gray-500 hidden md:block">* Kami akan membalas dalam 3 hari bekerja.</p>
                            <button type="submit"
                                    class="w-full md:w-auto px-8 py-3.5 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                <span>Hantar Mesej</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-8">
                    <div class="bg-blue-50 border border-blue-100 p-6 rounded-2xl flex items-start gap-4">
                        <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Waktu Pejabat</h4>
                            <p class="text-sm text-blue-700 mt-2 leading-relaxed">
                                <span class="font-semibold text-blue-800">Isnin - Jumaat:</span> 9.00 PG - 5.00 PTG<br>
                                <span class="font-semibold text-blue-800">Sabtu, Ahad & Cuti Umum:</span> Tutup
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- Cloudflare Turnstile --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
    // Malaysian IC Auto-Formatter
    // Formats: 123456121212 → 123456-12-1212
    const icInput = document.getElementById('ic');
    if (icInput) {
        icInput.addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, ''); // digits only
            let formatted = '';
            if (val.length > 6) {
                formatted = val.substring(0, 6) + '-';
                if (val.length > 8) {
                    formatted += val.substring(6, 8) + '-' + val.substring(8, 12);
                } else {
                    formatted += val.substring(6, 8);
                }
            } else {
                formatted = val;
            }
            e.target.value = formatted;
        });
    }
</script>
@endpush
