<?php

namespace App\DTOs;

interface DTOInterface
{
    public static function fromArray(array $data): self;
}
