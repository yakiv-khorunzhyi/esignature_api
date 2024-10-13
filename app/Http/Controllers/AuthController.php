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

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="Yakiv Khorunzhyi"),
     *             @OA\Property(property="email", type="string", format="email", example="yakiv.khorunzhyi@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Registered",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                      property="user",
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=4),
     *                      @OA\Property(property="name", type="string", example="Yakiv Khorunzhyi"),
     *                      @OA\Property(property="email", type="string", example="yakiv.khorunzhyi@gmail.com"),
     *                      @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-13T11:31:32.000000Z"),
     *                      @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-13T11:31:32.000000Z")
     *                  )
     *              )
     *          )
     *     )
     * )
     */
    public function register(RegisterRequest $request, RegisterAction $action): JsonResponse
    {
        $actionResult = $action->execute(
            UserDTO::fromArray($request->validated())
        );

        return $this->responseCreated(['user' => $actionResult->getData()]);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="yakiv.khorunzhyi@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(property="token", type="string", example="2|zSNFl1lPnucDwbgFTuylT1nc7cjRtMDrUjRW1eys88f2682a")
     *              )
     *          )
     *     )
     * )
     */
    public function login(LoginRequest $request, LoginAction $action): JsonResponse
    {
        $actionResult = $action->execute(
            LoginDTO::fromArray($request->validated())
        );

        return $this->responseSuccess(['token' => $actionResult->getData()]);
    }
}
