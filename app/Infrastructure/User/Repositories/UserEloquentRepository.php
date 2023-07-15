<?php

namespace App\Infrastructure\User\Repositories;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepository;

class UserEloquentRepository implements UserRepository
{
    public function findAll(): array
    {
        return User::where(['isDeleted' => 0, 'isActive' => 1])->get()->toArray();
    }

    public function create(array $attributes): User
    {
        return User::create($attributes);
    }

    public function patch($id, array $attributes): bool
    {
        return User::where('id', $id)->update($attributes);
    }

    public function delete(String $id): bool
    {
        return User::where('id', $id)->update(['isDeleted' => 1, 'isActive' => 0]);
    }

    public function findOneByEmail(string $email): User
    {
        return User::where(['email' => $email, 'isDeleted' => 1])->first();
    }
}
