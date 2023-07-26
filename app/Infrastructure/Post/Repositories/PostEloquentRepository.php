<?php

namespace App\Infrastructure\Post\Repositories;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostEloquentRepository implements PostRepository
{
    public function findAll($category = null, $limit = null, $includeCategory = null, $searchValue = null): array
    {
        $categoryId = $category != null ? $category : null;

        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->join('users', 'posts.updatedBy', '=', 'users.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail', 'users.name as createdByName')
            ->when($categoryId !== null, function ($query) use ($categoryId) {
                return $query->where('categoryId', $categoryId);
            })
            ->when($limit !== null, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->when($includeCategory !== null, function ($query) use ($includeCategory) {
                return $query->whereIn('categories.id', $includeCategory);
            })
            ->when($searchValue !== null, function ($query) use ($searchValue) {
                return $query->where('title', 'LIKE', '%' . $searchValue . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->get()->toArray();
    }

    public function findOneByPath(string $path): ?Post
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail')->where('path', $path)->first();
    }

    public function findOneById(string $id): Post
    {
        return Post::join('categories', 'posts.categoryId', '=', 'categories.id')
            ->leftJoin('catalogs', 'posts.id', '=', 'catalogs.postId')
            ->select('posts.*', 'categories.name as category', 'categories.thumbnail as categoryThumbnail', 'catalogs.path as catalog')
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
