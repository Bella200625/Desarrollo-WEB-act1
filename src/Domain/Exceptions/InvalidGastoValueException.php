<?php

class InvalidGastoValueException extends InvalidArgumentException {
    public static function becauseValueIsNegative($value): self 
    {
        return new self('El valor del gasto ($value) debe ser mayor a cero.');
    }

    public static function becauseValueIsEmpty()
    {
        return new self('El valor del gasto no puede estar vacío.');
    }

}