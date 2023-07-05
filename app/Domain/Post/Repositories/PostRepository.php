<?php

namespace App\Domain\Post\Repositories;

use App\Domain\Post\Entities\Post;

interface PostRepository
{
    public function findAll($category, $limit): array;
    public function findOneByPath(string $path): Post;
    public function findOneById(string $id): Post;
    public function findLatestPromo(): Post;
    public function create(array $attributes): Post;
    public function patch(string $id, array $attributes): bool;
    public function delete(string $id): bool;
}
