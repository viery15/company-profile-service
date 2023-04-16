<?php

namespace App\Domain\User\Services;

use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $attributes): User
    {
        return $this->userRepository->create($attributes);
    }

    public function update(User $user, array $attributes): bool
    {
        return $this->userRepository->update($user, $attributes);
    }

    public function delete(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
