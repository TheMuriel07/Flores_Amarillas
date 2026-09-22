<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicoController::class, 'inicio'])->name('inicio');
Route::post('/verificar', [PublicoController::class, 'verificar'])->name('verificar');
Route::get('/flor/{codigo}', [PublicoController::class, 'flor'])->name('flor');

/*
|--------------------------------------------------------------------------
| Rutas de administración (protegidas con el middleware "admin")
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('admin')->group(function (): void {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/personas/crear', [AdminController::class, 'crearForm'])->name('admin.persona.crear');
    Route::post('/personas', [AdminController::class, 'guardar'])->name('admin.persona.guardar');
    Route::get('/personas/{persona}/editar', [AdminController::class, 'editarForm'])->name('admin.persona.editar');
    Route::put('/personas/{persona}', [AdminController::class, 'actualizar'])->name('admin.persona.actualizar');
    Route::delete('/personas/{persona}', [AdminController::class, 'eliminar'])->name('admin.persona.eliminar');

    Route::post('/personas/{persona}/frases', [AdminController::class, 'guardarFrase'])->name('admin.frase.guardar');
    Route::put('/frases/{frase}', [AdminController::class, 'actualizarFrase'])->name('admin.frase.actualizar');
    Route::delete('/frases/{frase}', [AdminController::class, 'eliminarFrase'])->name('admin.frase.eliminar');
});

/*
|--------------------------------------------------------------------------
| Acceso al panel de administración
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.enviar');
Route::post('/admin/salir', [AdminController::class, 'logout'])->name('admin.logout');
