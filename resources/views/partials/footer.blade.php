<footer class="bg-primary/95 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-8">
            <!-- Column 1: Info -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/stu-logo.png') }}" alt="STU Logo" width="64" height="64" class="h-16 w-auto " onerror="this.src='https://placehold.co/64?text=LOGO'">
                    <div>
                        <div class="font-black text-xl leading-tight uppercase tracking-tighter">Sabah Teachers' Union</div>
                        <p class="text-[10px] opacity-60 mt-1 uppercase tracking-widest font-bold">Peneraju Profesion Keguruan Sabah</p>
                    </div>
                </div>
                <p class="text-sm opacity-80 leading-relaxed">
                    STU sebagai sebuah kesatuan pembela guru dan pembela profesion perguruan, sentiasa prihatin terhadap perkhidmatan para guru, perhubungan kerjaya, keistimewaan khas serta perkara-perkara lain yang berkaitan dengan profesion perguruan.
                </p>
                <div class="pt-2">
                    <a href="https://www.facebook.com/stu.sabah/" target="_blank" class="inline-flex items-center gap-2 text-sm font-bold text-white/90 hover:text-secondary transition-colors group">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center group-hover:bg-[#1877F2] transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </div>
                        Ikuti kami di Facebook
                    </a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="lg:pl-8">
                <h3 class="text-xl font-bold mb-6 relative inline-block">
                    Pautan Pantas
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-secondary rounded-full"></span>
                </h3>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> LAMAN UTAMA</a></li>
                    <li><a href="{{ url('/mengenai-stu') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> MENGENAI KAMI</a></li>
                    <li><a href="{{ url('/aktiviti-kami') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> GALERI AKTIVITI</a></li>
                    <li><a href="{{ url('/borang/muat-turun') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> PUSAT DOKUMEN</a></li>
                    <li><a href="{{ url('/hubungi') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> HUBUNGI STU</a></li>
                </ul>
            </div>

            <!-- Column 3: Contact Info -->
            <div class="space-y-6">
                <h3 class="text-xl font-bold mb-6 relative inline-block">
                    Hubungi Kami
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-secondary rounded-full"></span>
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4 group">
                        <div class="mt-1 w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-sm opacity-80 leading-relaxed group-hover:opacity-100 transition-all duration-300">
                            1ST FLOOR, LOT 5, BLOCK 25, <br>
                            BANDAR INDAH, JALAN UTARA, <br>
                            90000 SANDAKAN SABAH.
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <p class="text-sm opacity-80 group-hover:opacity-100 transition-all duration-300">+6016 663 6752</p>
                    </div>
                    <div class="flex items-center space-x-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-sm opacity-80 group-hover:opacity-100 transition-all duration-300">admin@sabahteachersunion.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-sm opacity-60">© {{ date('Y') }} Sabah Teachers' Union (STU). Hak Cipta Terpelihara.</p>
            
            <!-- Social Share Options -->
            <div class="flex items-center gap-4">
                <span class="text-[10px] font-bold uppercase tracking-widest opacity-40">Kongsi:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#1877F2] transition-colors group" aria-label="Kongsi di Facebook" title="Kongsi di Facebook">
                    <svg class="w-4 h-4 opacity-60 group-hover:opacity-100" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode('Sabah Teachers Union (STU)') }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#1DA1F2] transition-colors group" aria-label="Kongsi di Twitter" title="Kongsi di Twitter">
                    <svg class="w-4 h-4 opacity-60 group-hover:opacity-100" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode('Sabah Teachers Union (STU): ' . url()->current()) }}" target="_blank" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#25D366] transition-colors group" aria-label="Kongsi di WhatsApp" title="Kongsi di WhatsApp">
                    <svg class="w-4 h-4 opacity-60 group-hover:opacity-100" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>

