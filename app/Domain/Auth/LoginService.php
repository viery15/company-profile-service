<?php

namespace App\Domain\Auth;

use App\Exceptions\CommonException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login(array $credentials)
    {
        if (!$token = Auth::guard('jwt')->attempt($credentials)) {
            throw new CommonException('Invalid Credentials', 'INVALID_CREDENTIALS', 401);
        }

        return $token;
    }
}
