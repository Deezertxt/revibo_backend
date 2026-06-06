<?php 

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\InstitucionController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix('/institucion')->group(function () {
    Route::get("/", [InstitucionController::class, "index"])->name("institucion.index");
});
