<?php

namespace App\Actions\Auth;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Actions\ActionInterface;
use App\Actions\ActionResult;
use App\DTOs\DTOInterface;

class LoginAction implements ActionInterface
{
    public function execute(DTOInterface $login): ActionResult
    {
        $credentials = ['email' => $login->email, 'password' => $login->password];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages(['email' => ['Incorrect email or password.']]);
        }

        $token = Auth::user()->createToken('api-token')->plainTextToken;

        return ActionResult::create($token);
    }
}
