<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::post('/categories', [CategoryController::class, 'store']);
});

Route::post('login', [LoginController::class, 'login']);
