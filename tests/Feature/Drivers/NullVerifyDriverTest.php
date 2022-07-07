<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;
use Worksome\MultiFactorAuth\Drivers\NullDriver;
use Worksome\MultiFactorAuth\Drivers\TwilioVerifyDriver;
use Worksome\MultiFactorAuth\Enums\HashAlgorithm;
use Worksome\MultiFactorAuth\Enums\Status;
use Worksome\MultiFactorAuth\Enums\TwilioVerify\Channel;
use Worksome\MultiFactorAuth\Services\TwilioVerify\Client;

it('can retrieve a TOTP Verify response from the Null driver', function () {
    $driver = new NullDriver();

    $status = $driver->createTotp(
        'test@example.org',
        'Test'
    );

    expect($status)->toBeInstanceOf(TotpResponse::class)
        ->status->toBe(Status::PENDING)
        ->identifier->toBe('test@example.org')
        ->data->toBeArray()
        ->secret->toBeInstanceOf(TotpSecret::class)
        ->secret->secret->toBe('ABCDEFGHIJKLMNOP')
        ->secret->issuer->toBe('NullDriver Issuer')
        ->secret->label->toBe('test@example.org')
        ->secret->algorithm->toBe(HashAlgorithm::SHA1)
        ->secret->digits->toBe(6)
        ->secret->period->toBe(30)
        ->secret->uri()->toBe(
            'otpauth://totp/NullDriver%20Issuer:test%40example.org?secret=ABCDEFGHIJKLMNOP&issuer=NullDriver%20Issuer&algorithm=SHA1&digits=6&period=30'
        );
});
