<?php
require_once __DIR__ . '/../Exceptions/InvalidUserRoleException.php';
class UserRoleEnum
{
    const ADMIN = 'ADMIN';
    const MEMBER = 'MEMBER';
    const REVIEWER = 'REVIEWER';
    public static function values(): array
    {
        return [self::ADMIN, self::MEMBER, self::REVIEWER];
    }

    public static function isValid($value): bool
    {
        return in_array($value, self::values(), true);
    }
    //TIRA LA EXCEPCION SI ES FALSE 
    public static function ensureIsValid($value): void
    {
        if (!self::isValid($value)) {
            // EXCEPCIÓN
            throw InvalidUserRoleException::becauseValueIsInvalid($value);
        }
    }

}