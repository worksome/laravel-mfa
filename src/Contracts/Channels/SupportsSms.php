<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;

/**
 * @extends ChannelDriver<E164PhoneNumber>
 */
interface SupportsSms extends ChannelDriver
{
    public function make(Identifier $to): CreationResponse;

    public function verify(Identifier $to, string $code): bool;
}
