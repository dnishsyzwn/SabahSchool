@extends('layouts.app')

@section('title', 'Muat Turun | Sabah Teachers Union')

@section('content')

{{-- 
    Define the animations here to ensure they match the Gallery page. 
    If you already have these in your tailwind.config.js, you can remove this style block.
--}}
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 40px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        opacity: 0; /* Start hidden */
    }

    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
</style>

<div class="min-h-screen bg-white">
    <div class="border-b border-gray-100 animate-fade-in-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Borang Keahlian STU</h1>
                <p class="text-gray-600 mb-6 text-center max-w-lg">Muat turun borang keahlian dan hantar borang yang telah dilengkapkan</p>
                
                <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm animate-fade-in-up delay-100">
                    <div class="flex items-center gap-4">
                        <div>
                            <h3 class="font-medium text-gray-900">BorangKeahlian.pdf</h3>
                            <p class="text-sm text-gray-500">14.8 KB</p>
                        </div>
                        <a href="{{ asset('pdf/BorangKeahlian.pdf') }}" download 
                           class="px-5 py-2 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-colors duration-200 inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Muat Turun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 border-2 border-gray-100 rounded-md shadow-md p-8">
            
            <div class="animate-fade-in-up delay-200">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Hantar Borang Keahlian</h2>
                    <p class="text-gray-600">Isi maklumat dan lampirkan borang yang telah dilengkapkan</p>
                </div>

                <form class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                               placeholder="email@gmail.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Subjek <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="subject" name="subject" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200"
                               placeholder="Permohonan Keahlian Baharu STU">
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                            Lampiran Borang <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-primary transition-colors duration-200">
                                <div class="w-12 h-12 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center text-gray-500">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <div class="space-y-2">
                                    <p class="font-medium text-gray-900">
                                        <span class="text-primary">Klik untuk muat naik</span> borang anda
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        PDF, DOC, DOCX, JPG, PNG (Maksimum 10MB)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="file-preview" class="mt-4 hidden">
                            </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Kandungan Mesej (Pilihan)
                        </label>
                        <textarea id="message" name="message" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-colors duration-200 resize-none"
                                  placeholder="Sila nyatakan maklumat tambahan jika perlu..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="button" onclick="showComingSoon()"
                                class="w-full py-3.5 bg-primary hover:bg-primary/90 text-white font-medium rounded-lg transition-colors duration-200">
                            Hantar Borang Keahlian
                        </button>
                        <p class="text-center text-sm text-gray-500 mt-3">
                            Borang akan diproses dalam masa 3-5 hari bekerja
                        </p>
                    </div>
                </form>
            </div>

            <div class="lg:pl-8 lg:border-l border-gray-200 animate-fade-in-up delay-300">
                <div class="mb-8">
                    <div class="aspect-[4/3] overflow-hidden rounded-lg">
                        <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=2072&auto=format&fit=crop"
                             alt="STU Community"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="mt-4">
                        <h3 class="font-medium text-gray-900 mb-2">Bersama Membina Pendidikan Sabah</h3>
                        <p class="text-sm text-gray-600">Sertai komuniti guru-guru Sabah yang komited terhadap kecemerlangan pendidikan</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <h4 class="font-medium text-gray-900 text-lg">Proses Permohonan</h4>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium mt-0.5 flex-shrink-0">1</div>
                            <div>
                                <p class="font-medium text-gray-900">Muat Turun Borang</p>
                                <p class="text-sm text-gray-600">Klik butang "Muat Turun" untuk dapatkan borang keahlian</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium mt-0.5 flex-shrink-0">2</div>
                            <div>
                                <p class="font-medium text-gray-900">Lengkapkan Borang</p>
                                <p class="text-sm text-gray-600">Isi semua maklumat yang diperlukan dengan lengkap</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-sm font-medium mt-0.5 flex-shrink-0">3</div>
                            <div>
                                <p class="font-medium text-gray-900">Hantar Borang</p>
                                <p class="text-sm text-gray-600">Isi borang di sebelah dan lampirkan borang yang telah dilengkapkan</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // File upload preview functionality
    document.getElementById('file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('file-preview');
        
        if (file) {
            preview.innerHTML = `
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="w-10 h-10 bg-primary/10 rounded flex items-center justify-center text-primary">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 truncate">${file.name}</p>
                        <p class="text-sm text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                    <button type="button" onclick="removeFile()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            `;
            preview.classList.remove('hidden');
        }
    });

    function removeFile() {
        document.getElementById('file').value = '';
        document.getElementById('file-preview').classList.add('hidden');
    }

    function showComingSoon() {
        alert('Fungsi penghantaran sedang dalam penyediaan. Sila cuba lagi nanti.');
    }
</script>
@endpush
@endsection