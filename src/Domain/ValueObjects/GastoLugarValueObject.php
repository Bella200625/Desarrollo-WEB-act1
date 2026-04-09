<?php

class GastoLugarValueObject
{
    private string $nombreEmpresa;

    public function __construct(string $nombreEmpresa)
    {
        if (strlen($nombreEmpresa) < 3) {
            throw new InvalidArgumentException("El nombre de la empresa prestadora es demasiado corto.");
        }
        $this->nombreEmpresa = $nombreEmpresa;
    }

    public function getValue(): string
    {
        return $this->nombreEmpresa;
    }
}