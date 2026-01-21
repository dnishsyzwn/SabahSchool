@extends('layouts.app')

@section('title', 'Welcome | Sabah Teachers Union')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="relative z-10">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block text-primary">Sabah Teachers Union</span>
                        <span class="block text-gray-900 mt-2 text-3xl sm:text-4xl">Building a Brighter Future Together</span>
                    </h1>
                    <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-500">
                        Join the most dedicated community of educators in Sabah. We advocate for excellence, unity, and the professional growth of all members.
                    </p>
                    <div class="mt-10 flex justify-center gap-4">
                        <a href="#" class="px-8 py-3 bg-primary text-secondary rounded-xl font-bold shadow-lg shadow-primary/20 hover:bg-opacity-90 transition duration-150">
                            Join Now
                        </a>
                        <a href="#" class="px-8 py-3 bg-white text-primary border border-primary/20 rounded-xl font-bold hover:bg-secondary/20 transition duration-150">
                            Learn More
                        </a>
                    </div>
                </div>
                
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-secondary/30 rounded-full blur-3xl opacity-50"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-primary/10 rounded-full blur-3xl opacity-50"></div>
            </div>

            <!-- Features Section -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-50 hover:border-primary/10 transition duration-150">
                    <div class="w-12 h-12 bg-secondary/50 rounded-xl flex items-center justify-center mx-auto text-primary mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Member Advocacy</h3>
                    <p class="mt-3 text-gray-600">Protecting the rights and interests of teachers across the region.</p>
                </div>
                <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-50 hover:border-primary/10 transition duration-150">
                    <div class="w-12 h-12 bg-secondary/50 rounded-xl flex items-center justify-center mx-auto text-primary mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Unity & Support</h3>
                    <p class="mt-3 text-gray-600">Providing a strong network of support for all education professionals.</p>
                </div>
                <div class="p-8 bg-white rounded-2xl shadow-sm border border-gray-50 hover:border-primary/10 transition duration-150">
                    <div class="w-12 h-12 bg-secondary/50 rounded-xl flex items-center justify-center mx-auto text-primary mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Excellence</h3>
                    <p class="mt-3 text-gray-600">Striving for the highest standards in education and leadership.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
