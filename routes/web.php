<?php

use App\Http\Controllers\AuthController;
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

Route::get('/submenu', function (){
    return view('pages.submenu');
})->name('submenu');

Route::get('/materi/submenu', function () { return view('submenu'); });

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
