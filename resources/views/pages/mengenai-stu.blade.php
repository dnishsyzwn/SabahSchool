@extends('layouts.app')

@section('title', 'Mengenai STU | Sabah Teachers Union')

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
