<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::view('/home', 'pages.home')->name('home');
Route::view('/quem_somos', 'pages.quem_somos')->name('quem_somos');
Route::view('/gatos', 'pages.gatos')->name('gatos');
Route::view('/contactos', 'pages.contactos')->name('contactos');
Route::view('/doacoes', 'pages.doacoes')->name('doacoes');
Route::view('/avaliacoes', 'pages.avaliacoes')->name('avaliacoes');
Route::view('/voluntarios', 'pages.voluntarios')->name('voluntarios');
Route::view('/login', 'pages.login')->name('login');
Route::view('/registro', 'pages.registro')->name('registro');
