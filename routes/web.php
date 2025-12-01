<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SupportingMediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.judul');
})->name('judul');

Route::get('/intro', function () {
    return view('pages.intro');
})->name('intro');

Route::get('/beranda', function () {
    return view('pages.beranda');
})->name('beranda');

Route::get('/kd', function (){
    return view('pages.kd');
})->name('kd');

// Protected routes - require authentication
Route::middleware('auth')->group(function () {
    // Submenu / Material list
    Route::get('/submenu', [MaterialController::class, 'index'])->name('submenu');

    // Material viewing
    Route::get('/materi/{material}', [MaterialController::class, 'show'])->name('materi.show');

    // Quiz
    Route::get('/materi/{material}/quiz', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/materi/{material}/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::post('/quiz/question/{question}/validate', [QuizController::class, 'validateAnswer'])->name('quiz.validate');

    // Supporting Media
    Route::get('/media-pendukung', [SupportingMediaController::class, 'index'])->name('media-pendukung');
    Route::get('/media-pendukung/{media}/download', [SupportingMediaController::class, 'download'])->name('media.download');
});

// Admin routes (accessible to everyone for now)
Route::prefix('admin')->name('admin.')->group(function () {
    // Materials CRUD
    Route::get('/materials', [AdminController::class, 'materialsIndex'])->name('materials.index');
    Route::get('/materials/create', [AdminController::class, 'materialsCreate'])->name('materials.create');
    Route::post('/materials', [AdminController::class, 'materialsStore'])->name('materials.store');
    Route::get('/materials/{material}/edit', [AdminController::class, 'materialsEdit'])->name('materials.edit');
    Route::put('/materials/{material}', [AdminController::class, 'materialsUpdate'])->name('materials.update');
    Route::delete('/materials/{material}', [AdminController::class, 'materialsDestroy'])->name('materials.destroy');

    // Questions CRUD (nested under materials)
    Route::get('/materials/{material}/questions', [AdminController::class, 'questionsIndex'])->name('questions.index');
    Route::get('/materials/{material}/questions/create', [AdminController::class, 'questionsCreate'])->name('questions.create');
    Route::post('/materials/{material}/questions', [AdminController::class, 'questionsStore'])->name('questions.store');
    Route::get('/materials/{material}/questions/{question}/edit', [AdminController::class, 'questionsEdit'])->name('questions.edit');
    Route::put('/materials/{material}/questions/{question}', [AdminController::class, 'questionsUpdate'])->name('questions.update');
    Route::delete('/materials/{material}/questions/{question}', [AdminController::class, 'questionsDestroy'])->name('questions.destroy');

    // Supporting Media CRUD
    Route::get('/media', [SupportingMediaController::class, 'adminIndex'])->name('media.index');
    Route::get('/media/create', [SupportingMediaController::class, 'create'])->name('media.create');
    Route::post('/media', [SupportingMediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [SupportingMediaController::class, 'destroy'])->name('media.destroy');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
