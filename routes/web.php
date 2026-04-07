<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/keahlian', function () {
    return view('pages.keahlian');
});


Route::get('/aktiviti-kami', [\App\Http\Controllers\PublicActivityController::class, 'index'])->name('aktiviti-kami.index');
Route::get('/borang/muat-turun', [\App\Http\Controllers\BorangController::class, 'index'])->name('borang.muat-turun');

Route::get('/borang/hantar', function () {
    return view('pages.hantar-borang');
});

Route::get('/hubungi', [\App\Http\Controllers\ContactController::class, 'index'])->name('hubungi.index');
Route::post('/hubungi', [\App\Http\Controllers\ContactController::class, 'store'])->name('hubungi.store');

Route::get('/mengenai-stu', function(){
    return view('pages.mengenai-stu');
});

Route::get('/ahli-tertinggi-exco', [\App\Http\Controllers\CommitteePublicController::class, 'index'])->name('ahli-tertinggi-exco');

// page showing evidence of donations / organization efforts
// (alternate layout is now the primary version)
Route::get('/bukti-tuntutan', function () {
    return view('pages.bukti-tuntutan-alternate');
});

// Berita (public — powered by DB)
Route::get('/berita', [\App\Http\Controllers\NewsPublicController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\NewsPublicController::class, 'show'])->name('berita.show');

Route::get('/kerjaya', [\App\Http\Controllers\JobController::class, 'index'])->name('kerjaya.index');
Route::get('/kerjaya/{slug}', [\App\Http\Controllers\JobController::class, 'show'])->name('kerjaya.show');

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
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    Route::post('committee/reorder',         [\App\Http\Controllers\Admin\CommitteeController::class, 'reorder'])->name('committee.reorder');
    Route::post('committee/move-member',     [\App\Http\Controllers\Admin\CommitteeController::class, 'moveMember'])->name('committee.move-member');
    Route::post('committee/settings',        [\App\Http\Controllers\Admin\CommitteeController::class, 'saveSettings'])->name('committee.settings');
    Route::post('committee/add-row',         [\App\Http\Controllers\Admin\CommitteeController::class, 'addRow'])->name('committee.add-row');
    Route::post('committee/delete-row',      [\App\Http\Controllers\Admin\CommitteeController::class, 'deleteRow'])->name('committee.delete-row');
    Route::post('committee/update-row-cols', [\App\Http\Controllers\Admin\CommitteeController::class, 'updateRowCols'])->name('committee.update-row-cols');
    Route::resource('committee', \App\Http\Controllers\Admin\CommitteeController::class);
    Route::post('/news-image/upload', [\App\Http\Controllers\Admin\NewsImageController::class, 'upload'])->name('news.image.upload');
    Route::delete('/news-image', [\App\Http\Controllers\Admin\NewsImageController::class, 'destroy'])->name('news.image.destroy');

    // Activities
    Route::resource('activities', \App\Http\Controllers\Admin\ActivityController::class);
    Route::post('/activities/image/upload', [\App\Http\Controllers\Admin\ActivityImageController::class, 'upload'])->name('activities.image.upload');

    // Categories
    Route::get('/news-categories', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'index'])->name('news.categories.index');
    Route::post('/news-categories', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'store'])->name('news.categories.store');
    Route::delete('/news-categories/{category}', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'destroy'])->name('news.categories.destroy');

    // Kerjaya
    Route::resource('kerjaya', \App\Http\Controllers\Admin\JobController::class);

    // Borang Pintar
    Route::resource('borang-pintar', \App\Http\Controllers\Admin\BorangController::class)->except(['show', 'edit', 'update', 'create']);

    // Hubungi Kami (Mesej)
    Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);
});
