<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorUsuario;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/usuarios', [ControladorUsuario::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [ControladorUsuario::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [ControladorUsuario::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{identificador}', [ControladorUsuario::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{identificador}/editar', [ControladorUsuario::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{identificador}', [ControladorUsuario::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{identificador}', [ControladorUsuario::class, 'destroy'])->name('usuarios.destroy');

});

require __DIR__ . '/auth.php';