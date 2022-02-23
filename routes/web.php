<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\CommentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'index'])->name('home');

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {

    Route::get('post/{id}', [BlogController::class, 'post'])->name('post');

    Route::get('{source}/{id}/comments', [CommentsController::class, 'index'])->name('comments');
    Route::get('{source}/{id}/comments/create', [CommentsController::class, 'create'])->name('comments.create');
    Route::post('{source}/{id}/comments/create', [CommentsController::class, 'store'])->name('comments.store');

});

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

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('posts', PostsController::class);

        Route::resource('tags', TagsController::class);

        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::put('users/{id}', [UsersController::class, 'ban'])->name('users.ban');

        Route::get('history', [HistoryController::class, 'index'])->name('history');
    });

});
