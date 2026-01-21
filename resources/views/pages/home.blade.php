@extends('layouts.app')

@section('title', 'Welcome | Sabah Teachers Union')

@section('content')
    <div>
    <div>
        @include('partials.hero')
        @include('partials.about-stu')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
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
    </div>
@endsection
