<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\Facades\MultiFactorAuth;
use Worksome\MultiFactorAuth\DTOs\Secret;

it('can fake secret details', function () {
    MultiFactorAuth::fake(
        new Secret('FAKE_SECRET')
    );

    expect(MultiFactorAuth::getSecret())
        ->secret->toBe('FAKE_SECRET')
        ->issuer->toBeNull()
        ->label->toBeNull()
        ->algorithm->toBeNull()
        ->digits->toBeNull()
        ->period->toBeNull();

    MultiFactorAuth::fake();

    expect(MultiFactorAuth::getSecret()->secret)->toBe('NULL_DRIVER_SECRET');
});
