<?php

namespace App\Infrastructure\Category\Repositories;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepository;

class CategoryEloquentRepository implements CategoryRepository
{
    public function findAll(): array
    {
        return Category::orderBy('seq', 'ASC')->with('posts')->get()->toArray();
    }

    public function create(array $attributes): Category
    {
        return Category::create($attributes);
    }

    public function update(Category $category, array $attributes): bool
    {
        return $category->update($attributes);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
