<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

abstract class AbstractEmailDriver implements SupportsEmail
{
    abstract public function make(Identifier $to): CreationResponse;

    abstract public function verify(Identifier $to, string $code): bool;
}
