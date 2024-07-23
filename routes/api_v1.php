<?php

use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\OutageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->apiResource('outages', OutageController::class);
Route::middleware('auth:sanctum')->apiResource('locations', LocationController::class);
