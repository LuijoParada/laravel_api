<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsuariosController;
use App\Http\Controllers\Api\StyleconfigController;

use App\Http\Controllers\Api\VideosController;
use App\Http\Controllers\Api\StatusController;

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
/*Rutas de los videos */
Route::get('videos', [VideosController::class, 'index']);   
Route::get('videos/{user_id}', [VideosController::class, 'show']);
Route::get('videos/video/{video_id}', [VideosController::class, 'showVideo']);
Route::post('videos', [VideosController::class, 'store']);
Route::put('videos/{id}', [VideosController::class, 'update']);
Route::delete('videos/{id}', [VideosController::class, 'destroy']);
Route::get('videos/likes/{id}', [VideosController::class, 'showLikes']);
Route::get('videos/dislikes/{id}', [VideosController::class, 'showDislikes']);
Route::get('videos/views/{id}', [VideosController::class, 'showViews']);
Route::post('videos/upload', [VideosController::class, 'upload']);
Route::get('videos/show/{id}', [VideosController::class, 'showVideoFile']);
Route::get('videos/showthumb/{id}', [VideosController::class, 'showThumbnailFile']);
/*rutas de los status de likes */
Route::post('status', [StatusController::class, 'store']);
Route::put('status/{id}', [StatusController::class, 'update']);
Route::get('status/{id_video}/{id_usuario}', [StatusController::class, 'show']);
Route::delete('status/{id_video}', [StatusController::class, 'destroy']);
Route::delete('status/{id_usuario}', [StatusController::class, 'destroyuser']);

