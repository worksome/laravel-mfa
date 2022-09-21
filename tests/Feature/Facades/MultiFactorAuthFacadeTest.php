<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Drivers\Email\NullEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Sms\NullSmsDriver;
use Worksome\MultiFactorAuth\Drivers\Totp\NullTotpDriver;
use Worksome\MultiFactorAuth\Enums\Channel;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Facades\MultiFactorAuth;

it('can create an SMS driver from the facade', function () {
    MultiFactorAuth::usingDriver(Channel::Sms, new NullSmsDriver());

    $response = MultiFactorAuth::sms()->make(new E164PhoneNumber('+15017122661'));

    expect($response)
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can create an email driver from the facade', function () {
    MultiFactorAuth::usingDriver(Channel::Email, new NullEmailDriver());

    $response = MultiFactorAuth::email()->make(new EmailAddress('test@example.org'));

    expect($response)
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can create a TOTP driver from the facade', function () {
    MultiFactorAuth::usingDriver(Channel::Totp, new NullTotpDriver());

    $response = MultiFactorAuth::totp()->make(new TotpSecret('TESTSECRET'));

    expect($response)
        ->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});
