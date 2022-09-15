<?php

declare(strict_types=1);

use Worksome\MultiFactorAuth\Enums\Channel;

return [

    /**
     * The user model to support multifactor authentication.
     */

    'user' => \App\Models\User::class,

    /**
     * The drivers that should be used for each channel.
     *
     * @see \Worksome\MultiFactorAuth\Enums\Channel for the available channels.
     */

    'channels' => [

        Channel::EMAIL->value => [
            'driver' => env('MFA_EMAIL_DRIVER', 'null'),
        ],

        Channel::SMS->value => [
            'driver' => env('MFA_SMS_DRIVER', 'null'),
        ],

    ],

    /**
     * The drivers that are available to use, and their configurations.
     */

    'drivers' => [

        'twilio_verify' => [
            'account_id' => env('TWILIO_VERIFY_ACCOUNT_ID'),
            'token' => env('TWILIO_VERIFY_AUTH_TOKEN'),
            'service_id' => env('TWILIO_VERIFY_SERVICE_ID'),
        ],

    ],

];
