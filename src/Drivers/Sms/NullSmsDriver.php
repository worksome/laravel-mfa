<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Sms;

use Worksome\MultiFactorAuth\DataValues\Identifier;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\AbstractSmsDriver;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeSmsVerification;
use Worksome\MultiFactorAuth\Enums\Status;

class NullSmsDriver extends AbstractSmsDriver
{
    use CanFakeSmsVerification;

    public static function make(): self
    {
        return new self();
    }

    public function make(Identifier $to): CreationResponse
    {
        return new CreationResponse($this->smsStatus ?? Status::PENDING);
    }

    public function verify(Identifier $to, string $code): bool
    {
        return $this->smsVerified ?? true;
    }
}
