<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\EquipoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user',[AuthController::class, 'user']);
    Route::post('logout',[AuthController::class, 'logout']);

    /* Campeonato */
    Route::get('/campeonatos',[CampeonatoController::class, 'index']);
    Route::post('/campeonatossave',[CampeonatoController::class, 'store']);
    Route::put('/campeonatosupdate/{id}',[CampeonatoController::class, 'update']);
    Route::delete('/campeonatosdelete/{id}',[CampeonatoController::class, 'destroy']);

    /* Equipo */
    Route::get('/equipos',[EquipoController::class, 'index']);
    Route::post('/equipossave',[EquipoController::class, 'store']);
    Route::put('/equiposupdateedit/{id}',[EquipoController::class, 'edit']);
    Route::post('/equiposupdate/{id}',[EquipoController::class, 'update']);
    Route::delete('/equiposdelete/{id}',[EquipoController::class, 'destroy']);
});

Route::post('login',[AuthController::class, 'authLogin']);
Route::post('registro',[AuthController::class, 'authRegistro']);
