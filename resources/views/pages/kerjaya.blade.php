@extends('layouts.app')

@section('title', 'Kerjaya | Sabah Teachers Union (STU)')
@section('meta_description', 'Sertai pasukan Sabah Teachers Union (STU). Lihat peluang kerjaya terkini dan jadilah sebahagian daripada kesatuan guru yang dinamik di Sabah.')
@section('meta_keywords', 'Kerjaya STU, Kerja Guru Sabah, Peluang Kerja STU, Jawatan Kosong STU')

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
            <img src="{{ asset('assets/images/careers_hero_bg.png') }}" 
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

   
    {{-- Application Form --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-3xl shadow-2xl shadow-primary/5 border border-gray-100 overflow-hidden">
            <div class="grid md:grid-cols-5">
                <div class="md:col-span-2 bg-primary p-8 md:p-12 text-white flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Hantar Permohonan</h3>
                        <p class="text-white/80 leading-relaxed mb-8">
                            Berminat untuk menyertai warga Sabah Teachers Union? Sila lengkapkan borang di sebelah dan sertakan resume anda.
                        </p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-white/60">Emel Kami</p>
                                    <p class="font-medium">hr@stu.org.my</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-white/60">Lokasi</p>
                                    <p class="font-medium">Kota Kinabalu, Sabah</p>
                                </div>
                            </div>
                        </div>
                    </div>

       
                </div>

                <div class="md:col-span-3 p-8 md:p-12">
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl animate-fade-in-up">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('kerjaya.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Penuh <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('name') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                    placeholder="Masukkan nama penuh anda" value="{{ old('name') }}">
                                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            {{-- Alamat --}}
                            <div>
                                <label for="alamat" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Menetap <span class="text-red-500">*</span></label>
                                <textarea name="alamat" id="alamat" rows="2"
                                    class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('alamat') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none resize-none"
                                    placeholder="Masukkan alamat penuh anda">{{ old('alamat') }}</textarea>
                                @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">E-mel <span class="text-red-500">*</span></label>
                                    <input type="text" name="email" id="email"
                                        class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('email') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                        placeholder="nama@contoh.com" value="{{ old('email') }}">
                                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>

                                {{-- Phone --}}
                                <div>
                                    <label for="phone" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">No. Telefon <span class="text-red-500">*</span></label>
                                    <input type="text" name="phone" id="phone"
                                        class="w-full px-4 py-3 bg-gray-50 border {{ $errors->has('phone') ? 'border-red-400' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                        placeholder="012-3456789" value="{{ old('phone') }}">
                                    @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            {{-- Resume Upload --}}
                            <div>
                                <label for="resume" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Muat Naik Resume (PDF/DOC) <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="file" name="resume" id="resume"
                                        class="hidden"
                                        accept=".pdf,.doc,.docx"
                                        onchange="document.getElementById('file-name').textContent = this.files[0].name">
                                    <label for="resume" class="flex items-center justify-between w-full px-4 py-3 bg-gray-50 border {{ $errors->has('resume') ? 'border-red-400' : 'border-gray-200' }} rounded-xl cursor-pointer hover:bg-gray-100 transition-colors">
                                        <span id="file-name" class="text-gray-500 italic">Pilih fail...</span>
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    </label>
                                </div>
                                <p class="mt-1 text-[10px] text-gray-400">Format: PDF, DOC atau DOCX. Saiz maksimum: 10MB</p>
                                @error('resume') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            {{-- Message --}}
                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Mesej Tambahan (Pilihan)</label>
                                <textarea name="message" id="message" rows="4"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none resize-none"
                                    placeholder="Beritahu kami sedikit tentang diri anda...">{{ old('message') }}</textarea>
                                @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Cloudflare Turnstile --}}
                        <div>
                            <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-theme="light"></div>
                            @error('cf-turnstile-response')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" 
                                class="w-full py-4 bg-primary hover:bg-primary-dark text-white font-black text-sm uppercase tracking-[0.2em] rounded-xl transition-all duration-300 shadow-lg shadow-primary/20 flex items-center justify-center gap-2 group">
                            Hantar Permohonan
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
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

    // Malaysian IC Auto-Formatter
    const icInput = document.getElementById('ic');
    if (icInput) {
        icInput.addEventListener('input', function (e) {
            let val = e.target.value.replace(/\D/g, '');
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

@endsection
