<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/users', [UserController::class, 'store']);

Route::post('login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!$token = Auth::guard('jwt')->attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    return response()->json(['token' => $token]);
});
