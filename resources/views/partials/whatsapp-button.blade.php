<div class="fixed bottom-8 right-8 z-[9999] flex flex-col items-end gap-3">
    <!-- Friendly Greeting (Floating Above) -->
    <div x-data="{ show: false }" 
         x-init="setTimeout(() => show = true, 2000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="hidden md:flex bg-white/90 backdrop-blur-md px-4 py-2.5 rounded-2xl shadow-2xl border border-gray-100 text-slate-700 text-xs font-bold items-center gap-2 animate-bounce-slow">
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
        </span>
        Boleh saya bantu anda?
    </div>

    <!-- Main Button Group -->
    <div class="group flex items-center gap-3">
        <!-- Professional Label (Expands on Hover) -->
        <div class="max-w-0 overflow-hidden group-hover:max-w-xs transition-all duration-500 ease-in-out">
            <div class="bg-[#001a6e] text-white px-5 py-2.5 rounded-2xl shadow-xl whitespace-nowrap text-xs font-black uppercase tracking-widest">
                Sembang WhatsApp
            </div>
        </div>

        <!-- Floating Button -->
        <a href="https://wa.me/60196204438?text=Boleh%20saya%20tanya%20berkaitan%20STU?" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="relative flex items-center justify-center w-16 h-16 bg-[#25D366] text-white rounded-full shadow-[0_10px_40px_rgba(37,211,102,0.4)] hover:shadow-[0_20px_50px_rgba(37,211,102,0.6)] hover:scale-110 active:scale-95 transition-all duration-500 group-hover:rotate-12">
            
            <!-- Ripple Effect -->
            <div class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-20 group-hover:opacity-40"></div>
            
            <!-- WhatsApp Icon -->
            <svg class="w-8 h-8 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .018 5.394 0 12.03a11.854 11.854 0 001.577 5.914L0 24l6.117-1.605a11.845 11.845 0 005.932 1.577h.005c6.632 0 12.028-5.391 12.036-12.031A11.811 11.811 0 0020.464 3.488"/>
            </svg>
        </a>
    </div>
</div>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }
</style>
