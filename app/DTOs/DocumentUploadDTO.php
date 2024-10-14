<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;
use App\Enums\FileType;

class DocumentUploadDTO implements DTOInterface
{
    public function __construct(
        public UploadedFile $file,
        public string $type = FileType::DOCUMENT->value,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['file'],
            $data['type'] ?? FileType::DOCUMENT->value,
        );
    }
}
