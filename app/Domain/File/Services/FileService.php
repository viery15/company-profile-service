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
        $file->move(public_path('uploads'), $fileName);

        $fileModel = new File;
        $fileModel->path = 'uploads/' . $fileName;

        $fileModel->save();

        return asset('uploads/' . $fileName);
    }
}
