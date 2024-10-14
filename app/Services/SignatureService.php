<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\DTOs\SignatureRequestDTO;
use App\Models\SignatureRequest;
use App\Enums\FileStatus;
use App\Enums\FileType;
use App\Models\File;

class SignatureService
{
    public function __construct(
        protected FileService $fileService
    ) {
    }

    public function makeSignedDocument(File $documentNeedToSign, File $signature): File|null
    {
        $encryptedContent = file_get_contents(
            Storage::path($documentNeedToSign->path)
        );

        try {
            $decryptedContent = Crypt::decrypt($encryptedContent);
        } catch (DecryptException $e) {
            throw new \Exception('Decryption error: ' . $e->getMessage());
        }

        $signatureContent = file_get_contents(
            Storage::path($signature->path)
        );

        $documentHash  = hash('sha256', $decryptedContent);
        $signatureHash = hash('sha256', $signatureContent);
        $combinedHash  = hash('sha256', $documentHash . $signatureHash);

        $signedDocumentPath = 'documents/signed/' . uniqid() . '.s';
        Storage::put(
            $signedDocumentPath,
            Crypt::encrypt("{$combinedHash}\n{$signatureContent}")
        );

        return $this->fileService->create($signedDocumentPath, FileType::SIGNED_DOCUMENT->value);
    }

    public function create(SignatureRequestDTO $signatureRequestDTO): SignatureRequest
    {
        return SignatureRequest::create([
            'file_id'      => $signatureRequestDTO->fileId,
            'requester_id' => $signatureRequestDTO->requesterId,
            'signer_id'    => $signatureRequestDTO->signerId,
            'status'       => FileStatus::PENDING->value,
        ]);
    }
}
