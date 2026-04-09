<?php

class GastoValorValueObject
{
    private float $valorSinIva;
    private float $iva;
    private float $valorTotal;

    public function __construct(float $valorSinIva, float $iva)
    {
        if ($valorSinIva < 0 || $iva < 0) {
            throw new InvalidArgumentException("Los valores de la factura no pueden ser negativos.");
        }

        $this->valorSinIva = $valorSinIva;
        $this->iva = $iva;   
        $this->valorTotal = $valorSinIva + $iva;
    }
    public function getValorSinIva(): float { return $this->valorSinIva; }
    public function getIva(): float { return $this->iva; }
    public function getValorTotal(): float { return $this->valorTotal; }
}