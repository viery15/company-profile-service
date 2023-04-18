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

    public function create(array $attributes): Post
    {
        return $this->postRepository->create($attributes);
    }

    public function update(Post $post, array $attributes): bool
    {
        return $this->postRepository->update($post, $attributes);
    }

    public function delete(Post $post): bool
    {
        return $this->postRepository->delete($post);
    }
}
