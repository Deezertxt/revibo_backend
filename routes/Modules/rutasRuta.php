<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix('/rutas')->group(function(){
    Route::get('/{id_usuario}',[RutaController::class, 'index']);
    Route::post('/{id_usuario}', [RutaController::class, 'store']);
});