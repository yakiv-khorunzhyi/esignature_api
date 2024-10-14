<?php

namespace App\Services;

use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\FileRepository;
use App\DTOs\DocumentUploadDTO;
use Illuminate\Support\Str;
use App\Models\File;
use Exception;

class FileService
{
    public function __construct(
        protected FileRepository $repository,
    ) {
    }

    public function upload(DocumentUploadDTO $documentDTO): File
    {
        $content          = FacadesFile::get($documentDTO->file->getPathname());
        $encryptedContent = Crypt::encrypt($content);

        $filePath   = 'documents/' . Str::uuid() . '.pdf';
        $isUploaded = Storage::put($filePath, $encryptedContent);

        if (!$isUploaded) {
            throw new Exception('Document is not uploaded.');
        }

        return $this->create($filePath, $documentDTO->type);
    }

    public function create(string $filePath, string $type): File
    {
        return File::create([
            'user_id' => auth()->id(),
            'path'    => $filePath,
            'type'    => $type,
        ]);
    }

    public function getRepository(): FileRepository
    {
        return $this->repository;
    }
}
