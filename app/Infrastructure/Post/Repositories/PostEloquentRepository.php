<?php

namespace App\Infrastructure\Post\Repositories;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostEloquentRepository implements PostRepository
{
    public function findAll(): array
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category')
            ->get()->toArray();
    }

    public function create(array $attributes): Post
    {
        return Post::create($attributes);
    }

    public function update(Post $post, array $attributes): bool
    {
        return $post->update($attributes);
    }

    public function delete(string $id): bool
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }

        return true;
    }
}
