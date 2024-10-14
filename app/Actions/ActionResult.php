<?php

namespace App\Actions;

class ActionResult
{
    public function __construct(
        protected mixed $result
    ) {
    }

    public static function create(mixed $result = null): self
    {
        return new self($result);
    }

    public function getData(): mixed
    {
        return $this->result;
    }
}
