<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix('/rutas')->group(function(){
    Route::get('/',[RutaController::class, 'index']);
    Route::post('/', [RutaController::class, 'store']);
    Route::patch('/{id_ruta}', [RutaController::class, 'update']);
    Route::delete('/{id_ruta}', [RutaController::class, 'destroy']);
});