<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampeonatoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\FaseEncuentrosController;
use App\Http\Controllers\EncuentrosController;
use App\Http\Controllers\ViewEncuentrosFaseController;

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
    
    /* Players */
    Route::get('/players',[PlayersController::class, 'index']);
    Route::post('/playerssave',[PlayersController::class, 'store']);
    Route::put('/playersupdate/{id}',[PlayersController::class, 'update']);
    Route::delete('/playersdelete/{id}',[PlayersController::class, 'destroy']);

    /* Fase Encuentros */
    Route::get('/fencuentros',[FaseEncuentrosController::class, 'index']);
    Route::post('/fencuentrossave',[FaseEncuentrosController::class, 'store']);
    Route::put('/fencuentrosupdate/{id}',[FaseEncuentrosController::class, 'update']);
    Route::delete('/fencuentrosdelete/{id}',[FaseEncuentrosController::class, 'destroy']);

    /* Encuentros */
    Route::get('/encuentros',[EncuentrosController::class, 'index']);
    Route::get('/encuentros/{id_enc}',[EncuentrosController::class, 'show']);
    Route::post('/encuentrossave',[EncuentrosController::class, 'store']);
    Route::put('/encuentrosupdate/{id}',[EncuentrosController::class, 'update']);
    Route::delete('/encuentrosdelete/{id}',[EncuentrosController::class, 'destroy']);

    /* View Encuentros Fase */
    Route::get('/viewencuentros',[ViewEncuentrosFaseController::class, 'index']);
    Route::get('/viewencuentros/{campeonato}',[ViewEncuentrosFaseController::class, 'show']);
});

Route::post('login',[AuthController::class, 'authLogin']);
Route::post('registro',[AuthController::class, 'authRegistro']);
