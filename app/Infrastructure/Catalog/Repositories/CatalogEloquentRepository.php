<?php

namespace App\Infrastructure\Catalog\Repositories;

use App\Domain\Catalog\Entities\Catalog;
use App\Domain\Catalog\Repositories\CatalogRepository;

class CatalogEloquentRepository implements CatalogRepository
{
    public function findAll(): array
    {
        return Catalog::join('posts', 'catalogs.postId', '=', 'posts.id')
            ->select('catalogs.*', 'posts.title as postTitle', 'posts.path as postPath')
            ->orderBy('created_at', 'ASC')
            ->get()
            ->toArray();
    }

    public function create(array $attributes): Catalog
    {
        return Catalog::create($attributes);
    }
}
