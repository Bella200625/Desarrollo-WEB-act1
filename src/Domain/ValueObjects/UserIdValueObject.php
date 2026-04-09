<?php

class UserIdValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException("El ID de usuario debe ser un numero positivo.");
        }
        $this->value = $value;
    }

    public function getValue(): int { return $this->value; }
}