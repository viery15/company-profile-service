<?php

namespace App\Domain\Configuration\Repositories;

use App\Domain\Configuration\Entities\Configuration;

interface ConfigurationRepository
{
    public function findAll(): array;
    public function update(Configuration $configuration, array $attributes): bool;
}
