<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CityController;

Route::get('/api/cities', [CityController::class, 'index']);
Route::get('/api/cities/{city}', [CityController::class, 'show']);
Route::post('/api/cities', [CityController::class, 'store']);
Route::put('/api/cities/{city}', [CityController::class, 'update']);
Route::delete('/api/cities/{city}', [CityController::class, 'destroy']);
