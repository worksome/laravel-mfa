<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Email\EmailAddress;
use Worksome\MultiFactorAuth\Exceptions\Email\InvalidEmailAddressException;

it('can create a valid email address', function () {
    expect(new EmailAddress('test@example.org'))
        ->toBeInstanceOf(EmailAddress::class)
        ->address->toBe('test@example.org');
});

it('throws an exception for an invalid email address', function (string $email) {
    new EmailAddress($email);
})
    ->throws(InvalidEmailAddressException::class, 'The provided email address is not valid.')
    ->with([
        'email with no @' => 'a',
        'email with no domain' => 'owen@',
        'email with no local name' => '@php.net',
        'empty email address' => '',
    ]);
