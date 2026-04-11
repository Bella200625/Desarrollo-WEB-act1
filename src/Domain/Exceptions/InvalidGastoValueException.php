<?php

class InvalidGastoValueException extends InvalidArgumentException {
    public static function becauseValueIsNegative($value): self 
    {
        return new self("El valor del gasto ($value) no puede ser negativo o cero.");
    }

}