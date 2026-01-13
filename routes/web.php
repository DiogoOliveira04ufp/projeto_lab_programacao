<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVolunteerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminAdocaoController;
use App\Http\Controllers\DonationReceiptController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\VoluntarioController;

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

Route::get('/doacoes/sucesso', [DonationController::class, 'success'])
    ->name('doacoes.success');

Route::get('/doacoes/cancelado', [DonationController::class, 'cancel'])
    ->name('doacoes.cancel');

/* RECIBO PDF (download) */
Route::get('/doacoes/recibo/{donation}', [DonationReceiptController::class, 'download'])
    ->middleware('auth')
    ->name('doacoes.recibo');

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
Route::delete('/avaliacoes/{avaliacao}', [AvaliacaoController::class, 'destroy'])
    ->middleware('auth')
    ->name('avaliacoes.destroy');

/* LOGOUT */
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/* ÁREA DE VOLUNTÁRIOS (admin + voluntários) */
Route::get('/area-voluntarios', [VoluntarioController::class, 'areaVoluntarios'])
    ->middleware(['auth', 'role:admin,voluntario'])
    ->name('voluntarios.area');
Route::post('/chat/enviar', [VoluntarioController::class, 'enviarMensagem'])
    ->middleware(['auth', 'role:admin,voluntario'])
    ->name('chat.enviar');
Route::delete('/chat/eliminar/{mensagem}', [VoluntarioController::class, 'eliminarMensagem'])
    ->middleware(['auth', 'role:admin,voluntario'])
    ->name('chat.eliminar');

/* ADMIN */
Route::middleware(['auth', 'role:admin'])->group(function () {

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

    /* DOAÇÕES (ADMIN) */
    Route::get('/admin/doacoes', [AdminDonationController::class, 'index'])
        ->name('admin.doacoes.index');

    Route::get('/admin/doacoes/{donation}', [AdminDonationController::class, 'show'])
        ->name('admin.doacoes.show');

    /* ADOTAR (ADMIN) */
    Route::get('/admin/adocoes', [AdminAdocaoController::class, 'index'])->name('admin.adocoes.index');
    Route::patch('/admin/adocoes/{animal}/status', [AdminAdocaoController::class, 'updateStatus'])->name('admin.adocoes.update');
});

/* PERFIL (UTILIZADORES COMUNS E VOLUNTÁRIOS) */
Route::middleware(['auth', 'role:user,voluntario'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::patch('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
    Route::delete('/perfil', [PerfilController::class, 'destroy'])->name('perfil.destroy');

/* ADOTAR GATO */
    Route::post('/perfil/cancelar/{animal}', [PerfilController::class, 'cancelarAdocao'])->name('perfil.cancelar_adocao');

});

 Route::post('/gatos/{animal}/adotar', [PerfilController::class, 'adotar'])->name('gatos.adotar');

