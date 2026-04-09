<?php 

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
     * http://localhost:8000/api/v1/archivo/test
     * */ 





    require __DIR__.'/Modules/archivoRuta.php';
});