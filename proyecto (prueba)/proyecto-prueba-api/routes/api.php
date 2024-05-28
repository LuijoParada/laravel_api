<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\StyleconfigController;

/*Rutas de usuarios */
Route::get('usuarios', [UsuariosController::class, 'index']);
Route::get('usuarios/{id}', [UsuariosController::class, 'show']);
Route::post('usuarios', [UsuariosController::class, 'store']);
Route::put('usuarios/{id}', [UsuariosController::class, 'update']);
Route::patch('usuarios/{id}', [UsuariosController::class, 'updatePartial']);
Route::delete('usuarios/{id}', [UsuariosController::class, 'destroy']);
Route::post('usuarios/login', [UsuariosController::class, 'login']);
/*Rutas de los estilos */
Route::get('styleconfig', [StyleconfigController::class, 'index']);
Route::post('styleconfig', [StyleconfigController::class, 'store']);
Route::get('styleconfig/last', [StyleconfigController::class, 'showLast']);
Route::get('styleconfig/{id}', [StyleconfigController::class, 'show']);