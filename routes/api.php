<?php

use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'v1'], function () {
        Route::get('getProfile', [ProfileController::class, 'getProfile']);
    });
});
