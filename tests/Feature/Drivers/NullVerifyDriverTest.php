<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Totp\TotpIdentifier;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\TotpResponse;
use Worksome\MultiFactorAuth\Drivers\NullDriver;
use Worksome\MultiFactorAuth\Enums\HashAlgorithm;
use Worksome\MultiFactorAuth\Enums\Status;

it('can retrieve a TOTP Verify response from the Null driver', function () {
    $driver = new NullDriver();

    $status = $driver->createTotp(
        'Test Issuer',
        $identifier = new TotpIdentifier('test@example.org'),
        'Test'
    );

    expect($status)->toBeInstanceOf(TotpResponse::class)
        ->status->toBe(Status::PENDING)
        ->identifier->toBe($identifier)
        ->identifier->identifier->toBe('test@example.org')
        ->identifier->data->toBeArray()->toBeEmpty()
        ->data->toBeArray()
        ->secret->toBeInstanceOf(TotpSecret::class)
        ->secret->secret->toBe('ABCDEFGHIJKLMNOP')
        ->secret->issuer->toBe('Test Issuer')
        ->secret->label->toBe('test@example.org')
        ->secret->algorithm->toBe(HashAlgorithm::SHA1)
        ->secret->digits->toBe(6)
        ->secret->period->toBe(30)
        ->secret->uri()->toBe(
            'otpauth://totp/Test%20Issuer:test%40example.org?secret=ABCDEFGHIJKLMNOP&issuer=Test%20Issuer&algorithm=SHA1&digits=6&period=30'
        );
});
