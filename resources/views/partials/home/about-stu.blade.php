<section class="py-16 bg-white overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <!-- Left Side: Interactive Image Gallery -->
            <div id="stu-gallery" class="w-full lg:w-1/2 flex flex-col lg:flex-row gap-3 h-[600px] lg:h-[500px] overflow-hidden group/gallery">
                <!-- Image 1 -->
                <div class="gallery-item flex-[4] transition-all duration-500 ease-in-out cursor-pointer overflow-hidden rounded-2xl shadow-xl active">
                    <img src="https://images.unsplash.com/photo-1544531585-9847b68c8c86?q=80&w=2070&auto=format&fit=crop" 
                         alt="STU Committee" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Image 2 -->
                <div class="gallery-item flex-1 transition-all duration-500 ease-in-out cursor-pointer overflow-hidden rounded-2xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=2070&auto=format&fit=crop" 
                         alt="Teaching in Sabah" 
                         class="w-full h-full object-cover">
                </div>
                <!-- Image 3 -->
                <div class="gallery-item flex-1 transition-all duration-500 ease-in-out cursor-pointer overflow-hidden rounded-2xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=2070&auto=format&fit=crop" 
                         alt="Meeting" 
                         class="w-full h-full object-cover">
                </div>
            </div>


            <!-- Right Side: Content -->
            <div class="w-full lg:w-1/2">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green rounded-lg mb-6">
                    <img src="{{ asset('images/stu-logo.png') }}" class="w-5 h-5" alt="Icon">
                    <span class="text-sm font-bold tracking-wider uppercase">Mengenai STU</span>
                </div>
                
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-8" data-animate="split-text">
                    Sabah Teacher's Union (STU)
                </h2>

                <p class="text-lg text-gray-600 leading-relaxed mb-10" data-animate="split-text">
                    Sabah Teacher's Union (STU) yang ditubuhkan pada 1967 berperanan untuk memaju, memelihara dan meningkatkan kepentingan sosial warga pendidik yang berkaitan dengan perkhidmatan perguruan dan sentiasa menjalinkan hubungan, perbincangan, perundingan dengan pihak Kementerian Pendidikan Malaysia (KPM) serta NGO yang lain.
                </p>

                <a href="#" class="inline-block px-8 py-4 bg-green hover:bg-primary/90 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-primary/20 uppercase tracking-wide">
                    Maklumat Seterusnya
                </a>
            </div>
        </div>
    </div>
</section>
