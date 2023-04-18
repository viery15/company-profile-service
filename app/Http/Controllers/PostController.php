<?php

namespace App\Http\Controllers;

use App\Domain\Post\Services\PostService;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
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
}
