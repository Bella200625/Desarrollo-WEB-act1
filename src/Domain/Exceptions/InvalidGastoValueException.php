<?php

class InvalidGastoValueException extends InvalidArgumentException {
    public static function becauseValueIsNegative($value) {
        return new self('El valor del gasto no puede ser negativo: ' . $value);
    }
    public static function becauseValueIsEmpty() {
        return new self('El valor del gasto no puede estar vacío.');
    }
}