@extends('layouts.app')

@section('title', 'Log Masuk | Sabah Teachers Union')

@section('content')
<div class="min-h-screen relative flex items-center justify-center py-20 px-4 overflow-hidden bg-primary">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-secondary/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-secondary/10 rounded-full blur-[120px] animate-pulse delay-700"></div>
        <img src="{{ asset('images/stu-logo.webp') }}" alt="" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl opacity-[0.03] pointer-events-none select-none">
    </div>

    <!-- Login Card Container -->
    <div class="relative z-10 w-full max-w-md animate-fade-in-up">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 mb-6 shadow-xl">
                <img src="{{ asset('images/stu-logo.webp') }}" alt="STU Logo" class="w-14 h-14 object-contain">
            </div>
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter mb-2">Portal <span class="text-secondary">Admin</span></h1>
            <p class="text-white/60 text-sm font-medium uppercase tracking-widest">Akses Keamanan Kesatuan</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/50 text-white p-4 rounded-xl mb-6 text-sm backdrop-blur-md">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Glassmorphism Card -->
        <div class="bg-white/10 backdrop-blur-2xl rounded-[2.5rem] p-8 md:p-10 border border-white/20 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)]">
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-xs font-bold text-white/50 uppercase tracking-widest ml-1">Alamat Emel</label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-secondary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required 
                               class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary transition-all"
                               placeholder="nama@stu.org.my">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between px-1">
                        <label for="password" class="block text-xs font-bold text-white/50 uppercase tracking-widest">Kata Laluan</label>
                        <a href="#" class="text-[10px] font-bold text-secondary/60 hover:text-secondary uppercase tracking-wider transition-colors">Lupa?</a>
                    </div>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-secondary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                               class="w-full pl-12 pr-12 py-4 bg-white/5 border border-white/10 rounded-2xl text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:border-secondary transition-all"
                               placeholder="••••••••">
                        <!-- Toggle Password -->
                        <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/30 hover:text-secondary transition-colors">
                            <svg id="eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                               class="w-5 h-5 rounded-lg bg-white/5 border-white/10 text-secondary focus:ring-secondary/50 focus:ring-offset-0 transition-all">
                        <span class="text-xs font-medium text-white/60 group-hover:text-white transition-colors">Ingat Saya</span>
                    </label>
                </div>

                <!-- Cloudflare Turnstile -->
                <div class="px-1">
                    <div class="cf-turnstile" data-sitekey="{{ config('services.cloudflare.site_key') }}" data-theme="dark"></div>
                    @error('cf-turnstile-response')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-4 bg-secondary text-primary font-black rounded-2xl hover:bg-white hover:scale-[1.02] active:scale-95 transition-all duration-300 shadow-xl shadow-secondary/10 flex items-center justify-center gap-2 group uppercase tracking-widest text-sm">
                    Log Masuk
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer Help -->
        <p class="mt-8 text-center text-white/40 text-xs font-medium">
            &copy; 2026 Sabah Teachers Union. <br>
            Sistem Pengurusan Maklumat Bersepadu.
        </p>
    </div>
</div>

@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const toggleBtn = document.getElementById('toggle-password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle Icons
            eyeOpen.classList.toggle('hidden');
            eyeClosed.classList.toggle('hidden');
        });
    });
</script>
@endpush

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }
</style>
@endsection
