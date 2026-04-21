@extends('layouts.app')

@section('title', 'Welcome | Sabah Teachers Union')

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
