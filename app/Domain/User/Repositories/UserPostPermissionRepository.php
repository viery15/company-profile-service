<?php

namespace App\Domain\User\Repositories;

interface UserPostPermissionRepository
{
    public function createMany(array $datas);
    public function findByUserId(string $userId);
    public function deleteByUserId(string $userId);
}
