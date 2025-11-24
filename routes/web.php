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