<?php

namespace App\Infrastructure\User\Repositories;

use App\Domain\User\Entities\UserPostPermission;
use App\Domain\User\Repositories\UserPostPermissionRepository;

class UserPostPermissionEloquentRepository implements UserPostPermissionRepository
{

    public function createMany(array $datas)
    {
        return UserPostPermission::insert($datas);
    }

    public function findByUserId(string $userId)
    {
        return UserPostPermission::where(['userId' => $userId])->get()->toArray();
    }
}
