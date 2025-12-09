<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TextoController;
use App\Models\Texto;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\PanelTextoController;
use App\Http\Controllers\CarruselImagenController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el middleware "web". ¡Ahora crea algo grandioso!
|
*/

Route::get('/', [App\Http\Controllers\CarruselImagenController::class, 'index'])->name('inicio');

Route::resource('servicios', App\Http\Controllers\ServicioController::class)->except(['show']);
Route::get('/nuestros-servicios', [App\Http\Controllers\ServicioController::class, 'index'])->name('servicios');

Route::get('/sobre-nosotros', [App\Http\Controllers\NosotrosController::class, 'index'])->name('nosotros');

Route::get('/organigrama', [App\Http\Controllers\OrganigramaController::class, 'index'])->name('organigrama');

Route::get('/contactenos', [ContactoController::class, 'index'])->name('contacto');

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::put('/texto/{clave}', [App\Http\Controllers\TextoController::class, 'update'])->name('texto.update');
Route::post('/contactenos', [ContactoController::class, 'store'])->name('contacto.store');
Route::post('/panel-texto/update', [PanelTextoController::class, 'update'])->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::post('/carrusel-imagen/{clave}', [CarruselImagenController::class, 'update'])->name('carrusel-imagen.update');
    
    // Rutas para mensajes de contacto (solo autenticados)
    Route::get('/mensajes', [ContactoController::class, 'getMensajes'])->name('contacto.mensajes');
    Route::put('/contacto/{id}/leido', [ContactoController::class, 'marcarComoLeido'])->name('contacto.leido');
    Route::post('/contacto/{id}/responder', [ContactoController::class, 'responder'])->name('contacto.responder');
    Route::delete('/contacto/{id}', [ContactoController::class, 'destroy'])->name('contacto.delete');
    
    // Rutas para organigrama (solo autenticados)
    Route::put('/organigrama/{id}', [App\Http\Controllers\OrganigramaController::class, 'update'])->name('organigrama.update');

    // Rutas para la galería de imágenes (solo autenticados)
    Route::post('/galeria', [App\Http\Controllers\GaleriaImagenController::class, 'store']);
    Route::put('/galeria/{id}', [App\Http\Controllers\GaleriaImagenController::class, 'update'])->name('galeria.update');
    Route::delete('/galeria/{id}', [App\Http\Controllers\GaleriaImagenController::class, 'destroy'])->name('galeria.destroy');
});

Route::post('/hitos', [App\Http\Controllers\HitoController::class, 'store'])->name('hitos.store');
Route::delete('/hitos/{id}', [App\Http\Controllers\HitoController::class, 'destroy'])->name('hitos.destroy');
Route::put('/hitos/{id}', [App\Http\Controllers\HitoController::class, 'update'])->name('hitos.update');
