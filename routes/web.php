<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreguntaController;

// Rutas de autenticación
Auth::routes();

// Ruta de inicio de sesión personalizada
Route::get('/login', function () {
  // Redireccionar a la página de inicio si ya está autenticado
  if (Auth::check()) {
    return redirect()->route('home');
  }
  return view('auth.login');
})->name('login');

/**
 * Acceso a la encuesta mediante token. Se usa para compartir la encuesta y
 * registrar las respuestas.
 * > No es una ruta protegida porque no requiere autenticación. El usuario con
 * > el enlace podrá acceder para responder.
 */
Route::get('/encuesta/{token}', [EncuestaController::class, 'show'])->name('encuesta');

// Encuestas. No proteger la ruta de almacenamiento porque se usa para que un
// usuario (incluyendo externos) pueda responder la encuesta.
Route::resource("encuestas", EncuestaController::class)->only(['store']);

// Rutas protegidas por el middleware de autenticación
Route::group(['middleware' => 'auth'], function () {
  // Ruta principal. Muestra las encuestas creadas por el usuario.
  Route::get('/', [HomeController::class, 'index'])->name('home');


  // Generar URL para compartir la encuesta.
  Route::post('/genera-url', [HomeController::class, 'generaUrl'])->name('genera_url');

  // Detalles de la encuesta (preguntas, respuestas, etc.)
  Route::get('/encuestas/{id}', [HomeController::class, 'resultadoEncuesta'])->name('resultado_encuesta');

  Route::resource("encuestas", EncuestaController::class)->except(['store']);

  // Preguntas.
  Route::resource('preguntas', PreguntaController::class)->missing(function () {
    // Redireccionar a la página de inicio si no existe la encuesta.
    return redirect()->route('preguntas.index');
  });
});
