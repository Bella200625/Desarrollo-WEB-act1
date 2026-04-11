<?php
class GastoAlreadyExistsException extends DomainException {
    public static function becauseReferenceAlreadyExists($id) {
        return new self('Ya existe un gasto registrado con el ID: ' . $id);
    }
}