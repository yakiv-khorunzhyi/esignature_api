<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Actions\Auth\RegisterAction;
use Illuminate\Http\JsonResponse;
use App\Actions\Auth\LoginAction;
use App\Traits\ApiResponse;
use App\DTOs\LoginDTO;
use App\DTOs\UserDTO;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $actionResult = $action->execute(
            UserDTO::fromArray($request->validated())
        );

        return $this->responseCreated(['user' => $actionResult->getData()]);
    }

    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $actionResult = $action->execute(
            LoginDTO::fromArray($request->validated())
        );

        return $this->responseSuccess(['token' => $actionResult->getData()]);
    }
}
