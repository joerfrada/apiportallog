<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AplicacionController;
use App\Http\Controllers\UsuarioController;

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

//Login
Route::post('login', [UsuarioController::class, 'login']);

// Autenticar los controladores
Route::group(['middleware' => ['jwt.verify']], function() {
    // Aplicaciones
    Route::get('/aplicacion/getAplicacionesFull', [AplicacionController::class, 'getAplicacionesFull']);
    Route::post('/aplicacion/getAplicaciones', [AplicacionController::class, 'getAplicaciones']);
    Route::post('/aplicacion/crearAplicaciones', [AplicacionController::class, 'crearAplicaciones']);
    Route::post('/aplicacion/actualizarAplicaciones', [AplicacionController::class, 'actualizarAplicaciones']);
    Route::get('/aplicacion/getTipoAplicaciones', [AplicacionController::class, 'getTipoAplicaciones']);
});
