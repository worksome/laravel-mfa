<?php

declare(strict_types=1);

it('shows MFA details', function () {
    $this->artisan('about')
        ->assertSuccessful()
        ->expectsOutputToContain('Multi-Factor Authentication (MFA)')
        ->expectsOutputToContain('Email Driver')
        ->expectsOutputToContain('SMS Driver')
        ->expectsOutputToContain('TOTP Driver');
});
