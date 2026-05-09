@extends('layouts.app')

@section('title', 'Keahlian STU | Sabah Teachers Union (STU) - Sertai Kami')
@section('meta_description', 'Maklumat lengkap keahlian Sabah Teachers Union (STU). Ketahui syarat keahlian, yuran bulanan, faedah kebajikan, dan cara mendaftar sebagai ahli STU.')
@section('meta_keywords', 'Keahlian STU, Daftar STU, Yuran STU, Faedah Ahli STU, Guru Sabah, Sabah Teachers Union, Kesatuan Guru Sabah')

@push('styles')
    @vite('resources/css/pages/keahlian.css')
@endpush

@section('content')

<div class="min-h-screen bg-slate-50">

    @include('partials.keahlian.hero')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        {{-- Main Section: Fees & Benefits --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            @include('partials.keahlian.fees')
            @include('partials.keahlian.benefits')
        </div>

        @include('partials.keahlian.wakalah')
        @include('partials.keahlian.steps')

    </div>{{-- end max-w --}}
</div>

@endsection

@push('scripts')
    @vite('resources/js/pages/keahlian.js')
@endpush
