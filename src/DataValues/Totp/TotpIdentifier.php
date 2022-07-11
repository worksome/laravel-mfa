<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\DataValues\Totp;

use Worksome\MultiFactorAuth\DataValues\Identifier;

class TotpIdentifier extends Identifier
{
    public function __construct(public readonly string $identifier, public readonly array $data = [])
    {
    }
}
