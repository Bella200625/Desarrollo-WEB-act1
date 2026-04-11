<?php
class InvalidGastoDescriptionException extends InvalidArgumentException {
    public static function becauseValueIsEmpty() {
        return new self('La descripción del gasto no puede estar vacía.');
    }
}