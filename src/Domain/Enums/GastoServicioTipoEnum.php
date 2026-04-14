<?php

require_once __DIR__ . '/../Exceptions/InvalidServicioTipoException.php';

class GastoServicioTipoEnum
{
    const LUZ = 'LUZ';
    const AGUA = 'AGUA';
    const GAS = 'GAS';

    public static function values()
    {
        return array(self::LUZ, self::AGUA, self::GAS);
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidServicioTipoException::becauseValueIsInvalid($value);
        }
    }
}