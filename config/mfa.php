<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\Enums\Channel;

return [

    /**
     * The user model to support multifactor authentication.
     */

    'user' => \App\Models\User::class,

    'channels' => [
        Channel::SMS->name => [
            'driver' => 'null',
        ],
        Channel::EMAIL->name => [
            'driver' => 'null',
        ]
    ],

    'drivers' => [
        'twilio_verify' => [
            'account_id' => env('TWILIO_VERIFY_ACCOUNT_ID'),
            'token' => env('TWILIO_VERIFY_AUTH_TOKEN'),
            'service_id' => env('TWILIO_VERIFY_SERVICE_ID'),
        ],

    ],

];
