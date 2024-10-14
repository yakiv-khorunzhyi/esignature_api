<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignatureRequestRequest;
use App\Actions\CreateSignatureRequestAction;
use App\Http\Requests\AddSignatureRequest;
use App\Actions\AddSignatureAction;
use App\DTOs\SignatureRequestDTO;
use Illuminate\Http\JsonResponse;
use App\DTOs\AddSignatureDTO;
use App\Traits\ApiResponse;

class SignatureController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Post(
     *     path="/api/signature-requests",
     *     summary="Send a signature request to a user",
     *     tags={"Signature"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"file_id", "signer_id"},
     *             @OA\Property(property="file_id", type="integer", example="2", description="ID of the document"),
     *             @OA\Property(property="signer_id", type="integer", example="1", description="ID of the user to sign the document")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Signature request sent successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="signature_request", type="object",
     *                     @OA\Property(property="file_id", type="integer", example=2),
     *                     @OA\Property(property="requester_id", type="integer", example=1),
     *                     @OA\Property(property="signer_id", type="integer", example=1),
     *                     @OA\Property(property="status", type="string", example="pending"),
     *                     @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-14T16:23:05.000000Z"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-14T16:23:05.000000Z"),
     *                     @OA\Property(property="id", type="integer", example=1)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    public function sendSignatureRequest(
        SignatureRequestRequest $request,
        CreateSignatureRequestAction $action
    ): JsonResponse {
        $actionResult = $action->execute(
            SignatureRequestDTO::fromArray(
                $request->validated() + ['requester_id' => auth()->id()]
            ),
        );

        return $this->responseCreated(['signature_request' => $actionResult->getData()]);
    }

    /**
     * @OA\Post(
     *     path="/api/signature-requests/{id}",
     *     summary="Sign document",
     *     tags={"Signature"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the signature request",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                   @OA\Property(property="signature", type="string", format="binary"),
     *                   required={"signature"}
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Signature successfully added"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
     */
    public function addSignature(int $id, AddSignatureRequest $request, AddSignatureAction $action): JsonResponse
    {
        $action->execute(
            new AddSignatureDTO($id, $request->validated('signature')),
        );

        return $this->responseSuccess([]);
    }
}
