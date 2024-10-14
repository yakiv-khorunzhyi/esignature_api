<?php

namespace App\DTOs;

class SignatureRequestDTO implements DTOInterface
{
    public function __construct(
        public int $fileId,
        public int $requesterId,
        public int $signerId
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['file_id'],
            $data['requester_id'],
            $data['signer_id'],
        );
    }
}
