<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class AddSignatureDTO implements DTOInterface
{
    public function __construct(
        public int $signatureRequestId,
        public UploadedFile $signature
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['signature_request_id'],
            $data['signature']
        );
    }
}
