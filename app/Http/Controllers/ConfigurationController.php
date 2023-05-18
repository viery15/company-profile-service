<?php

namespace App\Http\Controllers;

use App\Domain\Configuration\Services\ConfigurationService;

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
}
