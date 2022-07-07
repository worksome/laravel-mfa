<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DataValues\Totp\TotpSecret;
use Worksome\MultiFactorAuth\Enums\HashAlgorithm;

it('can create a valid TOTP secret', function () {
    expect(
        new TotpSecret('ABCDEFGHIJKLMNOP', 'Test Issuer', 'Label', HashAlgorithm::SHA1, 6, 30)
    )
        ->toBeInstanceOf(TotpSecret::class)
        ->secret->toBe('ABCDEFGHIJKLMNOP')
        ->uri()->toBe('otpauth://totp/Test%20Issuer:Label?secret=ABCDEFGHIJKLMNOP&issuer=Test%20Issuer&algorithm=SHA1&digits=6&period=30');
});
