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
        $users = $this->userRepository->findAll();
        $result = [];
        foreach ($users as $user) {
            $user['postPermissions'] = $this->getAndMapUserPostPermission($user->id);
            array_push($result, $user);
        }

        return $result;
    }

    public function getAndMapUserPostPermission($userId)
    {
        $userPermissions = $this->userPostPermissionRepository->findByUserId($userId);
        $categoryIds = [];
        foreach ($userPermissions as $userPermission) {
            array_push($categoryIds, $userPermission['categoryId']);
        }

        return $categoryIds;
    }

    public function create(array $attributes): User
    {
        $userDeleted = $this->userRepository->findOneByEmail($attributes['email']);
        $createdUser = [];
        if ($userDeleted != null) {
            $this->patch($userDeleted->id, $attributes);
        } else {
            $createdUser = $this->userRepository->create($attributes);
        }

        if (isset($attributes['postPermissions'])) {
            $this->userPostPermissionRepository->deleteByUserId($createdUser->id);
            $this->createPostPermission($createdUser->id, $attributes['postPermissions']);
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
        $attributes['isDeleted'] = 0;
        $attributes['isActive'] = 1;
        if (isset($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        if (isset($attributes['postPermissions'])) {
            $this->userPostPermissionRepository->deleteByUserId($id);
            $this->createPostPermission($id, $attributes['postPermissions']);
        }
        unset($attributes['postPermissions']);

        return $this->userRepository->patch($id, $attributes);
    }

    public function delete(String $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
