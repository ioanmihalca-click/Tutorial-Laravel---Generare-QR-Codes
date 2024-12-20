<?php

use App\Livewire\QrGenerator;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//ruta pentru generator
Route::get('/qr' , QrGenerator::class)->name('qr.index');

//ruta pentru redirect
Route::get('/r/{identifier}' , QrGenerator::class)->name('qr.redirect');