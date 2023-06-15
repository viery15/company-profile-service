<?php

namespace App\Infrastructure\Post\Repositories;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostEloquentRepository implements PostRepository
{
    public function findAll($category): array
    {
        $categoryId = $category != null ? $category : null;

        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')
            ->when($categoryId !== null, function ($query) use ($categoryId) {
                return $query->where('categoryId', $categoryId);
            })
            ->get()->toArray();
    }

    public function findOneByPath(string $path): Post
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')->where('path', $path)->first();
    }

    public function findLatestPromo(): Post
    {
        return Post::where('categoryId', 2)->latest()->first();
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
