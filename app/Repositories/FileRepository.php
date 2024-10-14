<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function find(int $documentId): File|null
    {
        return File::find($documentId);
    }
}
