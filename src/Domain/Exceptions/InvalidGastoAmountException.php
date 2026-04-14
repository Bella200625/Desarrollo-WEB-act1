<?php
class InvalidGastoAmountException extends InvalidArgumentException {
    public static function becauseAmountIsNegative($value): self 
    {
        return new self('El valor del gasto ($value) debe ser mayor a cero.');
    }

    public static function becauseValueIsEmpty(): self
    {
        return new self('El valor del gasto no puede estar vacío.');
    }

    public static function becauseValueIsNotNumeric($value): self
    {
        return new self('El valor del gasto debe ser un número válido, pero recibimos: "' . $value . '"');
    }
}