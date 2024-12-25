<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\SendPrestationController;


//PRODUCT
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

//PRESTATION
Route::apiResource('prestations', PrestationController::class);

//SEND PRESTATION
Route::resource('send-prestations', SendPrestationController::class);

//lOGIN
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);
});
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
