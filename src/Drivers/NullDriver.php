<?php

declare(strict_types=1);

namespace Worksome\MultiFactorAuth\Drivers;

use Worksome\MultiFactorAuth\Contracts\Channels\SupportsEmail;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsSms;
use Worksome\MultiFactorAuth\Contracts\Channels\SupportsTotp;
use Worksome\MultiFactorAuth\Contracts\Driver;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeEmailVerification;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeSmsVerification;
use Worksome\MultiFactorAuth\Drivers\Concerns\CanFakeTotpVerification;
use Worksome\MultiFactorAuth\Enums\HashAlgorithm;
use Worksome\MultiFactorAuth\Enums\Status;

class NullDriver implements Driver, SupportsSms, SupportsEmail, SupportsTotp
{
    use CanFakeEmailVerification;
    use CanFakeSmsVerification;
    use CanFakeTotpVerification;

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

    public function createTotp(string $issuer, string $identifier, string $label): TotpResponse
    {
        return new TotpResponse(
            $identifier,
            $this->totpStatus ?? Status::PENDING,
            new TotpSecret('ABCDEFGHIJKLMNOP', $issuer, $identifier, HashAlgorithm::SHA1, 6, 30)
        );
    }

    public function verifyTotp(string $identifier, string $code, array $data = []): bool
    {
        return $this->totpVerified ?? true;
    }
}
