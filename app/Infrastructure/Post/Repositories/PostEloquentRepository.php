<?php

namespace App\Infrastructure\Post\Repositories;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostEloquentRepository implements PostRepository
{
    public function create(array $attributes): Post
    {
        return Post::create($attributes);
    }

    public function update(Post $post, array $attributes): bool
    {
        return $post->update($attributes);
    }

    public function delete(Post $post): bool
    {
        return $post->delete();
    }
}