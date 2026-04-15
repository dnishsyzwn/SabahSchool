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

Route::get('/borang/hantar', [\App\Http\Controllers\BorangController::class, 'hantar'])->name('borang.hantar-view');
Route::post('/borang/hantar', [\App\Http\Controllers\BorangController::class, 'store'])->name('borang.hantar');

Route::get('/hubungi', [\App\Http\Controllers\ContactController::class, 'index'])->name('hubungi.index');
Route::post('/hubungi', [\App\Http\Controllers\ContactController::class, 'store'])->name('hubungi.store');

Route::get('/mengenai-stu', function(){
    return view('pages.mengenai-stu');
});

Route::get('/ahli-tertinggi-exco', [\App\Http\Controllers\CommitteePublicController::class, 'index'])->name('ahli-tertinggi-exco');

// page showing evidence of donations / organization efforts
// (alternate layout is now the primary version)
Route::get('/bukti-tuntutan', [\App\Http\Controllers\PublicClaimController::class, 'index'])->name('bukti-tuntutan.index');

// Berita (public — powered by DB)
Route::get('/berita', [\App\Http\Controllers\NewsPublicController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\NewsPublicController::class, 'show'])->name('berita.show');

Route::get('/kerjaya', [\App\Http\Controllers\JobController::class, 'index'])->name('kerjaya.index');
Route::post('/kerjaya', [\App\Http\Controllers\JobController::class, 'store'])->name('kerjaya.store');
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

    // Aktiviti Kami (Success Stories)
    Route::resource('activity-stories', \App\Http\Controllers\Admin\ActivityStoryController::class);

    // Bukti Tuntutan (Claims)
    Route::resource('claims', \App\Http\Controllers\Admin\ClaimController::class);
    Route::post('/claims/media/upload', [\App\Http\Controllers\Admin\ClaimMediaController::class, 'upload'])->name('claims.media.upload');

    // Categories
    Route::get('/news-categories', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'index'])->name('news.categories.index');
    Route::post('/news-categories', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'store'])->name('news.categories.store');
    Route::delete('/news-categories/{category}', [\App\Http\Controllers\Admin\NewsCategoryController::class, 'destroy'])->name('news.categories.destroy');


    // Borang Pintar
    Route::resource('borang-pintar', \App\Http\Controllers\Admin\BorangController::class)->except(['show', 'edit', 'update', 'create']);

    // Hubungi Kami (Mesej)
    Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy']);

    // Kerjaya (Permohonan)
    Route::get('/kerjaya', [\App\Http\Controllers\Admin\JobApplicationController::class, 'index'])->name('kerjaya.index');
    Route::get('/kerjaya/{jobApplication}', [\App\Http\Controllers\Admin\JobApplicationController::class, 'show'])->name('kerjaya.show');
    Route::patch('/kerjaya/{jobApplication}/status', [\App\Http\Controllers\Admin\JobApplicationController::class, 'updateStatus'])->name('kerjaya.update-status');
    Route::delete('/kerjaya/{jobApplication}', [\App\Http\Controllers\Admin\JobApplicationController::class, 'destroy'])->name('kerjaya.destroy');

    // Form Submissions (Penghantaran Borang)
    Route::get('/form-submissions', [\App\Http\Controllers\Admin\FormSubmissionController::class, 'index'])->name('form-submissions.index');
    Route::get('/form-submissions/{formSubmission}', [\App\Http\Controllers\Admin\FormSubmissionController::class, 'show'])->name('form-submissions.show');
    Route::patch('/form-submissions/{formSubmission}/status', [\App\Http\Controllers\Admin\FormSubmissionController::class, 'updateStatus'])->name('form-submissions.update-status');
    Route::delete('/form-submissions/{formSubmission}', [\App\Http\Controllers\Admin\FormSubmissionController::class, 'destroy'])->name('form-submissions.destroy');
});

// // Deployment Routes
// Route::get('/run-migrate', function () {
//     \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
//     return "Migration completed!";
// });

// Route::get('/run-link', function () {
//     \Illuminate\Support\Facades\Artisan::call('storage:link');
//     return "Storage linked!";
// });
