<?php

namespace App\Domain\File\Repositories;

use App\Domain\File\Entities\File;

interface FileRepository
{
    public function create(array $attributes): File;
}
