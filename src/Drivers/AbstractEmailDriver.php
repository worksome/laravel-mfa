<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;

abstract class AbstractEmailDriver implements SupportsEmail
{
    abstract public function sendEmail(EmailAddress $to): CreationResponse;

    abstract public function verifyEmail(EmailAddress $to, string $code): bool;
}
