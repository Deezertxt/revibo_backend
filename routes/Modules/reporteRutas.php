<?php


namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Reporte\ReporteController;
use Illuminate\Support\Facades\Route;

Route::prefix("/reporte")->group(function () {
    Route::get("/", [ReporteController::class, "index"])->name("reporte.index"); //todos los reportes
    Route::get("/{id_reporte}", [ReporteController::class, "show"])->name("reporte.show"); //detalle reporte
    Route::post("/", [ReporteController::class, "store"])->name("reporte.store")->middleware(["auth:sanctum", "rol:admin,autoridad"]);
    Route::patch('/{id_reporte}', [ReporteController::class, 'update'])->middleware(['auth:sanctum', 'rol:admin,autoridad'])->name('reporte.update');
});
