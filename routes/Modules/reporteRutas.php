<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Reporte\ReporteController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->prefix("/reporte")->group(function () {
    Route::get("/", [ReporteController::class, "index"])->name("reporte.index");
    Route::post("/", [ReporteController::class, "store"])->name("reporte.store")->middleware(["rol:admin,autoridad"]);
});
