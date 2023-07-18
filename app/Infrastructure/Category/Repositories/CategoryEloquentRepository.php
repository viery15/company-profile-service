<?php

namespace App\Infrastructure\Category\Repositories;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepository;

class CategoryEloquentRepository implements CategoryRepository
{
    public function findAll(): array
    {
        return Category::where('isDeleted', 0)->orderBy('seq', 'ASC')->with('posts')->get()->toArray();
    }

    public function create(array $attributes): Category
    {
        return Category::create($attributes);
    }

    public function patch($id, array $attributes): bool
    {
        return Category::where('id', $id)->update($attributes);
    }
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
