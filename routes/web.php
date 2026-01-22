<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/galeri', function () {
    return view('pages.galeri');
});
Route::get('/muat-turun', function () {
    return view('pages.muat-turun');
});

Route::get('/hubungi-kami', function () {
    return view('pages.hubungi');
});
