<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ControladorUsuario;
use Illuminate\Support\Facades\Route;

// --- 1. RUTAS PÚBLICAS ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('/talleres', 'talleres')->name('talleres');
Route::view('/proceso', 'proceso')->name('proceso');
Route::view('/eventos', 'eventos')->name('eventos');

// --- 2. RUTAS PROTEGIDAS (Cualquier usuario logueado) ---
Route::middleware(['auth'])->group(function () {

    // El Dashboard ahora usa el controlador para decidir qué vista cargar
    Route::get('/dashboard', [ControladorUsuario::class, 'dashboard'])->name('dashboard');

    // Perfil Breeze
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Ficha de usuario única (Seguridad gestionada en el controlador)
    Route::get('/usuarios/{identificador}', [ControladorUsuario::class, 'show'])->name('usuarios.show');
});

// --- 3. RUTAS POR ROL (MODULARES) ---

// A. ADMINISTRACIÓN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/gestion', [ControladorUsuario::class, 'index'])->name('admin.index');
    Route::get('/exportar', [ControladorUsuario::class, 'export'])->name('usuarios.export');
    Route::post('/importar', [ControladorUsuario::class, 'import'])->name('usuarios.import');
    Route::post('/{id}/cambiar-rol', [ControladorUsuario::class, 'cambiarRol'])->name('usuarios.cambiarRol');
});



// B. EMPLEADOS Y DOCENTES
// Incluye directores, guardias y servicios escolares si comparten el middleware 'role:docente' o similar
Route::middleware(['auth', 'role:admin|docente'])->prefix('gestion')->group(function () {
    Route::get('/lista', [ControladorUsuario::class, 'index'])->name('usuarios.index');
    Route::resource('usuarios', ControladorUsuario::class)->except(['show', 'index']);

    // Gestión de QR
    Route::patch('/usuarios/{identificador}/update-qr', [ControladorUsuario::class, 'updateQRCode'])->name('usuarios.updateQR');
    Route::post('/usuarios/{identificador}/enviar-qr', [ControladorUsuario::class, 'enviarCorreoQR'])->name('usuarios.enviarQR');

    Route::get('/usuarios/{identificador}/publico', [ControladorUsuario::class, 'fichaPublica'])
        ->name('usuarios.fichaPublica');
});

// C. COMUNIDAD (Estudiantes y Padres)
Route::middleware(['auth', 'role:estudiante|padre'])->prefix('comunidad')->group(function () {
    Route::get('/mi-espacio', [ControladorUsuario::class, 'index'])->name('comunidad.index');
});

// D. VISITANTES
Route::middleware(['auth', 'role:visitante'])->prefix('visitante')->group(function () {
    Route::get('/registro', [ControladorUsuario::class, 'index'])->name('visitante.index');
});

require __DIR__ . '/auth.php';