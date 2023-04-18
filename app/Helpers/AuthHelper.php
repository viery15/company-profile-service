<?php

use App\Domain\User\Entities\User;
use Tymon\JWTAuth\Facades\JWTAuth;

function getUserFromToken(): User
{
    $user = null;

    if (JWTAuth::check()) {
        $user = JWTAuth::user();
    }

    return $user;
}
