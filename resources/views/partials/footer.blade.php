<footer class="bg-primary/95 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-8">
            <!-- Column 1: Info -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/stu-logo.png') }}" alt="STU Logo" class="h-16 w-auto " onerror="this.src='https://placehold.co/60?text=LOGO'">
                    <div>
                        <h2 class="font-bold text-lg leading-tight uppercase">Sabah Teachers' Union</h2>
                        <p class="text-xs opacity-80 mt-1 uppercase tracking-wider">(STU)</p>
                    </div>
                </div>
                <p class="text-sm opacity-80 leading-relaxed">
                    STU sebagai sebuah kesatuan pembela guru dan pembela profesion perguruan, sentiasa prihatin terhadap perkhidmatan para guru, perhubungan kerjaya, keistimewaan khas serta perkara-perkara lain yang berkaitan dengan profesion perguruan.
                </p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="lg:pl-8">
                <h3 class="text-xl font-bold mb-6 relative inline-block">
                    Pautan Pantas
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-secondary rounded-full"></span>
                </h3>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> HOME</a></li>
                    <li><a href="#" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> PROFIL STU</a></li>
                    <li><a href="{{ url('/aktiviti-kami') }}" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> AKTIVITI KAMI</a></li>
                    <li><a href="#" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> MUAT TURUN</a></li>
                    <li><a href="#" class="text-sm opacity-80 hover:opacity-100 hover:text-secondary transition-all duration-300 flex items-center group"><span class="w-0 group-hover:w-3 overflow-hidden transition-all duration-300 mr-0 group-hover:mr-2 text-secondary">→</span> HUBUNGI KAMI</a></li>
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
                        <p class="text-sm opacity-80 group-hover:opacity-100 transition-all duration-300">+60 88-721 123</p>
                    </div>
                    <div class="flex items-center space-x-4 group">
                        <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0 group-hover:bg-secondary group-hover:text-primary transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-sm opacity-80 group-hover:opacity-100 transition-all duration-300">info@stu.org.my</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-sm opacity-60">
            <p>© {{ date('Y') }} Sabah Teachers' Union (STU). Hak Cipta Terpelihara.</p>
        </div>
    </div>
</footer>

