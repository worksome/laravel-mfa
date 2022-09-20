<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Email;

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\AbstractEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeEmailVerification;
use Worksome\MultiFactorAuth\Enums\Status;

class NullEmailDriver extends AbstractEmailDriver
{
    use CanFakeEmailVerification;

    public static function make(): self
    {
        return new self();
    }

    public function send(Identifier $to): CreationResponse
    {
        return new CreationResponse($this->emailStatus ?? Status::PENDING);
    }

    public function verify(Identifier $to, string $code): bool
    {
        return $this->emailVerified ?? true;
    }
}
