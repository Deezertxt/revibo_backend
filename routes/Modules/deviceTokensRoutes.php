<?php


namespace App\Http\Controllers\Modules;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceTokenController;

Route::prefix('/device-token')->group(function () {
    Route::post('/', [DeviceTokenController::class, 'store']);
    Route::post('/sync', [DeviceTokenController::class, 'sync'])->middleware('tryAuth');
    Route::post('/link', [DeviceTokenController::class, 'link']);
});
