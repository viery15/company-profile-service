<?php

namespace App\Domain\Auth;

use App\Exceptions\CommonException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Domain\User\Repositories\UserRepository;

class LoginService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials)
    {
        $token = JWTAuth::attempt($credentials);
        $userDeactivated = $this->userRepository->findOneByEmail($credentials['email']);

        if (!$token || ($userDeactivated != null && $userDeactivated['isActive'] == 0)) {
            throw new CommonException('Invalid Credentials', 'INVALID_CREDENTIALS', 401);
        }

        return $token;
    }
}
