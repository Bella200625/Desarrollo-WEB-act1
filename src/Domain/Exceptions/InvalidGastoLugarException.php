<?php
class InvalidGastoLugarException extends InvalidArgumentException {
    public static function becauseValueIsEmpty(): self {
        return new self('El lugar del gasto no puede estar vacío.');
    }
    public static function becauseLengthIsTooShort($min)
    {
        return new self('El nombre del lugar debe tener al menos ' . $min . ' caracteres.');
    }
}