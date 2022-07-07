<?php

declare(strict_types=1);

return [

    /**
     * Go ahead and select a default exchange driver to be used when
     * generating multifactor authentication.
     *
     * Supported: 'null', 'twilio_verify'
     */

    'default' => env('MFA_DRIVER', 'null'),

    'services' => [

        'twilio_verify' => [
            'account_id' => env('TWILIO_VERIFY_ACCOUNT_ID'),
            'token' => env('TWILIO_VERIFY_AUTH_TOKEN'),
            'service_id' => env('TWILIO_VERIFY_SERVICE_ID'),
            'totp_issuer' => env('TWILIO_VERIFY_TOTP_ISSUER', env('APP_NAME')),
        ],

    ],

];
