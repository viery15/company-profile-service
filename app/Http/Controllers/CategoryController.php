<?php

namespace App\Http\Controllers;

use App\Domain\Category\Services\CategoryService;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function findAll()
    {
        $result = $this->categoryService->findAll();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function findAllFromAdmin()
    {
        $result = $this->categoryService->findAllFromAdmin();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function store(CreateCategoryRequest $request)
    {
        $result = $this->categoryService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully.',
            'data' => $result,
        ], 201);
    }

    public function patch(string $id, Request $request)
    {
        $this->categoryService->patch($id, $request->all());

        return response()->json([], 204);
    }
}
