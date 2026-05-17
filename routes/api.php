<?php 

use App\Http\Controllers\DeviceTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => response()->json([
        'message' => 'pong',
        'service' => 'Revibo Backend',
        'enviroment' => app()->environment(),
        'timestamp' => now()->toIso8601String()
    ]));

Route::prefix('v1')->group(function() {

    /** 
     * Archivos de rutas de los módulos bajo versionamiento
     * http://localhost:8000/api/v1/test
     * */ 

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/autenticar', fn() => response()->json([
            'message' => 'Autenticado correctamente',
            'user' => request()->user(),
        ]));
    });

    Route::post('/device-token', [DeviceTokenController::class, 'store']);


    require __DIR__.'/Modules/archivoRuta.php';
    require __DIR__.'/auth.php';
    require __DIR__.'/Modules/autoridadRutas.php';
    require __DIR__.'/Modules/InstitucionRutas.php';
    require __DIR__.'/Modules/reporteRutas.php';
    require __DIR__.'/Modules/rutasRuta.php';
});