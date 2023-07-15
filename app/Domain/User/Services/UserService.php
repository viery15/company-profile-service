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
            $this->userRepository->patch($userDeleted['id'], $attributes);
            return $userDeleted;
        }

        return $this->userRepository->create($attributes);
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
