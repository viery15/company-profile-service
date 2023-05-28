<?php

namespace App\Http\Controllers;

use App\Domain\File\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('file');
        $image = $this->fileService->upload($file);


        return response()->json([
            'message' => 'File uploaded successfully.',
            'image' => $image,
        ]);
    }
}
