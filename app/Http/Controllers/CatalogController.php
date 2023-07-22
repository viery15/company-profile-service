<?php

namespace App\Http\Controllers;

use App\Domain\Catalog\Services\CatalogService;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    protected $catalogService;

    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }

    public function findAll()
    {
        $result = $this->catalogService->findAll();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function store(Request $request)
    {
        $result = $this->catalogService->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Catalog created successfully.',
            'data' => $result,
        ], 201);
    }
}
