<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PlaceController;

Route::prefix('/dashboard')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);
    Route::post('/countries', [CountryController::class, 'store']);
    Route::get('/countries/{id}', [CountryController::class, 'show']);
    Route::put('/countries/{id}', [CountryController::class, 'update']);
    Route::delete('/countries/{id}', [CountryController::class, 'destroy']);

    Route::get('/provinces', [ProvinceController::class, 'index']);
    Route::post('/provinces', [ProvinceController::class, 'store']);
    Route::get('/provinces/{id}', [ProvinceController::class, 'show']);
    Route::put('/provinces/{id}', [ProvinceController::class, 'update']);
    Route::delete('/provinces/{id}', [ProvinceController::class, 'destroy']);

    Route::get('/places', [PlaceController::class, 'index']);
    Route::post('/places', [PlaceController::class, 'store']);
    Route::get('/places/{id}', [PlaceController::class, 'show']);
    Route::put('/places/{id}', [PlaceController::class, 'update']);
    Route::delete('/places/{id}', [PlaceController::class, 'destroy']);
});
