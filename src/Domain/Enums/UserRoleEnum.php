<?php

class UserRoleEnum
{
    const ADMIN = 'ADMIN';
    const MEMBER = 'MEMBER';
    const REVIEWER = 'REVIEWER';
    public static function values(): array
    {
        return [self::ADMIN, self::MEMBER, self::REVIEWER];
    }
}