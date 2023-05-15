<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

interface UserRepository
{
    public function findAll(): array;
    public function create(array $attributes): User;
    public function update(User $user, array $attributes): bool;
    public function delete(User $user): bool;
}
