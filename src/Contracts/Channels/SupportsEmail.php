<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Contracts\Channels;

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Identifier;

/**
 * @extends ChannelDriver<EmailAddress>
 */
interface SupportsEmail extends ChannelDriver
{
    public function make(Identifier $to): CreationResponse;

    public function verify(Identifier $to, string $code): bool;
}
