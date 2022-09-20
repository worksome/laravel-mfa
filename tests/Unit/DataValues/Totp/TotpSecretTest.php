<?php

declare(strict_types=1);

use PragmaRX\Google2FA\Google2FA;
use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Exceptions\Totp\InvalidTotpSecretException;

it('can create a valid TOTP secret', function () {
    $secret = (new Google2FA())->generateSecretKey();

    expect(new TotpSecret($secret))
        ->toBeInstanceOf(TotpSecret::class)
        ->data->toBe($secret);
});

it('throws an exception for a non-E.164 phone number', function () {
    new TotpSecret('');
})->throws(InvalidTotpSecretException::class, 'The provided TOTP secret is not valid.');
