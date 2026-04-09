<?php

class GastoCategoryEnum
{
    const ENERGIA_ELECTRICA = 'ENERGIA_ELECTRICA';
    const AGUA_Y_ALCANTARILLADO = 'AGUA_Y_ALCANTARILLADO';
    const GAS_NATURAL = 'GAS_NATURAL';
    const ASEO_Y_RECOLECCION = 'ASEO_Y_RECOLECCION';
    const OTROS_SERVICIOS = 'OTROS_SERVICIOS';

    public static function values(): array
    {
        return [
            self::ENERGIA_ELECTRICA,
            self::AGUA_Y_ALCANTARILLADO,
            self::GAS_NATURAL,
            self::ASEO_Y_RECOLECCION,
            self::OTROS_SERVICIOS
        ];
    }
}