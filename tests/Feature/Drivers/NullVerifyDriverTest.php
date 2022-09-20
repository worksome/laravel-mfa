<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\DataValues\Sms\E164PhoneNumber;
use Worksome\MultiFactorAuth\DataValues\TwilioVerify\CreationResponse;
use Worksome\MultiFactorAuth\Drivers\Email\NullEmailDriver;
use Worksome\MultiFactorAuth\Drivers\Sms\NullSmsDriver;
use Worksome\MultiFactorAuth\Enums\Status;

it('can send SMS from the Null driver', function () {
    $driver = NullSmsDriver::make()
        ->withSmsStatus(Status::PENDING)
        ->withSmsVerified();

    $status = $driver->make(
        new E164PhoneNumber('+14155552671'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can verify SMS from the Null driver', function () {
    $driver = NullSmsDriver::make()
        ->withSmsStatus(Status::PENDING)
        ->withSmsVerified(false);

    $phoneNumber = new E164PhoneNumber('+14155552671');

    expect(
        $driver->verify($phoneNumber, '123456')
    )->toBeFalse();

    $driver
        ->withSmsStatus(Status::APPROVED)
        ->withSmsVerified();

    expect(
        $driver->verify($phoneNumber, '123456')
    )->toBeTrue();
});

it('can send Email from the Null driver', function () {
    $driver = NullEmailDriver::make()
        ->withEmailStatus(Status::PENDING)
        ->withEmailVerified();

    $status = $driver->make(
        new EmailAddress('test@example.org'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can verify Email from the Null driver', function () {
    $driver = NullEmailDriver::make()
        ->withEmailStatus(Status::PENDING)
        ->withEmailVerified(false);

    $emailAddress = new EmailAddress('test@example.org');

    expect(
        $driver->verify($emailAddress, '123456')
    )->toBeFalse();

    $driver
        ->withEmailStatus(Status::APPROVED)
        ->withEmailVerified();

    expect(
        $driver->verify($emailAddress, '123456')
    )->toBeTrue();
});
