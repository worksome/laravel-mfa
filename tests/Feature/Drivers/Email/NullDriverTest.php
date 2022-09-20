<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\CreationResponse;
use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\Drivers\Email\NullEmailDriver;
use Worksome\MultiFactorAuth\Enums\Status;

it('can send Email from the Null driver', function () {
    $driver = (new NullEmailDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified();

    $status = $driver->make(
        new EmailAddress('test@example.org'),
    );

    expect($status)->toBeInstanceOf(CreationResponse::class)
        ->status->toBe(Status::PENDING);
});

it('can verify Email from the Null driver', function () {
    $driver = (new NullEmailDriver())
        ->fakeStatus(Status::PENDING)
        ->fakeVerified(false);

    $emailAddress = new EmailAddress('test@example.org');

    expect(
        $driver->verify($emailAddress, '123456')
    )->toBeFalse();

    $driver
        ->fakeStatus(Status::APPROVED)
        ->fakeVerified();

    expect(
        $driver->verify($emailAddress, '123456')
    )->toBeTrue();
});
