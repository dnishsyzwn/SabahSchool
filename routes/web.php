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

Route::get('/hubungi', function () {
    return view('pages.hubungi');
});

Route::get('/mengenai-stu', function(){
    return view('pages.mengenai-stu');  
});
