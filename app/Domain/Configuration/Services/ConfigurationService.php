<?php

namespace App\Domain\Configuration\Services;

use App\Domain\Configuration\Entities\Configuration;
use App\Domain\Configuration\Repositories\ConfigurationRepository;

class ConfigurationService
{
    protected $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function findAll(): array
    {
        return $this->configurationRepository->findAll();
    }

    public function update(Configuration $configuration, array $attributes): bool
    {
        return $this->configurationRepository->update($configuration, $attributes);
    }
}
