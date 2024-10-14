<?php

namespace App\Actions;

use App\Services\SignatureService;
use App\DTOs\DTOInterface;

class CreateSignatureRequestAction implements ActionInterface
{
    public function __construct(
        protected SignatureService $service
    ) {
    }

    public function execute(DTOInterface $signatureRequest): ActionResult
    {
        $signatureRequest = $this->service->create($signatureRequest);

        return ActionResult::create($signatureRequest);
    }
}
