@extends('layouts.app')

@section('title', 'Mengenai Kami | Sabah Teachers Union (STU)')
@section('meta_description', 'Ketahui sejarah, matlamat, misi, dan perutusan Presiden Sabah Teachers Union (STU). Kesatuan guru terbesar dan tertua di Sabah yang memperjuangkan profesion keguruan.')
@section('meta_keywords', 'Sejarah STU, Misi STU, Presiden STU, Kesatuan Guru Sabah, Profil STU')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    @include('partials.mengenai-stu.hero')

    <!-- Matlamat & Misi Section -->
    @include('partials.mengenai-stu.matlamat-misi')

    <!-- Perutusan Presiden Section -->
    @include('partials.mengenai-stu.perutusan-presiden')
</div>
@endsection
