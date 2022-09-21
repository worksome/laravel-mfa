<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Totp;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\Exceptions\Totp\InvalidTotpSecretException;

class TotpSecret extends Identifier
{
    public function __construct(public readonly string $data)
    {
        if ($this->data === '' || strlen($this->data) < 8) {
            throw new InvalidTotpSecretException(
                'The provided TOTP secret is not valid.'
            );
        }
    }
}
