<?php
class InvalidGastoIVAException extends InvalidArgumentException {
    public static function becauseIVAIsInvalid($value) {
        return new self('El valor del IVA (' . $value . '%) no es válido. Debe estar entre 0 y 100. ');
    }
}