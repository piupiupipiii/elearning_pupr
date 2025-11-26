<?php

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
