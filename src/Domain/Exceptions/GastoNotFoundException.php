<?php
class GastoNotFoundException extends DomainException {
    public static function becauseIdWasNotFound($id): self {
        return new self('No se encontró un gasto registrado con el ID: ' . $id);
    }
}