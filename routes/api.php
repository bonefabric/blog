<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::post('/check', [AuthController::class, 'check']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('getProfile', [ProfileController::class, 'getProfile']);
    });
});
