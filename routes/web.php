<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;

Route::redirect('/', '/home');

Route::view('/home', 'pages.home')->name('home');
Route::view('/quem_somos', 'pages.quem_somos')->name('quem_somos');
Route::view('/gatos', 'pages.gatos')->name('gatos');
Route::view('/contactos', 'pages.contactos')->name('contactos');
Route::view('/doacoes', 'pages.doacoes')->name('doacoes');
// Route::view('/avaliacoes', 'pages.avaliacoes')->name('avaliacoes');
Route::view('/voluntarios', 'pages.voluntarios')->name('voluntarios');

/* AUTH */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/registo', [AuthController::class, 'showRegister'])->name('registo');
    Route::post('/registo', [AuthController::class, 'register'])->name('registo.post');
});

Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])
    ->name('avaliacoes.index');

Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])
    ->middleware('auth')
    ->name('avaliacoes.store');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
