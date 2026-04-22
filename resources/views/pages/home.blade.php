@extends('layouts.app')

@section('title', 'Laman Utama | Sabah Teachers Union (STU)')
@section('meta_description', 'Portal rasmi Sabah Teachers Union (STU). Membela nasib guru, memperkasakan profesion perguruan, dan memperjuangkan kebajikan pendidikan di Sabah sejak 1962.')
@section('meta_keywords', 'STU, Sabah Teachers Union, Kesatuan Guru Sabah, Hak Guru Sabah, Pendidikan Sabah, Kebajikan Guru')

@section('content')
    <div>
    <div>
        @include('partials.home.hero')
        @include('partials.home.about-stu')
        @include('partials.home.sumbangan-perjuangan')
        @include('partials.home.latest-articles')
    </div>
    </div>
@endsection
