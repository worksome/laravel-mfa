<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Drivers\Totp\NullTotpDriver;
use Worksome\MultiFactorAuth\Enums\Status;

it('can make TOTP from the Null driver', function () {
    $driver = (new NullTotpDriver())
        ->fakeStatus(Status::Pending)
        ->fakeVerified();

    $status = $driver->make(
        new TotpSecret('TESTSECRET'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::Pending);
});

it('can verify TOTP from the Null driver', function () {
    $driver = (new NullTotpDriver())
        ->fakeStatus(Status::Pending)
        ->fakeVerified(false);

    $secret = new TotpSecret('TESTSECRET');

    expect(
        $driver->verify($secret, '123456')
    )->toBeFalse();

    $driver
        ->fakeStatus(Status::Approved)
        ->fakeVerified();

    expect(
        $driver->verify($secret, '123456')
    )->toBeTrue();
});
