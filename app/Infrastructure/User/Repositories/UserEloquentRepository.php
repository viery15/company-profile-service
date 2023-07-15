<?php

namespace App\Infrastructure\User\Repositories;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepository;

class UserEloquentRepository implements UserRepository
{
    public function findAll(): array
    {
        return User::where('isDeleted', 0)->get()->toArray();
    }

    public function create(array $attributes): User
    {
        return User::create($attributes);
    }

    public function update(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }

    public function delete(String $id): bool
    {
        return User::where('id', $id)->update(['isDeleted' => 1]);
    }
}
