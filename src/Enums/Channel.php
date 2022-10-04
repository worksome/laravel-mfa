<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

enum Channel: string
{
    case Email = 'email';
    case Sms = 'sms';
    case Totp = 'totp';

    public static function driverDescription(string $channel): string
    {
        return match (self::tryFrom($channel)) {
            self::Email => 'Email Driver',
            self::Sms => 'SMS Driver',
            self::Totp => 'TOTP Driver',
            default => 'Unknown Driver',
        };
    }
}
