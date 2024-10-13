<?php

namespace App\Actions;

use App\DTOs\DTOInterface;

interface ActionInterface
{
    public function execute(DTOInterface $dto): ActionResult;
}
