<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DTOs\Secret;

it('will return valid details for the Twilio Verify API', function () {
    $secret = twilioVerifyDriver()->getSecret('ff483d1ff591898a9942916050d2ca3f');

    expect($secret)
        ->toBeInstanceOf(Secret::class)
        ->getUri()->toStartWith('otpauth://totp/test-issuer:')
        ->algorithm->toBe('sha1')
        ->digits->toBe(6)
        ->period->toBe(30)
        ->secret->toBe('GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ');
});
