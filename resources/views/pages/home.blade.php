@extends('layouts.app')

@section('title', 'Laman Utama | Sabah Teachers Union (STU) - Kesatuan Guru Sabah')
@section('meta_description', 'Sabah Teachers Union (STU) adalah kesatuan guru terbesar di Sabah. Memperjuangkan hak, kebajikan, dan profesion keguruan sejak 1967. Sertai kami untuk masa depan pendidikan Sabah.')
@section('meta_keywords', 'STU, STU Sabah, Sabah Teachers Union, Kesatuan Guru Sabah, Hak Guru Sabah, Kebajikan Guru, Pendidikan Sabah, Mutiara Plus STU')

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
