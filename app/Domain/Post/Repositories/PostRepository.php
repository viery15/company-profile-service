<?php

namespace App\Domain\Post\Repositories;

use App\Domain\Post\Entities\Post;

interface PostRepository
{
    public function findAll(): array;
    public function findOneByPath(string $path): Post;
    public function create(array $attributes): Post;
    public function update(Post $post, array $attributes): bool;
    public function delete(string $id): bool;
}
