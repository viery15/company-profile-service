<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $attributes): Category
    {
        return $this->categoryRepository->create($attributes);
    }

    public function update(Category $category, array $attributes): bool
    {
        return $this->categoryRepository->update($category, $attributes);
    }

    public function delete(Category $category): bool
    {
        return $this->categoryRepository->delete($category);
    }
}
