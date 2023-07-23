<?php

namespace App\Domain\User\Repositories;

interface UserPostPermissionRepository
{
    public function createMany(array $datas);
}
