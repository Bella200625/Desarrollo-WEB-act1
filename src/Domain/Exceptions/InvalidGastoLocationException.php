<?php
class InvalidGastoLocationException extends InvalidArgumentException {
    public static function becauseValueIsEmpty() {
        return new self('El lugar del gasto no puede estar vacío.');
    }
}