<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdminController;

Route::redirect('/', '/home');

Route::view('/home', 'pages.home')->name('home');
Route::view('/quem_somos', 'pages.quem_somos')->name('quem_somos');
Route::view('/contactos', 'pages.contactos')->name('contactos');
Route::view('/doacoes', 'pages.doacoes')->name('doacoes');
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

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin')
    ->middleware('auth');

Route::delete('/admin/users/{user}', [App\Http\Controllers\AdminController::class, 'destroy'])
    ->name('admin.users.destroy')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
  Route::patch('admin/users/{user}/role', [AdminController::class, 'updateRole'])
       ->name('admin.users.updateRole');
});

Route::post('/admin/gatos', [App\Http\Controllers\AdminController::class, 'storeAnimal'])
    ->name('admin.gatos.store')
    ->middleware('auth');

Route::delete('/admin/gatos/{animal}', [App\Http\Controllers\AdminController::class, 'destroyAnimal'])
    ->name('admin.gatos.destroy')
    ->middleware('auth');

Route::get('/gatos', function () {
    $gatos = \App\Models\Animal::where('especie', 'gato')
               ->orderBy('created_at', 'desc')
               ->get();

    return view('pages.gatos', compact('gatos'));
})->name('gatos');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
