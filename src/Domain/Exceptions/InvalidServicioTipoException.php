<?php

class InvalidServicioTipoException extends InvalidArgumentException {
    public static function becauseValueIsInvalid($value) {
        return new self("El tipo de servicio '$value' no es válido. Solo se permite: LUZ, AGUA o GAS.");    }
}