<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\DTOs\Secret;

it(
    'can generate a URL from a secret',
    function (
        string $fullUri,
        string $secret,
        string|null $issuer,
        string|null $label,
        string|null $algorithm,
        int|null $digits,
        int|null $period,
        string|null $uri,
    ) {
        $secret = new Secret($secret, $issuer, $label, $algorithm, $digits, $period, $uri);

        expect($secret->getUri())->toBe($fullUri);
    }
)->with([
    // phpcs:disable Generic.Files.LineLength
    'only secret' => [
        'otpauth://totp/Unknown?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', null, null, null, null, null, null
    ],
    'secret and issuer' => [
        'otpauth://totp/TestApp?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestApp',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', null, null, null, null, null
    ],
    'secret, issuer, and label' => [
        'otpauth://totp/TestApp:TestLabel?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestApp',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', 'TestLabel', null, null, null, null
    ],
    'secret, issuer, label, and algorithm' => [
        'otpauth://totp/TestApp:TestLabel?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestApp&algorithm=SHA256',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', 'TestLabel', 'SHA256', null, null, null
    ],
    'secret, issuer, label, algorithm, and digits' => [
        'otpauth://totp/TestApp:TestLabel?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestApp&algorithm=SHA256&digits=8',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', 'TestLabel', 'SHA256', 8, null, null
    ],
    'secret, issuer, label, algorithm, digits, and period' => [
        'otpauth://totp/TestApp:TestLabel?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestApp&algorithm=SHA256&digits=8&period=60',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', 'TestLabel', 'SHA256', 8, 60, null
    ],
    'secret, issuer, label, algorithm, digits, period, and URI' => [
        'otpauth://totp/TestAppURI:Label?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestAppURI&algorithm=SHA256&digits=4&period=30',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', 'TestApp', 'TestLabel', 'SHA256', 8, 60,
        'otpauth://totp/TestAppURI:Label?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=TestAppURI&algorithm=SHA256&digits=4&period=30',
    ],
    'secret, label, algorithm, digits, period, and URI' => [
        'otpauth://totp/Unknown:TestLabel?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&algorithm=SHA256&digits=8&period=60',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', null, 'TestLabel', 'SHA256', 8, 60, null
    ],
    'secret, algorithm, digits, period, and URI' => [
        'otpauth://totp/Unknown?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&algorithm=SHA256&digits=8&period=60',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', null, null, 'SHA256', 8, 60, null
    ],
    'secret, digits, period, and URI' => [
        'otpauth://totp/Unknown?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&digits=8&period=60',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', null, null, null, 8, 60, null
    ],
    'existing URI' => [
        'otpauth://totp/test-issuer:John%E2%80%99s%20Account%20Name?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=test-issuer&algorithm=SHA1&digits=6&period=30',
        'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ', null, null, null, null, null,
        'otpauth://totp/test-issuer:John%E2%80%99s%20Account%20Name?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=test-issuer&algorithm=SHA1&digits=6&period=30'
    ],
    // phpcs:enable
]);
