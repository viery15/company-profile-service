<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

interface UserRepository
{
    public function findAll(): array;
    public function findOneByEmail(string $email): ?User;
    public function create(array $attributes): User;
    public function patch(string $id, array $attributes): bool;
    public function delete(String $id): bool;
}
