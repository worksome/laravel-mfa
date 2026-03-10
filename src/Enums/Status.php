<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

enum Status: string
{
    case Approved = 'approved';
    case Pending = 'pending';
    case Cancelled = 'cancelled';
    case Failed = 'failed';

    public static function fromTwilioVerify(string $status): self
    {
        return match ($status) {
            'approved' => self::Approved,
            'pending', 'unverified' => self::Pending,
            'canceled' => self::Cancelled,
            default => self::Failed,
        };
    }
}
