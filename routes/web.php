<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/keahlian', function () {
    return view('pages.keahlian');
});


Route::get('/aktiviti-kami', function () {
    return view('pages.aktiviti-kami');
});
Route::get('/borang/muat-turun', function () {
    return view('pages.muat-turun');
});

Route::get('/borang/hantar', function () {
    return view('pages.hantar-borang');
});

Route::get('/hubungi', function () {
    return view('pages.hubungi');
});

Route::get('/mengenai-stu', function(){
    return view('pages.mengenai-stu');
});

Route::get('/ahli-tertinggi-exco', function(){
    return view('pages.ahli-tertinggi-exco');
});

// page showing evidence of donations / organization efforts
// (alternate layout is now the primary version)
Route::get('/bukti-tuntutan', function () {
    return view('pages.bukti-tuntutan-alternate');
});

Route::get('/berita', function () {
    return view('pages.berita');
});



Route::get('/berita/{id}', function ($id) {
    return view('pages.berita-detail', ['id' => $id]);
});

Route::get('/kerjaya', function () {
    return view('pages.kerjaya');
});

Route::get('/kerjaya/detail', function () {
    return view('pages.kerjaya-detail');
});

// ==========================================
// AUTH ROUTES
// ==========================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
});

// ==========================================
// ADMIN ROUTES
// ==========================================

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // Temporary Dashboard Route
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
});
