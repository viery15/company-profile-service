<?php

namespace App\Http\Controllers;

use App\Domain\Post\Services\PostService;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function findAll(Request $request)
    {
        $categoryId = $request->query('categoryId', null);
        $limit = $request->query('limit', null);
        $result = $this->postService->findAll($categoryId, $limit);

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function findOneByPath(string $path)
    {
        $result = $this->postService->findOneByPath($path);

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function findOneById(string $id)
    {
        $result = $this->postService->findOneById($id);

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function latestPromo()
    {
        $result = $this->postService->findLatestPromo();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function store(CreatePostRequest $request)
    {
        $user = $this->postService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully.',
            'data' => $user,
        ], 201);
    }

    public function delete(string $id)
    {
        $this->postService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
        ], 200);
    }

    public function patch(Request $request)
    {
        $this->postService->patch($request->all());

        return response()->json([], 204);
    }
}
