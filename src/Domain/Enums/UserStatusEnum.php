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

}