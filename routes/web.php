<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para solicitar verificación, accesible solo para usuarios autenticados con rol 'customer'
Route::view('/verificar', 'request.solicitar_verificar')
    ->name('verificar')
    ->middleware(['auth', 'role:vendedor|seller']);
