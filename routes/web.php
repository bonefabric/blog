<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/register', [AuthController::class, 'registerView']);

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('admin.index');
    });

});
