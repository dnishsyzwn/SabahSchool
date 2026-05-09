@extends('layouts.app')

@section('title', 'Mengenai Kami | Sabah Teachers Union (STU) - Sejarah & Perjuangan')
@section('meta_description', 'Kenali Sabah Teachers Union (STU), kesatuan guru terawal yang didaftarkan di Sabah sejak 1967. Lihat pengenalan, tujuan, matlamat, dan amanat Presiden STU.')
@section('meta_keywords', 'Sejarah STU, Pengenalan STU, Matlamat STU, Presiden STU, Kesatuan Guru Sabah, Profil STU, Sabah Teachers Union')

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
