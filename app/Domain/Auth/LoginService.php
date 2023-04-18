<?php

namespace App\Domain\Auth;

use App\Exceptions\CommonException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService
{
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new CommonException('Invalid Credentials', 'INVALID_CREDENTIALS', 401);
        }

        return $token;
    }
}
