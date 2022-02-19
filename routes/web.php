<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('admin.index');
    });

});
