<?php

use App\Http\Controllers\ApiRestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/lista/pregunta', [ApiRestController::class, 'listaPregunta'])->name('lista_pregunta');

Route::post('/lista/encuesta', [ApiRestController::class, 'listaEncuesta'])->name('lista_encuesta');

Route::get('/lista/respuesta', [ApiRestController::class, 'preguntasEncuesta'])->name('preguntas_encuesta');

Route::post('/lista/respuesta/pregunta', [ApiRestController::class, 'listaRespuestaPregunta'])->name('lista_respuesta_pregunta');

Route::post('/agrega/pregunta', [ApiRestController::class, 'agregaPregunta'])->name('agrega_pregunta');

Route::post('/muestra/pregunta', [ApiRestController::class, 'muestraPregunta'])->name('muestra_pregunta');
Route::post('/siguiente/pregunta', [ApiRestController::class, 'siguientePregunta'])->name('siguiente_pregunta');
Route::post('/siguiente/pregunta/humanidades', [ApiRestController::class, 'siguientePreguntaHumanidades'])->name('siguiente_pregunta_humanidades');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
