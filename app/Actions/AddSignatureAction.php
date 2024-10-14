<?php

namespace App\Actions;

use App\Services\SignatureRequestService;
use App\Services\SignatureService;
use App\DTOs\DocumentUploadDTO;
use App\Services\FileService;
use App\DTOs\DTOInterface;
use App\Enums\FileStatus;
use App\Enums\FileType;

class AddSignatureAction implements ActionInterface
{
    public function __construct(
        protected UploadDocumentAction $uploadDocumentAction,
        protected SignatureRequestService $signatureRequestService,
        protected SignatureService $signatureService,
        protected FileService $fileService
    ) {
    }

    public function execute(DTOInterface $signatureDTO): ActionResult
    {
        $signatureRequest = $this->signatureRequestService->getRepository()->find($signatureDTO->signatureRequestId);

        if ($signatureRequest === null || $signatureRequest->status === FileStatus::SIGNED->value) {
            return ActionResult::create();
        }

        $uploadDocumentActionResult = $this->uploadDocumentAction->execute(
            new DocumentUploadDTO($signatureDTO->signature, FileType::SIGNATURE->value)
        );

        $documentNeedToSign = $this->fileService->getRepository()
                                                ->find($signatureRequest->file_id);

        $signedDocument = $this->signatureService->makeSignedDocument(
            $documentNeedToSign,
            $uploadDocumentActionResult->getData()
        );

        $this->signatureRequestService->changeStatusToSigned(
            $signatureRequest,
            $uploadDocumentActionResult->getData()->id,
            $signedDocument->id
        );

        return ActionResult::create($signedDocument);
    }
}
