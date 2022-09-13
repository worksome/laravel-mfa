<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeEmailVerification;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeSmsVerification;
use Worksome\MultiFactorAuth\Enums\Status;

class NullDriver implements Driver, SupportsSms, SupportsEmail
{
    use CanFakeEmailVerification;
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

    public function sendEmail(EmailAddress $to): CreationResponse
    {
        return new CreationResponse($this->emailStatus ?? Status::PENDING);
    }

    public function verifyEmail(EmailAddress $to, string $code): bool
    {
        return $this->emailVerified ?? true;
    }
}
