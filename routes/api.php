<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/users', [UserController::class, 'findAll']);
    Route::post('/users', [UserController::class, 'store']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::delete('/posts/{id}', [PostController::class, 'delete']);
    Route::patch('/posts/{id}', [PostController::class, 'patch']);

    Route::post('/categories', [CategoryController::class, 'store']);

    Route::patch('/configurations/bulk', [ConfigurationController::class, 'patchBulk']);

    Route::post('/upload', [FileController::class, 'upload']);
});

Route::post('login', [LoginController::class, 'login']);
Route::get('/posts/{path}', [PostController::class, 'findOneByPath']);
Route::get('/posts/id/{id}', [PostController::class, 'findOneById']);
Route::get('/posts', [PostController::class, 'findAll']);
Route::get('/latest-promo', [PostController::class, 'latestPromo']);
Route::get('/configurations', [ConfigurationController::class, 'findAll']);

Route::get('/categories', [CategoryController::class, 'findAll']);
