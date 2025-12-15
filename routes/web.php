<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LecturaController;


// PORTADA
Route::get('/', [MainController::class, 'index'])->name('main');


// AUTENTICACIÓN
// Activa login, register, verify, reset password...
Auth::routes(['verify' => true]);


// PERFIL DE USUARIO
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('home', [HomeController::class, 'update'])->name('home.update');


// LECTURAS DE TAROT
// 1. Historial (Mis Lecturas)
Route::get('mis-lecturas', [LecturaController::class, 'index'])->name('lectura.index');

// 2. Formulario para preguntar (Necesita el ID del tema)
Route::get('lectura/crear/{tema}', [LecturaController::class, 'create'])->name('lectura.create');

// 3. Guardar la lectura
Route::post('lectura', [LecturaController::class, 'store'])->name('lectura.store');

// 4. Ver el resultado individual
Route::get('lectura/{lectura}', [LecturaController::class, 'show'])->name('lectura.show');

// 5. Borrar una lectura
Route::delete('lectura/{lectura}', [LecturaController::class, 'destroy'])->name('lectura.destroy');
