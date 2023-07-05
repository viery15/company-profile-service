<?php

namespace App\Infrastructure\Post\Repositories;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostEloquentRepository implements PostRepository
{
    public function findAll($category, $limit = null): array
    {
        $categoryId = $category != null ? $category : null;

        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')
            ->when($categoryId !== null, function ($query) use ($categoryId) {
                return $query->where('categoryId', $categoryId);
            })
            ->when($limit !== null, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->orderBy('created_at', 'DESC')
            ->get()->toArray();
    }

    public function findOneByPath(string $path): Post
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')->where('path', $path)->first();
    }

    public function findOneById(string $id): Post
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')
            ->where('posts.id', $id)
            ->first();
    }

    public function findLatestPromo(): Post
    {
        return Post::where('categoryId', 2)->latest()->first();
    }

    public function create(array $attributes): Post
    {
        return Post::create($attributes);
    }

    public function patch($id, array $attributes): bool
    {
        return Post::where('id', $id)->update($attributes);
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
