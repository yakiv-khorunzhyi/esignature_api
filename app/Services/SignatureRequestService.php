<?php

namespace App\Services;

use App\Repositories\SignatureRequestRepository;
use App\Models\SignatureRequest;
use App\Enums\FileStatus;

class SignatureRequestService
{
    public function __construct(
        protected SignatureRequestRepository $repository
    ) {
    }

    public function changeStatusToSigned(
        SignatureRequest $signatureRequest,
        int $signatureId,
        int $signedDocumentId
    ): void {
        $signatureRequest->update([
            'signed_file_id' => $signedDocumentId,
            'signature_id'   => $signatureId,
            'status'         => FileStatus::SIGNED->value,
        ]);
    }

    public function getRepository(): SignatureRequestRepository
    {
        return $this->repository;
    }
}
