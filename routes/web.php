<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('posts', PostsController::class);
        Route::resource('tags', TagsController::class);

        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::put('users/{id}', [UsersController::class, 'ban'])->name('users.ban');

    });

});
