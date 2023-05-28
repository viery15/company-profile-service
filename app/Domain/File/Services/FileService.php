<?php

namespace App\Domain\File\Services;

use App\Domain\File\Repositories\FileRepository;
use App\Domain\File\Entities\File;
use Illuminate\Support\Str;

class FileService
{
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function upload($file)
    {
        $fileName = Str::random(40) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $fileModel = new File;
        $fileModel->path = 'storage/images/' . $fileName;

        $fileModel->save();

        return asset('storage/images/' . $fileName);
    }
}
