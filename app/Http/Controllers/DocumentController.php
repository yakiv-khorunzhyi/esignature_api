<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentUploadRequest;
use App\Actions\UploadDocumentAction;
use Illuminate\Http\JsonResponse;
use App\DTOs\DocumentUploadDTO;
use App\Traits\ApiResponse;

class DocumentController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *     path="/api/documents",
     *     summary="Upload a document",
     *     tags={"Documents"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                   @OA\Property(property="file", type="string", format="binary"),
     *                   required={"file"}
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Uploaded",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="file", type="object",
     *                     @OA\Property(property="id", type="integer", example=4)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     */
    public function upload(DocumentUploadRequest $request, UploadDocumentAction $action): JsonResponse
    {
        $actionResult = $action->execute(
            DocumentUploadDTO::fromArray($request->validated()),
        );

        return $this->responseCreated([
            'file' => [
                'id' => $actionResult->getData()->id,
            ],
        ]);
    }
}
