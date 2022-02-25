<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [AuthController::class, 'login'])->name('spa-auth');


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'v1'], function () {
        Route::get('getProfile', [ProfileController::class, 'getProfile']);
    });
});
