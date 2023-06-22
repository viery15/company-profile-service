<?php

namespace App\Domain\Post\Services;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function findAll($category): array
    {
        return $this->postRepository->findAll($category);
    }

    public function findOneByPath(string $path): Post
    {
        return $this->postRepository->findOneByPath($path);
    }

    public function findOneById(string $id): Post
    {
        return $this->postRepository->findOneById($id);
    }

    public function findLatestPromo(): Post
    {
        return $this->postRepository->findLatestPromo();
    }

    public function create(array $attributes): Post
    {
        $user = getUserFromToken();
        $attributes['createdBy'] = $user->id;
        return $this->postRepository->create($attributes);
    }

    public function patch(array $post): bool
    {
        return $this->postRepository->patch($post['id'], $post);
    }

    public function delete(string $id): bool
    {
        return $this->postRepository->delete($id);
    }
}
