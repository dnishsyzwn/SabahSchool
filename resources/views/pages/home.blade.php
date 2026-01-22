@extends('layouts.app')

@section('title', 'Welcome | Sabah Teachers Union')

@section('content')
    <div>
    <div>
        @include('partials.hero')
        @include('partials.about-stu')

        <!-- Section Divider -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center my-0">
            <div class="h-px w-full bg-linear-to-r from-transparent via-gray-400 to-transparent"></div>
        </div>
        @include('partials.latest-articles')
    </div>
    </div>
@endsection
