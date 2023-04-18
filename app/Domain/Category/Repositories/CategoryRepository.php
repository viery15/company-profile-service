<?php

namespace App\Domain\Category\Repositories;

use App\Domain\Category\Entities\Category;

interface CategoryRepository
{
    public function create(array $attributes): Category;
    public function update(Category $category, array $attributes): bool;
    public function delete(Category $category): bool;
}
