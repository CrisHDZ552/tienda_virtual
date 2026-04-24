<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VerificationRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Ruta para solicitar verificación, accesible solo para usuarios autenticados con rol 'customer'
Route::view('/verificar', 'request.solicitar_verificar')
    ->name('verificar')
    ->middleware(['auth', 'role:vendedor|seller']);

Route::get('/verificar_solicitud', [VerificationRequestController::class, 'index'])
    ->name('verificar_solicitud')
    ->middleware(['auth', 'role:admin']);

Route::post('/verificar', [VerificationRequestController::class, 'store'])
    ->name('verification.request.store')
    ->middleware(['auth', 'role:vendedor|seller']);

Route::patch('/verificar_solicitud/{id}', [VerificationRequestController::class, 'update'])
    ->name('verification.request.update')
    ->middleware(['auth', 'role:admin']);

Route::view('/perfil', 'perfil')
    ->name('perfil')
    ->middleware(['auth']);

Route::put('/perfil', [ProfileController::class, 'update'])
    ->middleware('auth') // Profile updates usually require the user to be authenticated
    ->name('perfil.update');

    