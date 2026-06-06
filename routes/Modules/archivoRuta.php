<?php 

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test', function() {
    return response()->json([
        'message' => 'Archivo module test endpoint',
        'timestamp' => now()->toIso8601String()
    ]);
});