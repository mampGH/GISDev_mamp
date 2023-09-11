<?php

use App\Http\Middleware\CheckStatus;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\EmpleadoController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserAuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login',  'login');
});

//Route::middleware('checkStatus')->get('/empleado', [EmpleadoController::class, 'index']);

Route::middleware('auth:api')->group(function() {
    Route::post('/logout',  [UserAuthController::class, 'logout']);
    Route::resource('/empleado', EmpleadoController::class);
});
