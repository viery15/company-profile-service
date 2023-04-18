<?php

namespace App\Http\Controllers;

use App\Domain\Category\Services\CategoryService;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(CreateCategoryRequest $request)
    {
        $user = $this->categoryService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully.',
            'data' => $user,
        ], 201);
    }
}
