<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Drivers\Totp\NullTotpDriver;
use Worksome\MultiFactorAuth\Enums\Status;

it('can make TOTP from the Null driver', function () {
    $driver = (new NullTotpDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified();

    $status = $driver->make(
        new TotpSecret('TEST'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can verify TOTP from the Null driver', function () {
    $driver = (new NullTotpDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified(false);

    $secret = new TotpSecret('TEST');

    expect(
        $driver->verify($secret, '123456')
    )->toBeFalse();

    $driver
        ->fakeStatus(Status::APPROVED)
        ->fakeVerified();

    expect(
        $driver->verify($secret, '123456')
    )->toBeTrue();
});
