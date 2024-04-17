<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\OutageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('outages', OutageController::class);
Route::get('locations', [LocationController::class, 'index'])->name('locations.index');
