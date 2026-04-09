<?php

class GastoIdValueObject
{
    private int $value;

    public function __construct(int $value)
    {
        // No existen facturas con ID 0 o negativo
        if ($value <= 0) {
            throw new InvalidArgumentException("El ID del gasto debe ser un numero positivo.");
        }
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}