<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums\Sms;

enum Status: string
{
    case APPROVED = 'approved';
    case PENDING = 'pending';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';

    public static function fromTwilioVerify(string $status): self
    {
        return match ($status) {
            'approved' => self::APPROVED,
            'pending' => self::PENDING,
            'canceled' => self::CANCELLED,
            default => self::FAILED,
        };
    }
}
