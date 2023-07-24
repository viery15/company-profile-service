<?php

namespace App\Domain\Auth;

use App\Domain\User\Repositories\UserPostPermissionRepository;
use App\Exceptions\CommonException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Services\UserService;

class LoginService
{
    protected $userRepository;
    protected $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function login(array $credentials)
    {
        $token = JWTAuth::attempt($credentials);
        $userDeactivated = $this->userRepository->findOneByEmail($credentials['email']);

        if (!$token || ($userDeactivated != null && $userDeactivated['isActive'] == 0)) {
            throw new CommonException('Invalid Credentials', 'INVALID_CREDENTIALS', 401);
        }

        $user = JWTAuth::user();
        $userDetail = $this->userRepository->findOneById($user->id);
        $userPostPermissions = $this->userService->getAndMapUserPostPermission($user->id);
        $userDetail['postPermissions'] = $userPostPermissions;

        $tokenWithClaims = JWTAuth::claims($userDetail->toArray())->attempt($credentials);

        return $tokenWithClaims;
    }
}
