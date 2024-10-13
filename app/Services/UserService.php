<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\DTOs\UserDTO;
use App\Models\User;

class UserService
{
    public function create(UserDTO $userDTO): User
    {
        return User::create([
            'name'     => $userDTO->name,
            'email'    => $userDTO->email,
            'password' => Hash::make($userDTO->password),
        ]);
    }
}
