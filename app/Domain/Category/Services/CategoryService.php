<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepository;
use App\Domain\User\Services\UserService;

class CategoryService
{
    protected $categoryRepository;
    protected $userService;

    public function __construct(CategoryRepository $categoryRepository, UserService $userService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->userService = $userService;
    }

    public function findAll($fromAdmin): array
    {
        return $this->categoryRepository->findAll(null, $fromAdmin);
    }

    public function findAllFromAdmin(): array
    {
        $user = getUserFromToken();
        $userPermissions = $this->userService->getAndMapUserPostPermission($user->id);
        return $this->categoryRepository->findAll($userPermissions, true);
    }

    public function create(array $attributes): Category
    {
        return $this->categoryRepository->create($attributes);
    }

    public function patch(string $id, array $category): bool
    {
        return $this->categoryRepository->patch($id, $category);
    }

    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
