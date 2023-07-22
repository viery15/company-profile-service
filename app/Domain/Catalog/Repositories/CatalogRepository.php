<?php

namespace App\Domain\Catalog\Repositories;

use App\Domain\Catalog\Entities\Catalog;

interface CatalogRepository
{
    public function findAll(): array;
    public function create(array $attributes): Catalog;
}
