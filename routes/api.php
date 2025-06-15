<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
//     Route::get('user', [UserAuthController::class, 'userInfo']);
//     Route::post('logout', [UserAuthController::class, 'logout']);
// });
// Route::prefix('v1')->group(function () {
//     Route::post('/register', [UserAuthController::class, 'register']);
//     Route::post('/login', [UserAuthController::class, 'login']);
// });
