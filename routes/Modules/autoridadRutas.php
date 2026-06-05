<?php 

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Autoridad\AutoridadController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix("/autoridad")->group(function () {
    Route::get("/", [AutoridadController::class, "index"])->name("autoridad.index");
    Route::post("/", [AutoridadController::class, "store"])->name("autoridad.store")->middleware("rol:admin");
    Route::delete("/{id}", [AutoridadController::class, "destroy"])->name("autoridad.destroy")->middleware("rol:admin");
});
