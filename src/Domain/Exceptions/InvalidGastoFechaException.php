<?php
class InvalidGastoFechaException extends InvalidArgumentException
{
    public static function becauseFormatIsInvalid($fecha): self
    {
        return new self('El formato de la fecha es inválido: ' . $fecha . '. Use YYYY-MM-DD.');
    }

    public static function becauseValueIsEmpty(): self
    {
        return new self('La fecha del gasto no puede estar vacía.');
    }
}