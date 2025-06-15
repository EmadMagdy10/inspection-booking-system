<?php

use Illuminate\Support\Facades\Route;
use Modules\Team\Http\Controllers\TeamController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('teams', TeamController::class)->names('team');
});

Route::middleware(['auth:sanctum'])->prefix('v1/teams')->group(function () {
    Route::get('/teams', [TeamController::class, 'index']);
    Route::middleware('role:admin')->post('/teams', [TeamController::class, 'store']);
});
