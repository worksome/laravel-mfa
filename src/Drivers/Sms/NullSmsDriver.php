<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers\Sms;

use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
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

    public function sendSms(E164PhoneNumber $to): CreationResponse
    {
        return new CreationResponse($this->smsStatus ?? Status::PENDING);
    }

    public function verifySms(E164PhoneNumber $to, string $code): bool
    {
        return $this->smsVerified ?? true;
    }
}
