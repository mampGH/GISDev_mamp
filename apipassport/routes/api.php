<?php

use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
 });

Route::post('/register', [UserAuthController::class, 'register']);
Route::post('/login',  [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::post('/logout',  [UserAuthController::class, 'logout']);
    Route::resource('/empleado', EmpleadoController::class);
});
