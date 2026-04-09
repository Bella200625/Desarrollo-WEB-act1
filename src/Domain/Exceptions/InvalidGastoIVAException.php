<?php
class InvalidGastoIVAException extends InvalidArgumentException {
    public static function becauseIVAIsInvalid($value) {
        return new self('El porcentaje de IVA no es válido: ' . $value . '%. Debe ser un número positivo.');
    }
}