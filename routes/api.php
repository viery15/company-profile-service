<?php

use App\Http\Controllers\CatalogController;
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
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::patch('/users/{id}', [UserController::class, 'patch']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/admin/posts', [PostController::class, 'findAllFromAdmin']);
    Route::delete('/posts/{id}', [PostController::class, 'delete']);
    Route::patch('/posts/{id}', [PostController::class, 'patch']);

    Route::post('/categories', [CategoryController::class, 'store']);
    Route::patch('/categories/{id}', [CategoryController::class, 'patch']);

    Route::patch('/configurations/bulk', [ConfigurationController::class, 'patchBulk']);

    Route::post('/upload', [FileController::class, 'upload']);

    Route::post('/catalogs', [CatalogController::class, 'store']);
});

Route::post('login', [LoginController::class, 'login']);
Route::get('/posts/{path}', [PostController::class, 'findOneByPath']);
Route::get('/posts/id/{id}', [PostController::class, 'findOneById']);
Route::get('/posts', [PostController::class, 'findAll']);
Route::get('/latest-promo', [PostController::class, 'latestPromo']);
Route::get('/configurations', [ConfigurationController::class, 'findAll']);

Route::get('/categories', [CategoryController::class, 'findAll']);
Route::get('/catalogs', [CatalogController::class, 'findAll']);
