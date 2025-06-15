<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('users', UserController::class)->names('user');
// });

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('v1/users/register', [UserController::class, 'registerUser']);
});
