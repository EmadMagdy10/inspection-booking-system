<?php

use Illuminate\Support\Facades\Route;
use Modules\Availability\Http\Controllers\TimeSlotController;
use Modules\Availability\Http\Controllers\AvailabilityController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('availabilities', AvailabilityController::class)->names('availability');
// });

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::get('/teams/{id}/generate-slots', [TimeSlotController::class, 'index']);
    Route::post('/teams/{id}/availability', [AvailabilityController::class, 'store']);
});
