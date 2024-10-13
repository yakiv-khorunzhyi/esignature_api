<?php

namespace App\Actions\Auth;

use App\Actions\ActionResultInterface;
use App\Actions\ActionInterface;
use App\Actions\ActionResult;
use App\Services\UserService;
use App\DTOs\DTOInterface;

class RegisterAction implements ActionInterface
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function execute(DTOInterface $user): ActionResult
    {
        $user = $this->userService->create($user);

        return ActionResult::create($user);
    }
}
