<?php

namespace App\Actions;

use App\Services\FileService;
use App\DTOs\DTOInterface;

class UploadDocumentAction implements ActionInterface
{
    public function __construct(
        protected FileService $documentService
    ) {
    }

    public function execute(DTOInterface $document): ActionResult
    {
        $document = $this->documentService->upload($document);

        return ActionResult::create($document);
    }
}
