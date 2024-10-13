<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function responseCreated(array $data = []): JsonResponse
    {
        return response()->json(['data' => $data], Response::HTTP_CREATED);
    }

    public function responseSuccess(array $data = []): JsonResponse
    {
        return response()->json(['data' => $data], Response::HTTP_OK);
    }

    public function responseUnprocessableEntity(array $errors): JsonResponse
    {
        return response()->json(['errors' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
