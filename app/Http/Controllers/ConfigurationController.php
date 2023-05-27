<?php

namespace App\Http\Controllers;

use App\Domain\Configuration\Services\ConfigurationService;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected $configurationService;

    public function __construct(ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
    }

    public function findAll()
    {
        $result = $this->configurationService->findAll();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function patchBulk(Request $request)
    {
        $result = $this->configurationService->patchBulk($request->all());

        return response()->json([], 204);
    }
}
