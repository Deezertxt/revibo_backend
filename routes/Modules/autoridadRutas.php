<?php 

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Autoridad\AutoridadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(["auth:sanctum","rol:admin"])->prefix("/autoridad")->group(function () {
    Route::get("/", [AutoridadController::class, "index"])->name("autoridad.index");
    Route::post("/", [AutoridadController::class, "store"])->name("autoridad.store");
});
