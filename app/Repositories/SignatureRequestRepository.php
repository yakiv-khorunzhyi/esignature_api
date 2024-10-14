<?php

namespace App\Repositories;

use App\Models\SignatureRequest;

class SignatureRequestRepository
{
    public function find(int $signatureRequestId): SignatureRequest|null
    {
        return SignatureRequest::find($signatureRequestId);
    }
}
