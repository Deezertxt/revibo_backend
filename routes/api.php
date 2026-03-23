<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::get('/ping', fn () => response()->json([
        'message' => 'pong',
        'service' => 'Revibo Backend',
        'enviroment' => app()->environment(),
        'timestamp' => now()->toIso8601String()
    ]));
});