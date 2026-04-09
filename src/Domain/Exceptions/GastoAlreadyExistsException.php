<?php
class GastoAlreadyExistsException extends DomainException {
    public static function becauseReferenceAlreadyExists($ref) {
        return new self('Este gasto ya fue registrado con la referencia: ' . $ref);
    }
}