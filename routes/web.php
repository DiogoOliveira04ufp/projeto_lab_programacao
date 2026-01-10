<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVolunteerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\StripeWebhookController;

Route::redirect('/', '/home');

/* PÁGINAS PÚBLICAS */
Route::view('/home', 'pages.home')->name('home');
Route::view('/quem_somos', 'pages.quem_somos')->name('quem_somos');
Route::view('/doacoes', 'pages.doacoes')->name('doacoes');
Route::view('/contactos', 'pages.contactos')->name('contactos');
Route::view('/voluntarios', 'pages.voluntarios')->name('voluntarios');

/* GATOS (PÚBLICO) */
Route::get('/gatos', function () {
    $gatos = \App\Models\Animal::where('especie', 'gato')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('pages.gatos', compact('gatos'));
})->name('gatos');

/* STRIPE TEST - pagamentos */
Route::post('/doacoes/checkout', [DonationController::class, 'checkout'])
    ->middleware('auth')
    ->name('doacoes.checkout');
Route::get('/doacoes/sucesso', [DonationController::class, 'success'])->name('doacoes.success');
Route::get('/doacoes/cancelado', [DonationController::class, 'cancel'])->name('doacoes.cancel');

/* SMTP - mailtrap (submissão voluntariado) */
Route::post('/voluntarios', [ContactController::class, 'send'])
    ->middleware('auth')
    ->name('voluntarios.send');

/* AUTH */
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/registo', [AuthController::class, 'showRegister'])->name('registo');
    Route::post('/registo', [AuthController::class, 'register'])->name('registo.post');
});

/* AVALIAÇÕES */
Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('avaliacoes.index');
Route::post('/avaliacoes', [AvaliacaoController::class, 'store'])
    ->middleware('auth')
    ->name('avaliacoes.store');

/* LOGOUT */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/* ÁREA DE VOLUNTÁRIOS (admin + voluntários) */
Route::get('/area-voluntarios', function () {
    // tem de estar autenticado
    if (!auth()->check()) {
        abort(403);
    }

    $role = (int) auth()->user()->role;

    // apenas admin (1) ou voluntário (2)
    if (!in_array($role, [User::ROLE_ADMIN, User::ROLE_VOLUNTARIO])) {
        abort(403);
    }

    return view('pages.area_voluntarios');
})->middleware('auth')->name('voluntarios.area');


/* ADMIN */
Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    /* USERS */
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::patch('/admin/users/{user}/role', [AdminController::class, 'updateRole'])
        ->name('admin.users.updateRole');

    /* GATOS (ADMIN) */
    Route::post('/admin/gatos', [AdminController::class, 'storeAnimal'])
        ->name('admin.gatos.store');

    Route::delete('/admin/gatos/{animal}', [AdminController::class, 'destroyAnimal'])
        ->name('admin.gatos.destroy');

    /* VOLUNTÁRIOS (ADMIN) */
    Route::get('/admin/voluntarios', [AdminVolunteerController::class, 'index'])
        ->name('admin.voluntarios.index');

    Route::get('/admin/voluntarios/{id}', [AdminVolunteerController::class, 'show'])
        ->name('admin.voluntarios.show');

    Route::post('/admin/voluntarios/{id}', [AdminVolunteerController::class, 'update'])
        ->name('admin.voluntarios.update');
});
