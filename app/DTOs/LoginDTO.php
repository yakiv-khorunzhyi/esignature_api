<?php

namespace App\DTOs;

class LoginDTO implements DTOInterface
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
            $data['password'],
        );
    }
}
