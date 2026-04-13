<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class,'login'])->name('auth.login');
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum')->name('auth.logout');

Route::get('/auth', fn () => response()->json([
        'message' => 'AUTH',
        'service' => 'RUTAS AUTENTICACION',
        'enviroment' => app()->environment(),
        'timestamp' => now()->toIso8601String()
]));