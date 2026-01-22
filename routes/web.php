<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});
Route::get('/galeri', function () {
    return view('pages.galeri');
});
Route::get('/borang/muat-turun', function () {
    return view('pages.muat-turun');
});
