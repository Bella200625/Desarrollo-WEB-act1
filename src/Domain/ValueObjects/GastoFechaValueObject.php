<?php

class GastoFechaValueObject
{
    private string $fecha;

    public function __construct(string $fecha)
    {
        if (empty($fecha)) {
            throw new InvalidArgumentException("La fecha de la factura es obligatoria.");
        }
        $this->fecha = $fecha;
    }

    public function getValue(): string { return $this->fecha; }
}