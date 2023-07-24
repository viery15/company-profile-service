<?php

namespace App\Domain\Post\Services;

use App\Domain\Catalog\Services\CatalogService;
use App\Domain\Post\Entities\Post;
use App\Domain\Post\Repositories\PostRepository;
use App\Domain\User\Services\UserService;
use App\Exceptions\CommonException;

class PostService
{
    protected $postRepository;
    protected $catalogService;
    protected $userService;

    public function __construct(PostRepository $postRepository, CatalogService $catalogService, UserService $userService)
    {
        $this->postRepository = $postRepository;
        $this->catalogService = $catalogService;
        $this->userService = $userService;
    }

    public function findAll($category, $limit): array
    {
        return $this->postRepository->findAll($category, $limit);
    }

    public function findAllFromAdmin(): array
    {
        $user = getUserFromToken();
        $userPermissions = $this->userService->getAndMapUserPostPermission($user->id);
        return $this->postRepository->findAll(null, null, $userPermissions);
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

        $createdPost = $this->postRepository->create($attributes);
        if (isset($attributes['catalog'])) {
            $this->catalogService->create([
                'path' => $attributes['catalog'],
                'description' => $attributes['catalogDescription'] ?? '',
                'postId' => $createdPost->id
            ]);
        }

        return $createdPost;
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
