<?php
class GastoNotFoundException extends DomainException {
    public static function becauseIdWasNotFound($id) {
        return new self('No se encontró ningún gasto con el ID: ' . $id);
    }
}