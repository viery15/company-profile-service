<?php

namespace App\Infrastructure\File\Repositories;

use App\Domain\File\Entities\File;
use App\Domain\File\Repositories\FileRepository;

class FileEloquentRepository implements FileRepository
{
    public function create(array $attributes): File
    {
        return File::create($attributes);
    }
}
