<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Auth\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->loginService->login($credentials);

        return response()->json(['token' => $token]);
    }
}
