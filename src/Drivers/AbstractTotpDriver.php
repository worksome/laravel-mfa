<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsTotp;
use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;

abstract class AbstractTotpDriver implements SupportsTotp
{
    abstract public function make(Identifier $to): CreationResponse;

    abstract public function verify(Identifier $to, string $code): bool;
}
