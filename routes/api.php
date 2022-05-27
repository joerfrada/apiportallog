<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AplicacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioMenuController;

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

//Home
Route::post('index', [HomeController::class, 'home']);

// Autenticar los controladores
Route::group(['middleware' => ['jwt.verify']], function() {
    // Aplicaciones
    Route::get('/aplicacion/getAplicacionesFull', [AplicacionController::class, 'getAplicacionesFull']);
    Route::post('/aplicacion/getAplicaciones', [AplicacionController::class, 'getAplicaciones']);
    Route::post('/aplicacion/crearAplicaciones', [AplicacionController::class, 'crearAplicaciones']);
    Route::post('/aplicacion/actualizarAplicaciones', [AplicacionController::class, 'actualizarAplicaciones']);
    Route::get('/aplicacion/getTipoAplicaciones', [AplicacionController::class, 'getTipoAplicaciones']);

    // Menu
    // Route::post('/menu/getMenus', [MenuController::class, 'getMenus']);
    // Route::post('/menu/crearMenus', [MenuController::class, 'crearMenus']);
    // Route::post('/menu/actualizarMenus', [MenuController::class, 'actualizarMenus']);

    // Usuarios
    Route::get('/usuario/getUsuariosFull', [UsuarioController::class, 'getUsuariosFull']);
    Route::post('/usuario/getUsuarios', [UsuarioController::class, 'getUsuarios']);
    Route::post('/usuario/crearUsuarios', [UsuarioController::class, 'crearUsuarios']);
    Route::post('/usuario/actualizarUsuarios', [UsuarioController::class, 'actualizarUsuarios']);

    // Usuarios-Menu
    // Route::post('/usuariomenu/crearUsuarioMenu', [UsuarioMenuController::class, 'crearUsuarioMenu']);
    // Route::post('/usuariomenu/actualizarUsuarioMenu', [UsuarioMenuController::class, 'actualizarUsuarioMenu']);
});
