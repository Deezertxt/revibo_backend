<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\RutaController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix('/ruta')->group(function(){
    Route::get('/',[RutaController::class, 'index']);
    Route::post('/', [RutaController::class, 'store']);
});