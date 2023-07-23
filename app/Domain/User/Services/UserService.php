<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserPostPermissionRepository;
use App\Domain\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;
    protected $userPostPermissionRepository;

    public function __construct(UserRepository $userRepository, UserPostPermissionRepository $userPostPermissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->userPostPermissionRepository = $userPostPermissionRepository;
    }

    public function findAll(): array
    {
        return $this->userRepository->findAll();
    }

    public function create(array $attributes): User
    {
        $userDeleted = $this->userRepository->findOneByEmail($attributes['email']);
        if ($userDeleted != null) {
            $attributes['isDeleted'] = 0;
            $attributes['isActive'] = 1;
            $attributes['password'] = Hash::make($attributes['password']);
            $this->userRepository->patch($userDeleted['id'], $attributes);
            return $userDeleted;
        }
        $createdUser = $this->userRepository->create($attributes);

        if (isset($attributes['postPermission'])) {
            $this->createPostPermission($createdUser->id, $attributes['postPermission']);
        }

        return $createdUser;
    }

    function createPostPermission($userId, $categoryIds)
    {
        $datas = [];
        foreach ($categoryIds as $categoryId) {
            array_push($datas, ['userId' => $userId, 'categoryId' => $categoryId]);
        }

        $this->userPostPermissionRepository->createMany($datas);
    }

    public function patch(String $id, array $attributes): bool
    {
        return $this->userRepository->patch($id, $attributes);
    }

    public function delete(String $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
