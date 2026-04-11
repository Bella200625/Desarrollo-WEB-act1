<?php
class InvalidGastoLugarException extends DomainException {
    public static function becauseValueIsEmpty(): self {
        return new self('El lugar del gasto no puede estar vacío.');
    }
}