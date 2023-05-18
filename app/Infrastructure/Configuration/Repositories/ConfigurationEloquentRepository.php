<?php

namespace App\Infrastructure\Configuration\Repositories;

use App\Domain\Configuration\Entities\Configuration;
use App\Domain\Configuration\Repositories\ConfigurationRepository;

class ConfigurationEloquentRepository implements ConfigurationRepository
{
    public function findAll(): array
    {
        return Configuration::get()->toArray();
    }

    public function update(Configuration $configuration, array $attributes): bool
    {
        return $configuration->update($attributes);
    }
}
