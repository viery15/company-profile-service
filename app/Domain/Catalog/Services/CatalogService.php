<?php

namespace App\Domain\Catalog\Services;

use App\Domain\Catalog\Entities\Catalog;
use App\Domain\Catalog\Repositories\CatalogRepository;

class CatalogService
{
    protected $catalogRepository;

    public function __construct(CatalogRepository $catalogRepository)
    {
        $this->catalogRepository = $catalogRepository;
    }

    public function findAll(): array
    {
        return $this->catalogRepository->findAll();
    }

    public function create($attributes): Catalog
    {
        $user = getUserFromToken();
        $attributes['updatedBy'] = $user->id;
        return $this->catalogRepository->create($attributes);
    }
}
