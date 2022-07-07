<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Enums;

use Worksome\MultiFactorAuth\Exceptions\BaseException;

enum HashAlgorithm: string
{
    case SHA1 = 'SHA1';
    case SHA256 = 'SHA256';
    case SHA512 = 'SHA512';

    public static function fromTwilioVerify(string $algorithm): self
    {
        return match (strtoupper($algorithm)) {
            'SHA1' => self::SHA1,
            'SHA256' => self::SHA256,
            'SHA512' => self::SHA512,
            default => throw new BaseException("Invalid hash algorithm returned from Twilio Verify: {$algorithm}"),
        };
    }
}
