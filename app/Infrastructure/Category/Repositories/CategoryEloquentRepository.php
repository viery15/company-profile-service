<?php

namespace App\Infrastructure\Category\Repositories;

use App\Domain\Category\Entities\Category;
use App\Domain\Category\Repositories\CategoryRepository;

class CategoryEloquentRepository implements CategoryRepository
{
    public function findAll($ids = null, $fromAdmin = false): array
    {
        return Category::join('users', 'categories.updatedBy', '=', 'users.id')
            ->select('categories.*', 'users.name as updatedByName')
            ->where('categories.isDeleted', 0)
            ->orderBy('seq', 'ASC')
            ->with('posts')
            ->when($ids !== null, function ($query) use ($ids) {
                return $query->whereIn('categories.id', $ids);
            })
            ->when($fromAdmin == false, function ($query) use ($fromAdmin) {
                return $query->where('categories.isActive', 1);
            })
            ->get()
            ->toArray();
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
