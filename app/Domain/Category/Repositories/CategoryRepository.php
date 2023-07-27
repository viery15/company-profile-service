<?php

namespace App\Domain\Category\Repositories;

use App\Domain\Category\Entities\Category;

interface CategoryRepository
{
    public function findAll($ids = null, bool $fromAdmin = false): array;
    public function create(array $attributes): Category;
    public function patch(string $id, array $attributes): bool;
    public function delete(Category $category): bool;
}
