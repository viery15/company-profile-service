<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigurationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/users', [UserController::class, 'findAll']);
    Route::post('/users', [UserController::class, 'store']);

    Route::post('/posts', [PostController::class, 'store']);

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'findAll']);

    Route::get('/configurations', [ConfigurationController::class, 'findAll']);
    Route::patch('/configurations/bulk', [ConfigurationController::class, 'patchBulk']);
});

Route::post('login', [LoginController::class, 'login']);
