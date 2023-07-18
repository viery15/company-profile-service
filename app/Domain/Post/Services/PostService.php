<?php

namespace App\Domain\Post\Services;

use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;
use App\Exceptions\CommonException;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function findAll($category, $limit): array
    {
        return $this->postRepository->findAll($category, $limit);
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
        $attributes['updatedBy'] = $user->id;
        $attributes['path'] = $this->validateAndGeneratePathByTitle($attributes['title']);

        return $this->postRepository->create($attributes);
    }

    function validateAndGeneratePathByTitle(string $title)
    {
        $path = strtolower(str_replace(' ', '-', $title));
        $pathExist = $this->postRepository->findOneByPath($path);
        if ($pathExist != null) {
            throw new CommonException("Post with title '$title' already exists, please change the title", 'POST_EXISTS', 400);
        }

        return $path;
    }

    public function patch(array $post): bool
    {
        $user = getUserFromToken();
        $post['updatedBy'] = $user->id;
        return $this->postRepository->patch($post['id'], $post);
    }

    public function delete(string $id): bool
    {
        return $this->postRepository->delete($id);
    }
}
