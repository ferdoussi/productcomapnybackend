<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\SendPrestationController;
use App\Http\Controllers\TechnicienController;

//PRODUCT
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

//PRESTATION
//Route::apiResource('prestations', PrestationController::class);


// Retrieve all prestations
Route::get('prestations', [PrestationController::class, 'index']);

// Create a new prestation
Route::post('prestations', [PrestationController::class, 'store']);

// Retrieve a specific prestation by ID
Route::get('prestations/{user_id}', [PrestationController::class, 'show']);
Route::get('prestation/{vistid}', [PrestationController::class, 'getVist']);
// Update a specific prestation by ID
Route::put('prestations/{id}', [PrestationController::class, 'update']);

// Delete a specific prestation by ID
Route::delete('prestations/{id}', [PrestationController::class, 'destroy']);

//SEND PRESTATION
Route::resource('send-prestations', SendPrestationController::class);

//lOGIN
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getUser']);
});
//geting all technicien
Route::get('techniciens', [TechnicienController::class, 'getAllTechniciens']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
