<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// CityController
Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{id}', [CityController::class, 'show']);
Route::post('/cities', [CityController::class, 'store']);
Route::put('/cities/{id}', [CityController::class, 'update']);
Route::delete('/cities/{id}', [CityController::class, 'destroy']);

// CountyController
Route::get('/counties', [CountyController::class, 'index']);
Route::get('/counties/{id}', [CountyController::class, 'show']);
Route::post('/counties', [CountyController::class, 'store']);
Route::put('/counties/{id}', [CountyController::class, 'update']);
Route::delete('/counties/{id}', [CountyController::class, 'destroy']);