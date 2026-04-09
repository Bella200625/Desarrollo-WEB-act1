<?php
class UserStatusEnum
{
    const ACTIVE   = 'ACTIVE';
    const INACTIVE = 'INACTIVE';
    const PENDING  = 'PENDING';
    const BLOCKED  = 'BLOCKED';
    public static function values(): array
    {
        return [self::ACTIVE, self::INACTIVE, self::PENDING, self::BLOCKED];
    }
    public static function isValid($value): bool
    {
        return in_array($value, self::values(), true);
    }
    public static function ensureIsValid($value): void
    {
        if (!self::isValid($value)) {
            // Excepcion DE STATUS
            throw InvalidUserStatusException::becauseValueIsInvalid($value);
        }
    }
}