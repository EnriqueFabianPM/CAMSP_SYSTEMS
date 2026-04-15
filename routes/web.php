<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ControladorUsuario;
use App\Http\Controllers\ControladorEvento;
use App\Http\Controllers\ControladprSistemaLog;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. RUTAS PÚBLICAS ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::view('/talleres', 'talleres')->name('talleres');
Route::view('/proceso', 'proceso')->name('proceso');

// ✅ ESTA ES TU PÁGINA BONITA DE EVENTOS (NO CRUD)
Route::get('/eventos', [ControladorEvento::class, 'public'])->name('eventos.public');

// ✅ DETALLE DE EVENTO (opcional si luego quieres dinámico)
Route::get('/evento/{evento}', [ControladorEvento::class, 'show'])->name('eventos.show');


// --- 2. RUTAS PROTEGIDAS ---
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [ControladorUsuario::class, 'dashboard'])->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::get('/usuarios/{identificador}', [ControladorUsuario::class, 'show'])->name('usuarios.show');
});


// --- 3. RUTAS POR ROL ---

// 🔹 RUTAS GENERALES (UNA SOLA VEZ)
Route::middleware(['auth'])->group(function () {

    // 👨‍🏫 EMPLEADOS (solo personal autorizado)
    Route::get('/empleados', [ControladorUsuario::class, 'empleados'])
        ->middleware('role:admin|docente|director|servicios_escolares')
        ->name('empleados.index');

    // 🎓 ESTUDIANTES
    Route::get('/estudiantes', [ControladorUsuario::class, 'estudiantes'])
        ->middleware('role:admin|docente|director|servicios_escolares|estudiante|padre')
        ->name('estudiantes.index');

    // 🟡 VISITANTES
    Route::get('/visitantes', [ControladorUsuario::class, 'visitantes'])
        ->middleware('role:admin|docente|director|servicios_escolares|visitante')
        ->name('visitantes.index');

    Route::get('/estudiantes/consulta', [ControladorUsuario::class, 'consultaEstudiantes'])
        ->middleware('role:admin|docente|director|servicios_escolares|estudiante|padre')
        ->name('estudiantes.consulta');

    Route::get('/empleados/consulta', [ControladorUsuario::class, 'consultaEmpleados'])
        ->middleware('role:admin|docente|director|servicios_escolares')
        ->name('empleados.consulta');

    Route::get('/visitantes/consulta', [ControladorUsuario::class, 'consultaVisitantes'])
        ->middleware('role:admin|docente|director|servicios_escolares|visitante')
        ->name('visitantes.consulta');

    Route::get('/eventos/consulta', [ControladorEvento::class, 'consulta'])
        ->name('eventos.consulta');
});

// A. ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/gestion', [ControladorUsuario::class, 'index'])->name('admin.index');
    Route::get('/exportar', [ControladorUsuario::class, 'export'])->name('usuarios.export');
    Route::post('/importar', [ControladorUsuario::class, 'import'])->name('usuarios.import');
    Route::post('/{id}/cambiar-rol', [ControladorUsuario::class, 'cambiarRol'])->name('usuarios.cambiarRol');

    // 🔥 LOGS DEL SISTEMA
    Route::get('/logs', [ControladprSistemaLog::class, 'index'])->name('logs.index');
    Route::get('/logs/exportar', [ControladprSistemaLog::class, 'export'])->name('logs.export');
    Route::get('/logs/{id}', [ControladprSistemaLog::class, 'show'])->name('logs.show');
    Route::delete('/logs', [ControladprSistemaLog::class, 'clear'])->name('logs.clear');
});


// B. GESTIÓN (ADMIN + DOCENTE)
Route::middleware(['auth', 'role:admin|docente'])->prefix('gestion')->group(function () {

    // 👤 USUARIOS
    Route::get('/lista', [ControladorUsuario::class, 'index'])->name('usuarios.index');
    Route::resource('usuarios', ControladorUsuario::class)->except(['show', 'index']);

    // 🎉 EVENTOS (CRUD REAL)
    Route::resource('eventos', ControladorEvento::class);

    // QR
    Route::patch('/usuarios/{identificador}/update-qr', [ControladorUsuario::class, 'updateQRCode'])->name('usuarios.updateQR');
    Route::post('/usuarios/{identificador}/enviar-qr', [ControladorUsuario::class, 'enviarCorreoQR'])->name('usuarios.enviarQR');

    Route::get('/usuarios/{identificador}/publico', [ControladorUsuario::class, 'fichaPublica'])
        ->name('usuarios.fichaPublica');

    // 👇 AGREGA ESTO
    Route::get('/empleados', [ControladorUsuario::class, 'empleados'])->name('empleados.index');
    Route::get('/estudiantes', [ControladorUsuario::class, 'estudiantes'])->name('estudiantes.index');
    Route::get('/visitantes', [ControladorUsuario::class, 'visitantes'])->name('visitantes.index');


    Route::get('/eventos/ficha/{id}', [ControladorEvento::class, 'fichaPublica'])
        ->name('eventos.fichaPublica');
});


// C. COMUNIDAD
Route::middleware(['auth', 'role:estudiante|padre'])->prefix('comunidad')->group(function () {
    Route::get('/mi-espacio', [ControladorUsuario::class, 'index'])->name('comunidad.index');

    // 👇 AGREGA ESTO
    Route::get('/empleados', [ControladorUsuario::class, 'empleados'])->name('empleados.index');
    Route::get('/estudiantes', [ControladorUsuario::class, 'estudiantes'])->name('estudiantes.index');
    Route::get('/visitantes', [ControladorUsuario::class, 'visitantes'])->name('visitantes.index');
});

// D. VISITANTES
Route::middleware(['auth', 'role:visitante'])->prefix('visitante')->group(function () {
    Route::get('/registro', [ControladorUsuario::class, 'index'])->name('visitante.index');

    // 👇 AGREGA ESTO
    Route::get('/empleados', [ControladorUsuario::class, 'empleados'])->name('empleados.index');
    Route::get('/estudiantes', [ControladorUsuario::class, 'estudiantes'])->name('estudiantes.index');
    Route::get('/visitantes', [ControladorUsuario::class, 'visitantes'])->name('visitantes.index');
});

require __DIR__ . '/auth.php';