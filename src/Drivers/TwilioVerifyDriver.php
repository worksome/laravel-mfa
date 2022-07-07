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
use Worksome\MultiFactorAuth\Enums\HashAlgorithm;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Enums\TwilioVerify\Channel;
use Worksome\MultiFactorAuth\Enums\TwilioVerify\Factor;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

class TwilioVerifyDriver implements Driver, SupportsEmail, SupportsSms, SupportsTotp
{
    public function __construct(private readonly Client $client)
    {
    }

    public function sendSms(E164PhoneNumber $to): CreationResponse
    {
        $data = $this->client->sendVerification($to->number, Channel::SMS);

        assert(isset($data['status']));

        return new CreationResponse(
            Status::fromTwilioVerify($data['status']),
            $data
        );
    }

    public function verifySms(E164PhoneNumber $to, string $code): bool
    {
        $data = $this->client->sendVerificationCheck($to->number, $code);

        assert(isset($data['status']));

        return Status::fromTwilioVerify($data['status']) === Status::APPROVED;
    }

    public function sendEmail(EmailAddress $to): CreationResponse
    {
        $data = $this->client->sendVerification($to->address, Channel::EMAIL);

        assert(isset($data['status']));

        return new CreationResponse(
            Status::fromTwilioVerify($data['status']),
            $data
        );
    }

    public function verifyEmail(EmailAddress $to, string $code): bool
    {
        $data = $this->client->sendVerificationCheck($to->address, $code);

        assert(isset($data['status']));

        return Status::fromTwilioVerify($data['status']) === Status::APPROVED;
    }

    public function createTotp(string $issuer, string $identifier, string $label): TotpResponse
    {
        $data = $this->client->sendCreateFactor($identifier, $label, Factor::TOTP);

        assert(isset($data['status']));

        $secret = new TotpSecret(
            $data['binding']['secret'],
            $issuer,
            $data['friendly_name'],
            HashAlgorithm::fromTwilioVerify($data['config']['alg']),
            $data['config']['code_length'],
            $data['config']['time_step'],
            $data['binding']['uri'] ?? null,
        );

        return new TotpResponse(
            $identifier,
            Status::fromTwilioVerify($data['status']),
            $secret,
            $data
        );
    }

    public function verifyTotp(string $identifier, string $code, array $data = []): bool
    {
        assert(isset($data['factor_id']));

        $data = $this->client->sendFactorChallengeCheck($identifier, $data['factor_id'], $code);

        assert(isset($data['status']));

        return Status::fromTwilioVerify($data['status']) === Status::APPROVED;
    }
}
