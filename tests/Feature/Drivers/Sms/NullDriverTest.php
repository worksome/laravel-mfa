<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\Drivers\Sms\NullSmsDriver;
use Worksome\MultiFactorAuth\Enums\Status;

it('can send SMS from the Null driver', function () {
    $driver = (new NullSmsDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified();

    $status = $driver->make(
        new E164PhoneNumber('+14155552671'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can verify SMS from the Null driver', function () {
    $driver = (new NullSmsDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified(false);

    $phoneNumber = new E164PhoneNumber('+14155552671');

    expect(
        $driver->verify($phoneNumber, '123456')
    )->toBeFalse();

    $driver
        ->fakeStatus(Status::APPROVED)
        ->fakeVerified();

    expect(
        $driver->verify($phoneNumber, '123456')
    )->toBeTrue();
});
