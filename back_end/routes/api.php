<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes publiques
Route::post('/register', [AuthController::class, 'register'])->name("user.register");
Route::post('/login', [AuthController::class, 'login'])->name("user.login");

// Routes protégées par JWT
Route::middleware('jwt.auth')->group(function () {
    Route::get('/task', [Controller::class, 'index'])->name("tasks.index");
    Route::post('/task', [Controller::class, 'store'])->name("tasks.store");
    Route::get('/task/{id}', [Controller::class, 'show'])->name("tasks.show");
    Route::put('/task/{id}', [Controller::class, 'update'])->name("tasks.update");
    Route::delete('/task/{id}', [Controller::class, 'destroy'])->name("tasks.destroy");
    
    Route::post('/logout', [AuthController::class, 'logout'])->name("user.logout");
    Route::post('/refresh', [AuthController::class, 'refresh'])->name("user.refresh");
    Route::get('/me', [AuthController::class, 'me'])->name("user.me");
});